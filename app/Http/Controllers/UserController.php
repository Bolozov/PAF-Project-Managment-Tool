<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Departement;
use App\Models\Service;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Response;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Factory|View
     */



    public function index(Request $request)
    {

        /** @var User $users */

        if ( auth()->user()->hasRole('Admin')) {
            $users = User::with('department', 'service')->paginate(5);
        } elseif ( auth()->user()->hasRole('Chef de département') &&  auth()->user()->can('view-users')) {
            $users = User::with('department', 'service')
                ->where('departement_id',  auth()->user()->departement_id)
                ->paginate(5);
        } elseif ( auth()->user()->hasRole('Chef de service') && auth()->user()->can('view-users')) {
            $users = User::with('service')
                ->where('service_id',  auth()->user()->service_id)
                ->where('departement_id',  auth()->user()->departement_id)
                ->paginate(5);
        } else {
            abort(403);
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new User.
     *
     *
     */
    public function create()
    {
        if (!auth()->user()->can('create-users')){
            abort(403);
        }
            $roles = Role::pluck('name', 'name')->all();
        $departments = Departement::pluck('name', 'id')->all();
        $services = Service::pluck('name', 'id')->all();
        return view('users.create', compact('roles', 'departments', 'services'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        /** @var User $user */
        $user = User::create($input);
        $user->assignRole($request->input('role'));
        if ($request->input('role') == "Chef de département") {
            $departement = Departement::find($request->input('departement_id'));

            if (is_null($departement->responsible_id) || $departement->responsible_id == '') {
                $departement->responsible_id = $user->id;
                $departement->save();
            } else {
                $oldResponsible = User::find($departement->responsible_id);
                DB::table('model_has_roles')->where('model_id', $departement->responsible_id)->delete();
                $oldResponsible->syncRoles('Utilisateur');
                $departement->responsible_id = $user->id;
                $departement->save();
            }

        }
        Flash::success('Utilisateur ' . $user->name . ' créé avec succès.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        /** @var User $user */
        $user = User::with('department', 'service')->find($id);

        if (empty($user)) {
            Flash::error('Utilisateur n\'existe pas.');

            return redirect(route('users.index'));
        }

        return view('users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $departments = Departement::pluck('name', 'id')->all();
        $services = Service::pluck('name', 'id')->all();

        if (empty($user)) {
            Flash::error('Utilisateur n\'existe pas.');

            return redirect(route('users.index'));
        }

        return view('users.edit')
            ->with(['user' => $user, 'roles' => $roles, 'userRole' => $userRole, 'departments' => $departments, 'services' => $services]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        /** @var User $user */
        $user = User::find($id);
        if (empty($user)) {
            Flash::error('Utilisateur n\'existe pas.');

            return redirect(route('users.index'));
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->syncRoles($request->input('role'));

        Flash::success('Utilisateur mis à jour avec succès');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     *
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('Utilisateur n\'existe pas.');

            return redirect(route('users.index'));
        }
        $user->roles()->detach();

        $user->delete();

        Flash::success("Utilisateur supprimé avec succès.");

        return redirect(route('users.index'));
    }

    /**
     * Display a listing of the User based on search query.
     *
     */
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('cin', 'LIKE', "%{$search}%")
            ->paginate(5);

        if (count($users) == 0) {

            Flash::error("Aucun résultat trouvé correspondant au terme recherché.");

            return redirect(route('users.index'));
        }

        return view('users.index')->with('users', $users);
    }

    public function notifications()
    {
        $notifications = Auth::user()->notifications;
        return view('users.notifications', compact('notifications'));
    }

    /**
     * Set a single / All comments as Read.
     *
     * @param null $notificationId
     * @return Factory|View
     */
    public function markNotificationAsRead($notificationId = null)
    {
        !is_null($notificationId) ?
            DB::table('notifications')->where('id', $notificationId)->update(['read_at' => now()]) :
            Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
