@extends('layouts.app')
@section('title')
Validation d'une tâche
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading m-0">Demande de validation : tâche {{$task->name}}</h3>
        <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
    <div class="content">
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body ">
                            {!! Form::model($task, ['route' => ['task.submit-validation', $task->id], 'method' => 'post', 'files' => true]) !!}
                            <div class="row">

                                <!-- Verification File Field -->
                                <div class="form-group col-sm-6">
                                    {!! Form::label('', 'Fichier de vérification:') !!}

                                    <div class="custom-file">
                                        <input type="file"  id="verification_file" name="verification_file">
                                    </div>
                                    <span class="form-text text-muted"> <span class="text-danger">*</span> Extensions autorisées: png, jpg, jpeg, pdf | taille maximale du fichier: 2 MO</span>


                                </div>

                                <div class="clearfix"></div>

                                <!-- Submit Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::submit('Soumettre pour validation', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('projects.index') }}" class="btn btn-light">Annuler</a>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
