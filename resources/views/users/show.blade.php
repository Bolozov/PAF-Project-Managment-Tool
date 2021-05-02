@extends('layouts.app')
@section('title')
    Détails utilisateur
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Détails de utilisateur : {{ $user->name }} </h1>

            <div class="section-header-breadcrumb">
                <a href="{{ route('users.index') }}"
                   class="btn btn-primary form-btn float-right">Retour</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('users.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection

