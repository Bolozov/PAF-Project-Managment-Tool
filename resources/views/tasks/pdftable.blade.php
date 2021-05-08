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
        margin-top: 250px;
        border-collapse: collapse;

        min-width: 100vw;
        font-size: 0.9em;
        font-family: 'Arial';

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
    .page-heading{
        margin-top : 20px;
        margin-top : 20px;
        font-size:18px;

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
    <div class="page-heading">
        <h4>Liste des tâches - Imprimée le : {{ now() }}</h4>

    </div>

    </header>


    <!-- Wrap the content of your PDF inside a main tag -->
    <table class="styled-table">



        <thead>
            <tr>
                <th>Nom de la tâche</th>
                <th>Date limite</th>
                <th>Assigné à</th>
                <th>Projet</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
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

            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center">Aucune tâche trouvée.</td>
            </tr>
            @endforelse
        </tbody>

    </table>

</body>
