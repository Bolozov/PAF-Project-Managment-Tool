<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nom du département:') !!}
    <p>{{ $departement->name }}</p>
</div>

<!-- Responsible Id Field -->
<div class="form-group">
    {!! Form::label('responsible','Responsable : ') !!}
    <p>{{ $departement->chefDepartement->name }}</p>
</div>
<!-- Responsible Id Field -->
<div class="form-group">
    {!! Form::label('Services','Services : ') !!}

    @forelse ($departement->services as $service )
        {{ $service->name }}


    @empty
        vide.
    @endforelse
</div>




