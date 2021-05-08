@extends('layouts.app')
@section('title')
Roles
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Roles</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('roles.create')}}" class="btn btn-primary form-btn">Role <i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="section-body">
        @include('flash::message')
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="d-inline text-dark ">Liste des rôles</h4>
                <div class="card-header-action">

                    <a href="{{ route('roles.exportToPDF') }}" class="form-btn btn btn-icon icon-left btn-primary  "><i class="fas fa-file-pdf"></i>
                        Exporter en PDF</a>

                </div>
            </div>


            <div class="card-body">
                @include('roles.table')
            </div>
        </div>
    </div>

</section>
@endsection
