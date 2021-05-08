<div class="table-responsive mw-100">


    <table class="table table-striped w-100" id="projects-table">

        <thead>
        <tr>
            <th>Référence</th>
            <th>Nom</th>
            <th>Budget <sup>(DT)<sup></th>
            <th>Intervalle</th>
            <th>Progrès</th>
            <th>Status</th>
            @hasrole('Admin')
            <th> Département</th>
            @endhasrole
            <th>Résponsable</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr class={{ today()->format('Y-m-d') > $project->end_date_project   ? 'table-danger' : ''  }}>
                <td>{{ $project->ref_project }}</td>
                <td>{{ $project->name_project }}</td>
                <td>{{ number_format($project->budget_project, 1, ',', ' ') }}</td>
                <td>{{ $project->start_date_project->format('d/m/Y')}}
                    -{{ $project->end_date_project->format('d/m/Y') }}</td>
                <td>
                    @if($project->tasks_count > 0)
                        <span
                            data-toggle="tooltip" title=""
                              data-original-title=" {{ $project->project_finished_tasks_count }} / {{ $project->tasks_count }} Tâches">
                            {{ round(($project->project_finished_tasks_count / $project->tasks_count) * 100 ,2) }} %
                        </span>
                    @else
                        <span data-toggle="tooltip" title
                              data-original-tittle=" {{ $project->project_finished_tasks_count }} / {{ $project->tasks_count }}">
                            0 %
                        </span>
                    @endif
                </td>
                <td>
                    @switch($project->status_project)

                        @case('créé')

                        <span class="badge badge-primary">Créé</span>

                        @break
                        @case('en cours')

                        <span class="badge badge-info">En Cours</span>

                        @break
                        @case('terminé')

                        <span class="badge badge-success">Terminé</span>

                        @break
                        @case('annulé')

                        <span class="badge badge-danger">Anuulé</span>

                        @break

                        @default
                        <span> -- </span>
                    @endswitch

                </td>
                @hasrole('Admin')
                <td> {{ $project->departement->name }} </td>
                @endhasrole
                <td>{{ $project->responsible->name}}</td>


                <td class=" text-center">
                    {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete' , 'id' => 'deleteForm']) !!}

                    <div class='btn-group'>
                        <a href="{!! route('projects.task.create', [$project->id]) !!}"
                           class='btn btn-primary action-btn ' data-toggle="tooltip" title=""
                           data-original-title="Ajouter une tâche"><i class="fa fa-plus"></i></a>
                        <a href="{!! route('projects.show', [$project->id]) !!}" class='btn btn-light action-btn'
                           data-toggle="tooltip" title="" data-original-title="Voir les détails"><i
                                class="fa fa-eye"></i></a>

                        <a href="{!! route('projects.edit', [$project->id]) !!}"
                           class='btn btn-warning action-btn edit-btn ' data-toggle="tooltip" title=""
                           data-original-title="Modifier le projet"><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'confirmDelete(event)']) !!}

                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="float-right">
    {{ $projects->links() }}


</div>
@section('page_js')
<script>
    function confirmDelete(event) {
        event.preventDefault();
        console.log('confirm delete triggered');
        Swal.fire({
            title: 'Êtes-vous sûr?'
            , text: "Cette action est IRRÉVERSIBLE!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Supprimer'
            , cancelButtonText: 'Annuler'

        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#deleteForm').submit();

            }
        })
    }

</script>

@endsection

