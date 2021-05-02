@can('view-dashboard')

<li class="menu-header">Dashboard</li>
<li class="side-menus {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-fire"></i><span>Dashboard</span>
    </a>
</li>

@endcan

@can('view-project')

<li class="menu-header">Gestion des Projets</li>

<li class="side-menus {{ Request::is('projects*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fas fa-briefcase"></i><span>Projets</span></a>
</li>

@endcan

@can('view-tasks')

<li class="side-menus {{ Request::is('tasks*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i><span>Tâches</span></a>
</li>

@endcan

@can('view-users')

<li class="menu-header">Gestion du personnel</li>
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}">
        <i class="fas fa-users"></i><span>Utilisateurs</span>
    </a>
</li>

@endcan

@can('view-departments')

<li class="{{ Request::is('departements*') ? 'active' : '' }}">
    <a href="{{ route('departements.index') }}"><i class="fas fa-building"></i><span>Départements</span></a>
</li>

@endcan

@can('view-services')

<li class="side-menus {{ Request::is('services*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('services.index') }}"><i class="fas fa-cog"></i><span>Services</span></a>
</li>

@endcan

@can('manage-user-roles')


<li class="menu-header">Gestion des accès</li>
<li class="side-menus {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('roles.index') }}"><i class="fas fa-key"></i><span>Rôles & Autorisations</span></a>
</li>

@endcan
