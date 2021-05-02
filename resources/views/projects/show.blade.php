@extends('layouts.app')
@section('title')
    Détails du projet
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Détails du projet</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('projects.task.create' , Request::segment(2)) }}" class="btn btn-success float-right mr-2"><i
                        class="fas fa-plus"></i> Ajouter une tâche </a>
                <a href="{{ route('projects.index') }}" class="btn btn-primary float-right">Retour</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            @include('projects.show_fields')

        </div>
    </section>
@endsection
