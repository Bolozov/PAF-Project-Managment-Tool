@extends('layouts.app')
@section('title')
    Départements
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('models/departements.plural')</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('departements.create')}}" class="btn btn-primary form-btn">Ajouter<i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message') @include('flash::message')


            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark ">Liste des départements</h4>
                </div>

                <div class="card-body">
                    @include('departements.table')
                </div>
            </div>
        </div>

    </section>
@endsection
