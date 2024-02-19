<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\WorkerNonTeachingRepository;
use App\Models\WorkerNonTeachingModel;

class WorkerNonTeachingController extends Controller
{
    protected $workerNTRepository;

    public function __construct()
    {
        $this->workerNTRepository = new WorkerNonTeachingRepository(new WorkerNonTeachingModel());
    }


    public function index()
    {
        $workers = $this->workerNTRepository->all();

        return view('nonteaching.index', compact('workers'));
    }

    public function create()
    {
        return view('nonteaching.create');
    }

    public function store(Request $request)
    {
        try {

            $validateData = $request->validate([
                'nombre' => 'required|string',
                'ci' => 'required|string|max:11|min:11|unique:worker_models',

                'nivel_escolar' => 'required|string',
                'ocupacion' => 'required|string',
                'provincia' => 'required|string',
                'municipio' => 'required|string',
                'direccion' => 'required|string',
            ]);

            $this->workerNTRepository->store($validateData);

            return redirect()->route('nonteaching.index')->with('success', 'Creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroyByCi(Request $request)
    {
        try {
            $request->validate([
                'ci' => 'required|min:11|max:11|exists:worker_models,ci'
            ]);
            $this->workerNTRepository->destroy($request->ci);

            return redirect()->back()->with('success', 'eliminado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
