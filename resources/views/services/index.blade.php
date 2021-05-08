@extends('layouts.app')
@section('title')
    Services
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Services</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('services.create')}}" class="btn btn-primary form-btn">Service <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message') @include('flash::message')
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark ">Liste des services</h4>
                    <div class="card-header-action">

                        <a href="{{ route('services.exportToPDF') }}" class="form-btn btn btn-icon icon-left btn-primary  "><i class="fas fa-file-pdf"></i>
                            Exporter en PDF</a>

                    </div>

                </div>
                <div class="card-body">
                    @include('services.table')
                </div>
            </div>
        </div>

    </section>
@endsection
