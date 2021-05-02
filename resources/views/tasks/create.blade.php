@extends('layouts.app')
@section('title')
    Create Task
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h5 class="m-0">Nouvelle tâche </h5>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            @include('flash::message')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">

                                <div class="section-title mt-3 mb-3">Projet : {{ $project->name_project }} | Budget
                                    Restant : {{ number_format($leftBalance, 1, ',', ' ') }} <sup>DT</sup></div>
                                {!! Form::open(['route' => 'tasks.store', 'files' => true]) !!}
                                <div class="row">
                                    @include('tasks.fields')
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
