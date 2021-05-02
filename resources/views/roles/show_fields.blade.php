<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nom de rôle:') !!}
    <p>{{ $role->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {!! Form::label('permissions', 'Autorisations associées:') !!} <br>

    @forelse($rolePermissions as $permission)
        <span class="m-2">@lang('roles.'.$permission->name) ,</span>
    @empty
        <p>Aucune autorisation attribuée à ce rôle.</p>
    @endforelse


</div>


