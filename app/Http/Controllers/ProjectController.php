<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Departement;
use App\Models\Project;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use App\Notifications\ProjectAssigned;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use App\Http\Traits\ProjectTrait;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class ProjectController extends AppBaseController
{
    use ProjectTrait;

    /**
     * Display a listing of the Project.
     *
     * @param Request $request
     *
     *
     */
    public function index(Request $request)
    {
        /** @var Project $projects */
        $projects = Project::with('responsible', 'departement', 'service', 'tasks')
            ->withCount('projectFinishedTasks')
            ->withCount('tasks')
            ->latest()
            ->paginate(5);


        return view('projects.index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new Project.
     *
     *
     */
    public function create()
    {
        $departements = Departement::pluck('name', 'id')->all();
        $services = Service::pluck('name', 'id')->all();
        $chefProjectUsers = User::role('Chef de projet')->pluck('name', 'id')->all(); // Returns the users with the role 'chef de projet'
        $users = User::role('Utilisateur')->pluck('name', 'id')->all();

        return view('projects.create', compact('departements', 'services', 'chefProjectUsers', 'users'));
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     *
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();
        $input['status_project'] = 'créé';
        // add the responsible of the project to the project's team array.
        $input['users_id'] += [sizeof($input['users_id']) => $input['responsible_id_project']];
        $users_ids = array_map('intval', $input['users_id']);
        unset($input["users_id"]);


        /** @var Project $project */
        $project = Project::create($input);
        $project->users()->attach($users_ids);

        /**
         * Sending notification to the resonsible and the team members
         */
        $users = User::find($users_ids);

        Notification::send($users, new ProjectAssigned($project));


        Flash::success('Projet créé avec succès.');

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified Project.
     *
     * @param int $id
     *
     *
     */
    public function show($id)
    {
        /** @var Project $project */

        $project = Project::with('responsible', 'users', 'departement', 'service', 'tasks')->find($id);

        if (empty($project)) {
            Flash::error('Projet introuvable ou supprimé.');

            return redirect(route('projects.index'));
        }
        $leftBalance = $this->getLeftBalance($project);
        // $projectProgress = $this->getProjectProgress($project);


        $chart_options = [
            'chart_title' => 'Tasks by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Task',
            'group_by_field' => 'status',
            'chart_type' => 'pie',
            'style_class ' => 'charts',
            'filter_field' => 'created_at',

            'where_raw' => 'project_id = ' . $project->id,
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tâches assignées à chaque membre',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Task',

            'relationship_name' => 'user', // represents function user() on Transaction model
            'group_by_field' => 'name', // users.name

            'aggregate_function' => 'count',
            'aggregate_field' => 'status',
            'where_raw' => 'project_id = ' . $project->id,
            //'where_raw' => "status like 'validée'"


        ];

        $tasksLineChart = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tâches par jours',
            'chart_type' => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Task',
            'conditions' => [
                ['name' => 'Créé', 'condition' => "status = 'créé'", 'color' => '#6777ef', 'fill' => true],
                ['name' => 'En cours', 'condition' => "status = 'en cours'", 'color' => '#343a40', 'fill' => true],
                ['name' => 'Validée', 'condition' => "status = 'validée'", 'color' => '#4caf50', 'fill' => true],
                ['name' => 'En attente de validation', 'condition' => "status = 'en attente de validation'", 'color' => '#343a40', 'fill' => true],
            ],

            'group_by_field' => 'created_at',
            'group_by_period' => 'day',


            'filter_field' => 'updated_at',
            'filter_days' => 30, // show only tasks for last 30 days
            'filter_period' => 'week', // show only task for this week
            'continuous_time' => true, // show continuous timeline including dates without data
            'where_raw' => 'project_id = ' . $project->id,
        ];
        $progressLineChart = new LaravelChart($chart_options);
        return view('projects.show', compact('project', 'leftBalance', 'chart1', 'tasksLineChart', 'progressLineChart'));
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param int $id
     *
     *
     */
    public function edit($id)
    {
        /** TODO :
         * Filter Result , Only get users with the role Chef de projet , in project's departement & service (users.departement_id ,users.service_id)
         */
        $chefProjectUsers = User::role('Chef de projet')->select('id', 'name')->get(); // Returns the users with the role 'chef de projet'

        $departements = Departement::select('id', 'name')->get();

        $services = Service::select('id', 'name')->get();
        $users = User::role('Utilisateur')->select('id', 'name')->get();

        /** @var Project $project */
        $project = Project::with('responsible', 'users', 'departement', 'service')->find($id);

        if (empty($project)) {
            Flash::error('Projet introuvable ou supprimé.');

            return redirect(route('projects.index'));
        }

        return view('projects.edit', compact('project', 'chefProjectUsers', 'departements', 'services', 'users'));
    }

    /**
     * Update the specified Project in storage.
     *
     * @param int $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
    {
        /** @var Project $project */
        $project = Project::find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $input = $request->all();
        // add the responsible of the project to the project's team array.
        $input['users_id'] += [sizeof($input['users_id']) => $input['responsible_id_project']];
        $users_ids = array_map('intval', $input['users_id']);
        unset($input["users_id"]);

        $project->update($input);
        $project->users()->sync(array_values($users_ids));


        Flash::success('Projet mis à jour avec succès.');

        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param int $id
     *
     *
     */
    public function destroy($id)
    {
        /** @var Project $project */
        $project = Project::find($id);

        if (empty($project)) {
            Flash::error('Projet non trouvé ');

            return redirect(route('projects.index'));
        }
        //Cleaning Pivot Table , deleting users attached to this project.
        $project->users()->detach();
        //Delete all related tasks.
        $project->tasks()->delete();
        //Delete the project record.
        $project->delete();

        Flash::success('Projet supprimé avec succès.');

        return redirect(route('projects.index'));
    }

    /**
     * Exporting the Project Collection to excel File.
     */
    public function export()
    {

        $fileName = 'Projet_PAF_' . now() . '.xlsx';
        return Excel::download(new ProjectsExport, $fileName);
    }



}
