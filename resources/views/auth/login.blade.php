@extends('layouts.auth_app')
@section('title')
    Connexion
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Connexion</h4></div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                {{-- @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="form-group">
                    <label for="cin">Numéro CIN </label>
                    <input aria-describedby="cinHelpBlock" id="cin" type="text"
                           class="form-control{{ $errors->has('cin') ? ' is-invalid' : '' }}" name="cin"
                           placeholder="Entrez votre identifiant" tabindex="1"
                           value="{{ (Cookie::get('cin') !== null) ? Cookie::get('cin') : old('cin') }}" autofocus
                           required>
                    <div class="invalid-feedback">
                        {{ $errors->first('cin') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Mot de passe</label>
                        <div class="float-right">
                            <a href="#" class="text-small" data-toggle="tooltip" title=""
                               data-original-title="Contactez l'administrateur pour récupérer vos informations d'identification.">
                                Mot de passe oublié?
                            </a>
                        </div>
                    </div>
                    <input aria-describedby="passwordHelpBlock" id="password" type="password"
                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                           placeholder="Enter Password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                           tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                               id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Garder ma session active ?</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Connexion
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
