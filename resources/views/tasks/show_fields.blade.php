<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $task->name }}</p>
</div>

<!-- Deadline Field -->
<div class="form-group">
    {!! Form::label('deadline', 'Deadline:') !!}
    <p>{{ $task->deadline->format('d/m/Y') }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Assigné à:') !!}
    <p>{{ $task->user->name }}</p>
</div>

<!-- Project Id Field -->
<div class="form-group">
    {!! Form::label('project_id', 'Projet:') !!}
    <p>{{ $task->project->name_project }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>
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
    </p>
</div>

@if(!empty($task->verification_file))
    <!-- Verification File Field -->
    <div class="form-group">
        {!! Form::label('verification_file', 'Fichier de vérification:') !!} <br>
        @if(substr($task->verification_file, -3) === "pdf")
            <a href="{{ asset($task->verification_file) }}" download> <span class="fas fa-file-pdf"></span> Télécharger
                le fichier de vérification</a>
        @else
            <div class="chocolat-parent">
                <a class="chocolat-image" href="{{ asset($task->verification_file) }}" title="{{ $task->name}}">
                    <img width="300" src="{{ asset($task->verification_file) }}"/>
                </a>
            </div>
        @endif
    </div>
@endif
@if(!empty($task->note))
    <!-- Note Field -->
    <div class="form-group">
        {!! Form::label('note', 'Note:') !!}
        <p>{!! ($task->note) !!}</p>
    </div>
@endif

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Ajoutée à:') !!}
    <p>{{ $task->created_at }}</p>
</div>





