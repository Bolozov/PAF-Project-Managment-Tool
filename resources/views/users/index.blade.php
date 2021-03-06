@extends('layouts.app')
@section('title')
Utilisateurs
@endsection
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Utilisateurs</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('users.create')}}" class="btn btn-primary form-btn">Ajouter <i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="section-body">
        @include('flash::message') @include('flash::message')

        <div class="card card-primary">

            <div class="card-header">
                <h4 class="text-dark ">Liste des utilisateurs</h4>

                <form class="card-header-form" action="{{ route('user.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Nom , Email , CIN ..">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="card-header-action ml-3">
                    <a href="{{ route('users.exportToPDF') }}" class="form-btn btn btn-icon icon-left btn-primary  "><i class="fas fa-file-pdf"></i>
                        Exporter en PDF</a>
                </div>


            </div>

            <div class="card-body">

                @include('users.table')
            </div>
        </div>
    </div>

</section>
@endsection
