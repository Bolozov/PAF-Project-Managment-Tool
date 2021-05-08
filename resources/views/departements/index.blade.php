@extends('layouts.app')
@section('title')
Départements
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Départements</h1>

        <div class="section-header-breadcrumb">
            <a href="{{ route('departements.create')}}" class="btn btn-primary form-btn">Ajouter<i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="section-body">
        @include('flash::message')


        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark ">Liste des départements</h4>
                <div class="card-header-action">

                    <a href="{{ route('departements.exportToPDF') }}" class="form-btn btn btn-icon icon-left btn-primary  "><i class="fas fa-file-pdf"></i>

                        Exporter en PDF</a>

                </div>

            </div>




            <div class="card-body">
                @include('departements.table')
            </div>
        </div>
    </div>

</section>
@endsection
