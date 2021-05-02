<div class="card card-primary ">

    <div class="card-body">
        <div class="section-title mt-2 mb-2">Informations</div>

        <div class="row">
            <!-- Ref Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('ref_project', 'Référence du Projet:') !!}
                <p>{{ $project->ref_project }}</p>
            </div>
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
            <!-- Status Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('status_project', 'L\'état du projet:') !!}
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


        </div>
        <div class="row">
            <!-- Start Date Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('start_date_project', 'Date de démarage:') !!}
                <p>{{ $project->start_date_project->format('d/m/Y') }}</p>
            </div>
            <!-- End Date Project Field -->
            <div class="form-group col-md-3">
                {!! Form::label('end_date_project', 'Date prévu de fin :') !!}
                <p>{{ $project->end_date_project->format('d/m/Y') }}
                </p>
            </div>
            <!--departement Project Field -->

            <div class="form-group col-md-3">
                {!! Form::label('departement', 'Département:') !!}

                <p>{{ $project->departement->name }}</p>
            </div>

            <!-- service Field -->

            <div class="form-group col-md-3">
                {!! Form::label('service', 'Service :') !!}

                <p>{{ $project->service->name }}</p>

            </div>

        </div>


    </div>
</div>


<div class="card card-primary mt-4">


    <div class="card-body ">
        <div class="section-title mt-2 mb-2">Équipe en charge <sup class="text-muted">{{ count($project->users)  }}
                membres</sup></div>


        <div class="row">
            <div class="col-6 col-sm-3 col-lg-3 mb-4 ">
                <div class="avatar-item text-center ">
                    <img alt="image" src="{{ $project->responsible->TeamAvatarUrl }}"
                         class="img-fluid rounded-circle mb-2" data-toggle="tooltip" title=""
                         data-original-title="{{ $project->responsible->name }}">


                    <div class="user-details">
                        <div class="user-name mb-1">{{ $project->responsible->name }}</div>

                        <div class="text-job text-primary">{{ $project->responsible->getRoleNames()[0] }}</div>

                    </div>

                </div>
            </div>

            @forelse ($project->users as $user )
                @if ($user->id !== $project->responsible->id)
                    <div class="col-6 col-sm-3 col-lg-3 mb-4 mx-auto">
                        <div class="avatar-item text-center">
                            <img alt="image" src="{{ $user->TeamAvatarUrl }}" class="img-fluid rounded-circle mb-2"
                                 data-toggle="tooltip" title="" data-original-title="{{ $user->name }}">

                            <div class="user-details">
                                <div class="user-name mb-1">{{ $user->name }}</div>

                                <div class="text-job text-muted">{{ $user->getRoleNames()[0] }}</div>

                            </div>

                        </div>
                    </div>

                @endif

            @empty
                Aucun membre.
            @endforelse
        </div>
    </div>
</div>
