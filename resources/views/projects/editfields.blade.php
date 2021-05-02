<!-- Ref Project Field -->
<div class="form-group col-sm-4">
    <label for="ref_project"> Référence du projet:</label>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="" id="ref_project" name="ref_project"
               value="{{$project->ref_project}}">

        <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="getRndInteger()">Générer</button>
        </div>
    </div>
    <script>
        function getRndInteger(min, max) {
            let randomRef = Math.floor(Math.random() * (9999 - 999999)) + 999999;
            $('#ref_project').val(randomRef)
        }

    </script>

</div>

<!-- Name Project Field -->
<div class="form-group col-sm-4">
    <label for="name_project">Nom du Projet:</label>
    <input class="form-control" name="name_project" type="text" id="name_project" value="{{$project->name_project}}">
</div>

<!-- Budget Project Field -->
<div class="form-group col-sm-4">
    <label for="budget_project">Budget:</label> <sup>en DT</sup>
    <input class="form-control" name="budget_project" type="number" id="budget_project"
           value="{{$project->budget_project}}">
</div>

<div class="form-group col-sm-3">
    <label for="departement">Département:</label>
    <select class="form-control" name="departement_id">
        @foreach($departements as $departement)
            <option
                value="{{$departement->id}}" {{ $departement->id == $project->departement->id ? 'selected' : '' }}>{{$departement->name}}</option>
        @endforeach
    </select>


</div>
<div class="form-group col-sm-3">
    <label for="service">Service:</label>
    <select class="form-control" name="service_id">
        @foreach($services as $service)
            <option
                value="{{$service->id}}" {{ $service->id == $project->service->id ? 'selected' : '' }}>{{$service->name}}</option>
        @endforeach
    </select>


</div>

<div class="form-group col-sm-6">
    <label for="team">Équipe:</label>
    <select class="form-control select2 select_multiple" name="users_id[]" multiple="multiple">
        @foreach($users as $user)
            <option
                value="{{$user->id}}" {{ $project->users->containsStrict('id', $user->id) ? 'selected' : ' '}} >{{$user->name}}</option>
        @endforeach

    </select>

</div>


<!-- Start Date Project Field -->
<div class="form-group col-sm-6">
    <label for="start_date_project">Date de début:</label>
    <input class="form-control datepicker" id="start_date_project" name="start_date_project" type="date"
           value="{{$project->start_date_project->format('Y-m-d')}}">

</div>


<!-- End Date Project Field -->
<div class="form-group col-sm-6">
    <label for="end_date_project">Date de fin:</label>
    <input class="form-control" id="end_date_project" name="end_date_project" type="date"
           value="{{$project->end_date_project->format('Y-m-d')}}">

</div>

<!-- Responsible Id Project Field -->
<div class="form-group col-sm-6">
    <label for="responsible_id_project">Responsable du projet:</label>
    <select class="form-control" id="responsible_id_project" name="responsible_id_project">
        @foreach($chefProjectUsers as $chefProjectUser)
            <option
                value="{{$chefProjectUser->id}}" {{ $chefProjectUser->id == $project->responsible->id ? 'selected' : '' }}>{{$chefProjectUser->name}}</option>
        @endforeach
    </select>

</div>
<!-- Status Project Field -->

<div class="form-group col-sm-6">
    <label for="responsible_id_project">Status du projet:</label>
    <select class="form-control" id="status_project" name="status_project">
        <option value="créé" {{ $project->status_project == "créé" ? 'selected' : ' ' }}>Créé</option>
        <option value="en cours" {{ $project->status_project == "en cours" ? 'selected' : ' ' }}>En cours</option>
        <option value="terminé" {{ $project->status_project == "terminé" ? 'selected' : ' ' }}>Terminé</option>
        <option value="annulé" {{ $project->status_project == "annulé" ? 'selected' : ' ' }}>Annulé</option>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('projects.index') }}" class="btn btn-light">Cancel</a>
</div>
