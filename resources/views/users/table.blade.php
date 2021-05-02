<div class="">

    <table class="table table-striped w-100" id="users-table">

        <thead>
        <tr>
            <th>Nom</th>
            {{-- <th>@lang('models/users.fields.email')</th> --}}
            <th>CIN</th>
            <th>Rôle</th>
            <th>Département</th>
            <th>Service</th>
            <th>Derniere connexion</th>
            {{-- <th>@lang('models/users.fields.num_tel')</th> --}}
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                {{-- <td>{{ $user->email }}</td> --}}
                <td>{{ $user->cin }}</td>
                <td>
                    @if ($user->hasRole('Admin'))
                        <div class="badge badge-danger">Admin</div>
                    @elseif($user->hasRole('Chef de projet'))
                        <div class="badge badge-warning">Chef de Projet</div>
                    @elseif($user->hasRole('Chef de département'))
                        <div class="badge badge-success">Chef de département</div>
                    @elseif($user->hasRole('Chef de service'))
                        <div class="badge badge-primary">Chef de service</div>
                    @else
                        <div class="badge badge-info">Utilisateur</div>
                    @endif
                </td>
                <td>{{ !empty($user->department->name) ?  $user->department->name : '--' }}</td>


                <td>{{ !empty($user->service->name) ? $user->service->name : '--' }}</td>


                <td>{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Inactif' }}</td>

                {{-- <td>{{ $user->num_tel }}</td> --}}
                <td class=" text-center">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-light action-btn '><i
                                class="fa fa-eye"></i></a>
                        <a href="{!! route('users.edit', [$user->id]) !!}"
                           class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger
                        action-btn delete-btn', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="float-right">
    {{ $users->links() }}

</div>

