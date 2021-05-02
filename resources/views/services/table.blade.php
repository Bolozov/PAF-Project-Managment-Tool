<div class="table-responsive">
    <table class="table" id="services-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Résponsable</th>
            <th>Département</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>{{ $service->chefService->name }}</td>
                <td>{{ $service->departement->name }}</td>
                <td class=" text-center">
                    {!! Form::open(['route' => ['services.destroy', $service->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('services.show', [$service->id]) !!}" class='btn btn-light action-btn '><i
                                class="fa fa-eye"></i></a>
                        <a href="{!! route('services.edit', [$service->id]) !!}"
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
    {{ $services->links() }}


</div>
