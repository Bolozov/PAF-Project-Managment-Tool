<div class="card card-primary ">

    <div class="card-body">
        <div class="section-title mt-2 mb-2">Liste des tâches <sup> ({{  count($project->tasks)  }})</sup></div>

        <div class="row">
            <!-- Name Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('name_project', 'Nom du Projet:') !!}
                <p>{{ $project->name_project }}</p>
            </div>
            <!-- Budget Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('budget_project', 'Budget Attribué:') !!}
                <p>{{ number_format($project->budget_project, 2, ',', ' ') }} DT</p>
            </div>

            <!-- Budget left Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('budget_project', 'Budget Restant:') !!}
                <p>{{ number_format($leftBalance, 2, ',', ' ') }} DT</p>
            </div>
            <!-- Status Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('status_project', 'Status Project:') !!}
                <p>
                    @switch($project->status_project)

                        @case('créé')

                        <span class="badge badge-primary">Créé</span>

                        @break
                        @case('en cours')

                        <span class="badge badge-info">En Cours</span>

                        @break
                        @case('terminé')

                        <span class="badge badge-success">Terminé</span>

                        @break
                        @case('annulé')

                        <span class="badge badge-danger">Anuulé</span>

                        @break

                        @default
                        <span> -- </span>
                    @endswitch
                </p>
            </div>
            {{--  créé,en cours,en attente de validation,validée --}}

        </div>
        <div class="row">
            <div class="table-responsive w-100">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Budget <sup>DT</sup></th>
                        <th>Assigné à</th>
                        <th>Créé le</th>
                        <th>Date limite</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($project->tasks as $task)
                        <tr class="{{ today()->format('Y-m-d') > $task->deadline->format('Y-m-d')  ? 'table-danger' : ''}}
                        {{ $task->deadline->format('Y-m-d') <= \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d') && $task->deadline->format('Y-m-d') >= \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') ? 'table-warning' : ''   }}">




                            <td>{{$task->name}}</td>
                            <td>
                                {{ number_format($task->budget, 1, ',', ' ') }}

                            </td>
                            <td> {{$task->user->name}}</td>
                            <td>
                                {{$task->created_at->format('d/m/Y')}}
                            </td>
                            <td>{{$task->deadline ? $task->deadline->format('d/m/Y')  : ''}}</td>
                            <td>

                                @switch($task->status)

                                    @case('créé')

                                    <span class="badge badge-primary">Créé</span>

                                    @break
                                    @case('en cours')

                                    <span class="badge badge-info">En Cours</span>

                                    @break
                                    @case('validée')

                                    <span class="badge badge-success">Validée</span>

                                    @break
                                    @case('en attente de validation')

                                    <span class="badge badge-warning">à valider</span>

                                    @break

                                    @default
                                    <span> -- </span>
                                @endswitch

                            </td>
                            <td>
                                @if($task->status == "créé")
                                    <a href="{{ route('projects.task.start' , $task->id) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" title="" data-original-title="Lancer la tâche" ><i class="far fa-arrow-alt-circle-up"></i></a>
                                @endif
                                    @if($task->status == "en cours")
                                        @can('valiate-projects-task')
                                            <a href="{{route('task.validate', $task->id)}}" class="btn btn-icon btn-success" data-toggle="tooltip" title="" data-original-title="Soumettre le fichier de validation" > <span class="fas fa-check-circle"></span></a>

                                        @endcan
                                    @endif
                                @if($task->status == "en attente de validation")
                                        @can('valiate-projects-task')
                                            <a href="{{route('task.perform-validation', $task->id)}}" class="btn btn-secondary">Valider</a>

                                        @endcan
                                @endif
                                <a href="{{ route('tasks.show' , $task->id) }} " class="btn  btn-icon btn-info" data-toggle="tooltip" title="" data-original-title="Detail"><i class="fas fa-search"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>
