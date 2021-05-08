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
    .m-2{
        margin-right : 5px;
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
        <h4>Liste des rôles - Imprimée le : {{ now() }}</h4>

    </div>

    </header>


    <!-- Wrap the content of your PDF inside a main tag -->
    <table class="styled-table">



        <thead class="text-center">
            <tr>
                <th>Nom de Rôle</th>
                <th>Permissions</th>

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

            </tr>
            @endforeach
        </tbody>


    </table>

</body>
