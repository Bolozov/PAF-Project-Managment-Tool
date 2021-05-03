<table>

    <thead>
        <tr>
            <th>Référence</th>
            <th>Nom</th>
            <th>Budget (DT) </th>
            <th>Date début</th>
            <th>Date Fin</th>
            <th>Statut</th>
            <th>Département</th>
            <th>Résponsable</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr class={{ today()->format('Y-m-d') > $project->end_date_project   ? 'table-danger' : ''  }}>
            <td>{{ $project->ref_project }}</td>
            <td>{{ $project->name_project }}</td>
            <td>{{ number_format($project->budget_project, 1, ',', ' ') }}</td>
            <td>{{ $project->start_date_project->format('d/m/Y')}}</td>
            <td>{{ $project->end_date_project->format('d/m/Y')}}</td>

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
            <td> {{ $project->departement->name }} </td>
            <td>{{ $project->responsible->name}}</td>



        </tr>
        @endforeach
    </tbody>
</table>
