<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicamentRequest;
use App\Models\Medicament;
use App\Repositories\MedicamentRepository;
use Barryvdh\DomPDF\PDF;
use Dompdf\Options;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    private $paginate = 5;

    public function index()
    {
        $title = 'Medicaments';
        $description = 'Here you can keep your entire veterinary pharmacy';
        $medicaments = Medicament::where('farm_id', '=', auth()->user()->farm_id)->paginate($this->paginate);
        return view('medicaments.index', compact('title', 'description', 'medicaments'));
    }

    public function create()
    {
        $title = 'Create new Medicament';
        return view('medicaments.create', compact('title'));
    }

    public function store(MedicamentRequest $request, MedicamentRepository $repository, PDF $PDF)
    {
        $data = $request->validated();
        $data = $repository->createThumbnail($data);
        $data = $repository->createFlyer($data, $PDF);
        $data = $repository->farmAssociate($data);
        Medicament::create($data);
        $request->session()->flash("'alert-success', 'Medicamento cadastrado !',
            'alert-danger', 'Oops! não foi possível cadastrar!'");

        return redirect()->route('medicament.index');
    }

    public function edit($id)
    {
        $title = 'Edit Medicament';
        $medicament = Medicament::find($id);
        return view('medicaments.edit', compact('medicament', 'title'));
    }

    public function update(
        Request $request, MedicamentRepository $repository,
        Medicament $medicament, PDF $PDF, $id)
    {
        $current = Medicament::find($id);
        $data = $repository->editFlyer($current, $request);
        $data = $repository->editThumbnail($current, $data);
//        $medicament->update($data);
        Medicament::updating($data);
        $request->session()->flash("'alert-success', 'Medicamento atualizado !',
            'alert-danger', 'Oops! não foi possível atualizar!'");

        return redirect()->route('medicament.index');

    }

    public function show($id)
    {
        $title = 'Medicaments details';
        $medicament = Medicament::find($id);
        return view('medicaments.show', compact('medicament', 'title'));
    }

    public function destroy(MedicamentRequest $request, $id)
    {
        $medicament = Medicament::find($id);
        Medicament::destroy($id);
        $request->session()->flash("'alert-warning', 'Medicamento Deletado !',
            'alert-danger', 'Oops! não foi possível deletar!'");

        return redirect()->route('medicament.index');
    }

    public function search()
    {
        //
    }
}
