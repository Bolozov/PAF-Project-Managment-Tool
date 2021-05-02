@extends('layouts.app')
@section('title')
    Tâches
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tâches</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card card-primary">

                <div class="card-header">
                    <h4 class="text-dark">Liste des tâches</h4>
                    @can('filter-tasks')
                        
                    <div class="card-header-action">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" aria-expanded="false">Filtre</a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(68px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="{{ route('tasks.index' , ["search" => 'créé']) }}" class="dropdown-item has-icon"><i class="fas fa-circle text-primary"></i> Créé</a>
                                <a href="{{ route('tasks.index' , ["search" => 'en cours']) }}" class="dropdown-item has-icon"><i class="fas fa-circle text-info"></i> En cours</a>
                                <a href="{{ route('tasks.index' , ["search" => 'en attente de validation']) }}" class="dropdown-item has-icon"><i class="fas fa-circle text-warning"></i> À valider</a>
                                <a href="{{ route('tasks.index' , ["search" => 'validée']) }}" class="dropdown-item has-icon"><i class="fas fa-circle text-success"></i> Validéé</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{route('tasks.index')}}" class="dropdown-item">Voir tout</a>
                            </div>
                        </div>
                    </div>
                     @endcan
                </div>
                <div class="card-body">
                    @include('tasks.table')
                </div>
            </div>
        </div>

    </section>
@endsection

