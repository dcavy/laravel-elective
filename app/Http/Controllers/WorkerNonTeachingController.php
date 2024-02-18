<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkerModel;
use App\Models\AddressModel;
use Illuminate\Validation\ValidationException;

use App\Models\WorkerNonTeachingModel;

class WorkerNonTeachingController extends Controller
{
    public function index()
    {
        $workers_nont = WorkerNonTeachingModel::select('worker_id', 'school_level', 'ocupation')->get();
        $workers = [];
        foreach ($workers_nont as $worker) {
            $workers[] =
                [
                    'name' => $worker->worker->name,
                    'ci' => $worker->worker->ci,
                    'school_level' => $worker->school_level,
                    'ocupation' => $worker->ocupation,
                    'province' => $worker->worker->address->province,
                    'municipality' => $worker->worker->address->municipality,
                    'address' => $worker->worker->address->address,
                ];
        }

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


            $address = new AddressModel();
            $address->province = $validateData['provincia'];
            $address->municipality = $validateData['municipio'];
            $address->address = $validateData['direccion'];
            $address->save();

            $worker = new WorkerModel();
            $worker->name = $validateData['nombre'];
            $worker->ci = $validateData['ci'];
            $worker->address_id = $address->id;
            $worker->save();

            $t_worker = new WorkerNonTeachingModel();
            $t_worker->school_level = $validateData['nivel_escolar'];
            $t_worker->ocupation = $validateData['ocupacion'];
            $t_worker->worker_id = $worker->id;
            $t_worker->save();
            // dd($t_worker);

            return redirect()->route('nonteaching.index')->with('success', 'Creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroyByCi(Request $request)
    {
        try {
            $request->validate([
                'ci' => 'required|min:11|max:11'
            ]);

            $worker = WorkerModel::where('ci', $request->ci)->select('id')->first();
            if (!$worker) return back()->with('error', 'No existe el trabajador');
            $worker->delete();
            $address = AddressModel::where('worker_id', $worker->id);
            $address->delete();

            return redirect()->back()->with('success', 'eliminado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
