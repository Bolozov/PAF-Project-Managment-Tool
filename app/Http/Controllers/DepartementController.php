<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Models\Departement;
use App\Models\User;
use Exception;
use Flash;
use Illuminate\Http\Request;
use PDF;
use Response;

class DepartementController extends AppBaseController
{
    /**
     * Display a listing of the Departement.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Departement $departements */
        $departements = Departement::with('chefDepartement', 'services', 'users')->paginate(5);
        // dd($departements);
        return view('departements.index')
            ->with('departements', $departements);
    }

    /**
     * Show the form for creating a new Departement.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::role('chef de département')->pluck('name', 'id');
        return view('departements.create');
    }

    /**
     * Store a newly created Departement in storage.
     *
     * @param CreateDepartementRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartementRequest $request)
    {
        $input = $request->all();

        /** @var Departement $departement */
        $departement = Departement::create($input);

        Flash::success('Le département est créé avec succès.');

        return redirect(route('departements.index'));
    }

    /**
     * Display the specified Departement.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Departement $departement */
        $departement = Departement::with('chefDepartement', 'services', 'users')->get()->find($id);

        if (empty($departement)) {
            Flash::error('Département non trouvé.');

            return redirect(route('departements.index'));
        }

        return view('departements.show')->with('departement', $departement);
    }

    /**
     * Show the form for editing the specified Departement.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Departement $departement */
        $departement = Departement::find($id);
        $users = User::role('chef de département')->pluck('name', 'id');

        if (empty($departement)) {
            Flash::error('Département non trouvé.');

            return redirect(route('departements.index'));
        }

        return view('departements.edit')->with(['departement' => $departement, 'users' => $users]);
    }

    /**
     * Update the specified Departement in storage.
     *
     * @param int $id
     * @param UpdateDepartementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartementRequest $request)
    {
        /** @var Departement $departement */
        $departement = Departement::find($id);

        if (empty($departement)) {
            Flash::error('Département non trouvé.');

            return redirect(route('departements.index'));
        }

        $departement->fill($request->all());
        $departement->save();

        Flash::success('Département ' . $departement->name . ' mis à jour');

        return redirect(route('departements.index'));
    }

    /**
     * Remove the specified Departement from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     *
     */
    public function destroy($id)
    {
        /** @var Departement $departement */
        $departement = Departement::find($id);

        if (empty($departement)) {
            Flash::error('Département non trouvé.');

            return redirect(route('departements.index'));
        }

        $departement->delete();

        Flash::success('Le département est supprimé.');

        return redirect(route('departements.index'));
    }
    public function exportToPDF()
    {
        $departements = Departement::with('chefDepartement', 'services', 'users')->paginate(5);

        view()->share('departements', $departements);

        $pdf = PDF::loadView('departements.pdftable')->setPaper('a4', 'landscape');

        // download PDF file with download method
        return $pdf->download('Départements_PAF_' . now() . '.pdf');

    }
}
