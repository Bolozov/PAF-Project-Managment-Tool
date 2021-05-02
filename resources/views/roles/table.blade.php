<div class="table-responsive ">
    <table class="table table-striped w-100 " id="roles-table">

        <thead class="text-center">
        <tr>
            <th>Nom de Rôle</th>
            <th>Permissions</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td class="w-50">

                    @forelse($role->permissions as $permission)
                        <span class="m-2">@lang('roles.'.$permission->name) ,</span>
                    @empty
                        Aucune permission associée à ce rôle.
                    @endforelse
                </td>
                <td class=" text-center">
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('roles.show', [$role->id]) !!}" class='btn btn-light action-btn '><i
                                class="fa fa-eye"></i></a>
                        <a href="{!! route('roles.edit', [$role->id]) !!}"
                           class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="float-right">
    {{ $roles->links() }}


</div>
