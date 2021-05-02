<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $service->name }}</p>
</div>

<!-- Responsible Id Field -->
<div class="form-group">
    {!! Form::label('responsible', 'Responsible Id:') !!}
    <p>{{ $service->chefService->name }}</p>

</div>

<!-- Departement Id Field -->
<div class="form-group">
    {!! Form::label('departement', 'Département:') !!}
    <p>{{ $service->departement->name }}</p>

</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $service->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $service->updated_at }}</p>
</div>

