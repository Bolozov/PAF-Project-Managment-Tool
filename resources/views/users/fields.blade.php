<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nom d\'utilisateur :') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email :') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('departement', 'Département:') !!}
    {!! Form::select('departement_id',$departments,null, ['class' => 'form-control' , 'placeholder' => '']) !!}

</div>
<div class="form-group col-sm-6">
    {!! Form::label('service', 'Service:') !!}
    {!! Form::select('service_id',$services,null, ['class' => 'form-control' , 'placeholder' => '']) !!}

</div>
@if(Route::is('users.create'))
    <!-- Role Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('role', 'Sélectionnez un role:') !!}
        {!! Form::select('role',$roles,null, ['class' => 'form-control']) !!}

    </div>
@elseif (Route::is('users.edit'))
    <!-- Role Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('role', 'Sélectionnez un role:') !!}
        {!! Form::select('role',$roles, $user->roles()->pluck('name')[0], ['class' => 'form-control']) !!}

    </div>
@endif



<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Mot de passe:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Cin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cin', 'Numéro carte d\'identité:') !!}
    {!! Form::number('cin', null, ['class' => 'form-control' , "pattern"=>"\d*" , "maxlength"=>"8"]) !!}
</div>

<!-- Num Tel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num_tel', 'Numéro de téléphone:') !!}
    {!! Form::number('num_tel', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Valider', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-light">Annuler</a>
</div>


