<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkerTeachingModel;
use Illuminate\Validation\ValidationException;
use App\Repositories\WorkerTeachingRepository;

class WorkerTeachingController extends Controller
{
    private $workerTeachingRepository;

    public function __construct()
    {
        $this->workerTeachingRepository = new WorkerTeachingRepository(new WorkerTeachingModel());
    }

    public function index()
    {
        $workers = $this->workerTeachingRepository->all();

        return view('teaching.index', compact('workers'));
    }

    public function create()
    {
        return view('teaching.create');
    }

    public function store(Request $request)
    {
        try {

            $validateData = $request->validate([
                'nombre' => 'required|string',
                'ci' => 'required|string|max:11|min:11',
                'categoria_docente' => 'required|string',
                'categoria_cientifica' => 'required|string',
                'provincia' => 'required|string',
                'municipio' => 'required|string',
                'direccion' => 'required|string',
            ]);

            $this->workerTeachingRepository->store($validateData);

            return redirect()->route('teaching.index')->with('success', 'Creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
