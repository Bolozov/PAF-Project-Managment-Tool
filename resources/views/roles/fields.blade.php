<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nom du rôle :') !!}

    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<div class="form-group col-sm-6">
    @if(Route::is('roles.edit'))
        {!! Form::label('permissions', 'Autorisations associées:') !!} <br>
        @foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                @lang('roles.'.$value->name)
            </label>
            <br/>
        @endforeach

    @else

        {!! Form::label('permissions', 'Autorisations associées:') !!} <br>


        @foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                @lang('roles.'.$value->name)</label>
            <br/>
        @endforeach

    @endif

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('roles.index') }}" class="btn btn-light">Annuler</a>
</div>
