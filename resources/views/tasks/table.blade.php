<div class="table-responsive">
    <table class="table" id="tasks-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date limite</th>
            <th>Assigné à</th>
            <th>Projet</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->deadline->format('d/m/Y') }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->project->name_project }}</td>
                <td>
                    @switch($task->status)

                        @case('créé')

                        <span class="badge badge-primary">Créé</span>

                        @break
                        @case('en cours')

                        <span class="badge badge-info">En Cours</span>

                        @break
                        @case('validée')

                        <span class="badge badge-success">Validée</span>

                        @break
                        @case('en attente de validation')

                        <span class="badge badge-warning">à valider</span>

                        @break

                        @default
                        <span> -- </span>
                    @endswitch</td>
                <td class=" text-center">
                    {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tasks.show', [$task->id]) !!}" class='btn btn-light action-btn '><i
                                class="fa fa-eye"></i></a>
                        <a href="{!! route('tasks.edit', [$task->id]) !!}"
                           class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("Are you sure want to delete this record ?")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $tasks->links() }}


    </div>

</div>
