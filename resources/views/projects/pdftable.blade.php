<style>
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 100px;
        font-weight: bold;

        /** Extra personal styles **/
        color: #475ea3;

        text-align: center;
        margin-bottom: 20px;
    }

    header>p {
        color: black;
    }


    .styled-table {
        margin-top: 200px;
        border-collapse: collapse;

        min-width: 100vw;
        font-size: 0.9em;
        font-family: sans-serif;

        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #475ea3;

        color: #ffffff;
        text-align: left;
    }


    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #475ea3;

    }

</style>



<body>

    <!-- Define header and footer blocks before your content -->
    <header>
        <div>
            <img src="{{  base_path().'/public/img/logo.png'}}" alt="logo" width="150px">
        </div>
        <h2>Société de transformation de métaux PAF</h2>

        <p> Z.I route du bac 2040, Radès - Tél : 70 020 620</p>

    </header>


    <!-- Wrap the content of your PDF inside a main tag -->
    <table class="styled-table">



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

</body>
