<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Role Field -->
<div class="form-group">
    {!! Form::label('role','Role') !!}
    <p>{{ $user->roles()->pluck('name')[0] }}</p>

</div>
@if(!empty($user->department->name))
    <!-- Departement Field -->
    <div class="form-group">
        {!! Form::label('department', 'Département:') !!}
        <p>{{ $user->department->name}}</p>

    </div>
@endif

@if(!empty($user->service->name))

    <!-- Service Field -->
    <div class="form-group">
        {!! Form::label('service', 'Service:') !!}
        <p>{{ $user->service->name}}</p>

    </div>

@endif



<!-- Cin Field -->
<div class="form-group">
    {!! Form::label('cin', 'Numéro carte d\'identité') !!}
    <p>{{ $user->cin }}</p>
</div>

<!-- Num Tel Field -->
<div class="form-group">
    {!! Form::label('num_tel', 'Numéro de téléphone') !!}
    <p>{{ $user->num_tel ?? 'Vide' }}</p>
</div>
