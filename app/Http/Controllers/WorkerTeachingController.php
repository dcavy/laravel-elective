<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkerTeachingModel;
use App\Models\WorkerModel;
use App\Models\AddressModel;
use Illuminate\Validation\ValidationException;


class WorkerTeachingController extends Controller
{
    public function index()
    {
        $workers_t = WorkerTeachingModel::select('worker_id', 't_category', 's_category')->get();
        $workers = [];
        foreach ($workers_t as $worker) {
            $workers[] =
                [
                    'name' => $worker->worker->name,
                    'ci' => $worker->worker->ci,
                    't_category' => $worker->t_category,
                    's_category' => $worker->s_category,
                    'province' => $worker->worker->address->province,
                    'municipality' => $worker->worker->address->municipality,
                    'address' => $worker->worker->address->address,
                ];
        }

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

            $t_worker = new WorkerTeachingModel();
            $t_worker->t_category = $validateData['categoria_docente'];
            $t_worker->s_category = $validateData['categoria_cientifica'];
            $t_worker->worker_id = $worker->id;
            $t_worker->save();

            return redirect()->route('teaching.index')->with('success', 'Creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
