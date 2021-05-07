@extends('layouts.app')
@section('title')
Projects
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Projects</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('projects.create')}}" class="btn btn-primary form-btn">Project <i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="section-body">
        @include('flash::message')

        <div class="card card-primary">
            <div class="card-header">
                <h4 class="d-inline text-dark ">Liste des projet</h4>
                <div class="card-header-action">
                    {{-- <button class="btn btn-outline-danger"> <i class="fa fa-filter"></i> Appliquer</button>--}}
                    <a href="{{ route('projects.export') }}" class="form-btn btn btn-icon icon-left btn-success  "><i class="fas fa-file-excel"></i>
                        Exporter vers Excel</a>
                    <a href="{{ route('projects.exportToPDF') }}" class="form-btn btn btn-icon icon-left btn-primary  "><i class="fas fa-file-pdf"></i>

                        Exporter en PDF</a>
                </div>
            </div>

            <div class="card-body">
                @include('projects.table')
            </div>
        </div>
    </div>

</section>
@endsection
