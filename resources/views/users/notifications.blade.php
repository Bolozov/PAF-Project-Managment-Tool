@extends('layouts.app')
@section('title')
    Notifications
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Notifications</h1>
            <div class="section-header-breadcrumb">
                <a href="{{route('users.notifications.markAsRead')}}" class="btn btn-outline-danger "><i
                        class="fas fa-check-double"></i> Tout marquer comme lus</a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')

            <div class="row">
                <div class="col-12">
                    <div class="activities">
                        @forelse ($notifications as $notification)
                            <div class="activity">
                                @if($notification->type === "App\Notifications\ProjectAssigned")
                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                @elseif($notification->type === "App\Notifications\TaskAssigned")
                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                @elseif($notification->type === "App\Notifications\TaskSubmittedForValidation")
                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                @endif
                                <div class="activity-detail">
                                    <div class="mb-2">
                                        <span
                                            class="text-job text-primary">{{ $notification->created_at->diffForHumans() }} </span>
                                        @if(is_null($notification->read_at))
                                            <span class="beep ml-3"></span>

                                            <div class="float-right dropdown">
                                                <a href="#" data-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                     style="position: absolute; transform: translate3d(0px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a href="{{route('users.notifications.markAsRead' , ['id' => $notification->id])}}"
                                                       class="dropdown-item has-icon"><i class="fas fa-eye"></i> Marquer
                                                        comme lu</a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    {{--<p>{{ $notification->data['notification_text'] }} : "<a
                                            href="{{ route('projects.show' , [$notification->data['project_id']]) }}">
                                            <b>{{ $notification->data['project_name'] }} </b></a></p>".--}}
                                    
                                    @if($notification->type === "App\Notifications\TaskSubmittedForValidation")
                                        <p> {{ $notification->data['username'] }}
                                        {{ $notification->data['notification_text'] }} : <a
                                            href="{{ route('tasks.show' , [$notification->data['task_id']]) }}">
                                            <b>{{ $notification->data['task_name'] }} </b></a></p>
                                    @elseif($notification->type === "App\Notifications\ProjectAssigned")
                                        <p> {{ $notification->data['notification_text'] }}  <b> {{ $notification->data['project_name'] }} </b> </p>
                                    @endif

                                </div>
                            </div>
                        @empty
                            <div class="card col-md-12">
                                <div class="card-body">
                                    <div class="empty-state" data-height="400" style="height: 400px;">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        <h2>Nous n'avons trouvé aucune notification.</h2>
                                        <p class="lead">
                                            Votre panier de notifications est vide.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
