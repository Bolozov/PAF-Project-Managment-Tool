<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Traits\ProjectTrait;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use App\Notifications\TaskSubmittedForValidation;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Response;

class TaskController extends AppBaseController
{
    use ProjectTrait;

    /**
     * Display a listing of the Task.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        if (auth()->user()->hasRole('Admin')) {
            $tasks = Task::latest()
                ->where('status', 'LIKE', "%{$search}%")
                ->paginate(5);
        } elseif (auth()->user()->hasRole('Chef de département')) {
            $tasks = Task::when($search != null, function ($query) use ($search) {
                $query->where('status', 'LIKE', "%{$search}%");
            })->whereHas('project', function ($query) {
                $query->where('departement_id', '=', auth()->user()->departement_id);
            })->latest()
                ->paginate(5);

        } elseif (auth()->user()->hasRole('Chef de service')) {
            $tasks = Task::when($search != null, function ($query) use ($search) {
                $query->where('status', 'LIKE', "%{$search}%");
            })->whereHas('project', function ($query) {
                $query->where(['project.departement_id', '=', auth()->user()->departement_id], 'project.service_id', '=', auth()->user()->service_id);
            })->latest()
                ->paginate(5);

        } elseif (auth()->user()->hasRole('Chef de projet')) {
            $tasks = Task::when($search != null, function ($query) use ($search) {
                $query->where('status', 'LIKE', "%{$search}%");
            })->whereHas('project', function ($query) {
                $query->where(['project.departement_id', '=', auth()->user()->departement_id],
                    ['project.service_id', '=', auth()->user()->service_id],
                    ['project.responsible_id_project', '=', auth()->user()->id]);
            })->latest()
                ->paginate(5);
        } else {
            $tasks = Task::query()
                ->where('user_id', "=", auth()->user()->id)
                ->where('status', 'LIKE', "%{$search}%")
                ->paginate(5);
        }
        // if (count($tasks) == 0) {

        //     Flash::error("Aucun résultat trouvé correspondant au terme recherché.");

        //     return route('tasks.index');
        // }

        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Factory|View
     */
    public function create($id)
    {
        $project = Project::find($id);

        if (empty($project)) {
            Flash::error('Projet non trouvé ou paramètres non valides.');
            return redirect(route('projects.index'));
        }
        $leftBalance = $this->getLeftBalance($project);
        $projectTeam = $project->users->pluck('name', 'id');

        return view('tasks.create', compact('project', 'projectTeam', 'leftBalance'));
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param CreateTaskRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTaskRequest $request)
    {
        

        $input = $request->all();
        
        $input['status'] = "créé";
        /** @var Task $task */
        $task = Task::create($input);
        \DB::table('projects')
            ->where('id', $task->project_id)
            ->where('status_project', 'créé')
            ->update(['status_project' => 'en cours']);

        /**
         * Sending notification to the team member.
         */
        $user = User::find($task->user_id);

        Notification::send($user, new TaskAssigned($task));

        Flash::success('Tâche ajoutée avec succès.');

        return redirect()->back();
    }

    /**
     * Display the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Task $task */
        $task = Task::find($id);

        if (empty($task)) {
            Flash::error('Tâche introuvable');

            return redirect(route('tasks.index'));
        }

        return view('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        /** @var Task $task */
        $task = Task::find($id);
        $project = Project::find($task->project_id);

        $projectTeam = $project->users()->pluck('name', 'users.id');
        $leftBalance = $this->getLeftBalance($project);
        $status = array('en cours' => 'En cours', 'validée' => 'Validée', 'en attente de validation' => 'à valider', 'créé' => 'Créé');
        if (empty($task)) {
            Flash::error('Tâche introuvable');

            return redirect(route('tasks.index'));
        }

        return view('tasks.edit', compact('task', 'project', 'projectTeam', 'leftBalance', 'status'));
    }

    /**
     * Update the specified Task in storage.
     *
     * @param int $id
     * @param UpdateTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskRequest $request)
    {
        /** @var Task $task */
        $task = Task::find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $task->fill($request->all());
        $task->save();

        Flash::success('Task updated successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified Task from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     *
     */
    public function destroy($id)
    {
        /** @var Task $task */
        $task = Task::find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $task->delete();

        Flash::success('Task deleted successfully.');

        return redirect(route('tasks.index'));
    }

    public function startTask($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'en cours']);
        return redirect('/projects/'.$task->project->id.'#tasks' );
    }

    public function validateTask($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.validate', compact('task'));
    }

    /**
     * Submit a validation request
     */
    public function submitValidationFile(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $request->validate([
            'verification_file' => 'required|max:2048',
        ]);
        if ($file = $request->file('verification_file')) {
            $name = 'fichier_tache_' . $task->id . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('taskVerification'), $name);

            $task->update(['verification_file' => 'taskVerification/' . $name, 'status' => 'en attente de validation']);

            $projectManager = $task->project->responsible;
            //$projectManager = User::role('Admin')->take('1')->get();

            Notification::send($projectManager, new TaskSubmittedForValidation($task));

            Flash::success('Demande de validation soumise avec succès.');

            return redirect(route('tasks.index'));

        }

    }

    /**
     * Set a task as validated
     */
    public function performValidation($id)
    {
        if (!auth()->user()->can('valiate-projects-task')) {
            abort(403);
        }

        Task::findOrFail($id)->update(['status' => 'validée']);
        Flash::success("Tâche validée.");
        return redirect()->view('projects.details.tasks');

    }

}
