@extends('layouts.app')
@section('title')
    Détails de la tâche
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Détails de la tâche</h1>
            <div class="section-header-breadcrumb">
                <a href="javascript:history.back()"
                   class="btn btn-primary form-btn float-right">Retour</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('tasks.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script >
        document.addEventListener("DOMContentLoaded", function(event) {
            Chocolat(document.querySelectorAll('.chocolat-parent .chocolat-image'))
        })
    </script>
    @endsection
