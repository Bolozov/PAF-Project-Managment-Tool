<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Department Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Sauvgarder', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('departements.index') }}" class="btn btn-light">Annuler</a>
</div>
