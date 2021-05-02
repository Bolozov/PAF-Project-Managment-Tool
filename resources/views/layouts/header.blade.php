<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">

    @if(\Illuminate\Support\Facades\Auth::user())
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg {{ Auth::user()->unreadNotifications()->count() > 0 ? 'beep' : '' }}"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-list-content dropdown-list-icons">
                @forelse( Auth::user()->notifications as $notification)

                <a href="#" class="dropdown-item {{ ($notification->read_at == null ) ? 'dropdown-item-unread' : ' ' }}">

                    <div class="dropdown-item-icon {{ ($notification->read_at == null ) ? 'bg-primary' : 'bg-success' }}  text-white">
                        <i class="{{ ($notification->read_at == null ) ?   'far fa-circle' : 'fas fa-circle'}}"></i>

                    </div>
                    @if($notification->type == 'App\Notifications\ProjectAssigned')
                    <div class="dropdown-item-desc">
                        {{ $notification->data['notification_text'] }} : <span class="text-dark"> <b>{{ $notification->data['project_name'] }} </b></span>
                        <div class="time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    @elseif($notification->type == 'App\Notifications\TaskAssigned')
                    <div class="dropdown-item-desc">
                        {{ $notification->data['notification_text'] }} : <span class="text-dark"> Projet: <b>{{ $notification->data['project_name'] }} </b> </span>
                        , <span class="text-dark"> Tâche: <b>{{ $notification->data['task_name'] }} </b> </span>
                        <div class="time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    @elseif($notification->type == 'App\Notifications\TaskSubmittedForValidation')
                    <div class="dropdown-item-desc">
                        {{ $notification->data['username'] }} {{ $notification->data['notification_text'] }} : <span class="text-dark"> <b>{{ $notification->data['task_name'] }} </b></span>
                        <div class="time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    @endif
                </a>


                @empty
                Aucune notification.
                @endforelse

            </div>
            <div class="dropdown-footer text-center">
                <a href="{{route('users.notifications')}}">Tout Afficher <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </li>
    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ Auth::user()->AvatarUrl }}" class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
            <div class="d-sm-none d-lg-inline-block">
                Bonjour, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
        </a>

        <div class="dropdown-menu dropdown-menu-right">

            {{-- <a class="dropdown-item has-icon edit-profile" href="#" data-id="{{ \Auth::id() }}">
            <i class="fa fa-user"></i>Edit Profile</a> --}}
            <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal" href="#" data-id="{{ Auth::id() }}"><i class="fa fa-lock"> </i>Changer le mot de passe</a>
            <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
    @else


    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            {{-- <img alt="image" src="#" class="rounded-circle mr-1">--}}
            <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">{{ __('messages.common.login') }}
                / {{ __('messages.common.register') }}</div>
            <a href="{{ route('login') }}" class="dropdown-item has-icon">
                <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
            </a>
            <div class="dropdown-divider"></div>

        </div>
    </li>
    @endif
</ul>
