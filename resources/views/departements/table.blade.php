<div class="table-responsive">
    <table class="table table-striped w-100" id="departements-table">

        <thead>
        <tr>
            <th>Nom de département</th>
            <th>Résponsable</th>
            <th>Service(s)</th>
            <th>Effectif</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($departements as $departement)
            <tr>
                <td>{{ $departement->name }}</td>
                <td>
                    @if(! empty($departement->chefDepartement))

                        <a href="{!! route('users.show', [$departement->chefDepartement->id ]) !!}">
                            {{ $departement->chefDepartement->name }}</a>

                    @else
                        --

                    @endif
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                            data-target="#servicesModal-{{$departement->id}}">
                        Afficher ( {{ count($departement->services) }} )
                    </button>
                    <div class="modal fade" data-backdrop="false" role="dialog"
                         id="servicesModal-{{$departement->id}}">

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Liste des Services</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @forelse($departement->services as $service)
                                        <div class="list-unstyled list-unstyled-border mt-4">
                                            <div class="media">
                                                <div class="media-icon"><i class="far fa-circle"></i></div>
                                                <div class="media-body">
                                                    <h6>{{$service->name ?? '' }}</h6>
                                                    <p>{{$service->chefService->name ?? ''}}

                                                        - {{ $service->chefService->email ?? '' }}

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        Aucun service est associé à ce département.
                                    @endforelse
                                </div>
                                <div class="modal-footer bg-whitesmoke br">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </td>
                <td>
                    {{ $departement->users->count() }}
                </td>

                <td class=" text-center">
                    {!! Form::open(['route' => ['departements.destroy', $departement->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('departements.show', [$departement->id]) !!}"
                           class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
                        <a href="{!! route('departements.edit', [$departement->id]) !!}"
                           class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger
                        action-btn delete-btn', 'onclick' => 'return confirm("Êtes-vous sûr ? cette action est irréversible.")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>
<div class="float-right">
    {{ $departements->links() }}


</div>
