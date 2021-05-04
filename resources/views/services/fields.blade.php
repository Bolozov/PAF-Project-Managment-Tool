<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nom:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

{{-- <!-- Responsible Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('responsible_id', 'Résponsable:') !!}
    {!! Form::select('responsible_id', $users, null, ['class' => 'form-control']) !!}

</div> --}}

<!-- Departement Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('departement_id', 'Département:') !!}
    {!! Form::select('departement_id', $departementItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
</div>
