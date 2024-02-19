<?php

namespace App\Repositories;

use App\Models\WorkerModel;
use App\Models\AddressModel;

class WorkerNonTeachingRepository extends WorkerRepository
{
    public function all()
    {
        $workers = $this->model->select('worker_id', 'school_level', 'ocupation')->get();

        $workersParse = [];

        foreach ($workers as $worker) {
            $workersParse[] = [
                'id' => $worker->worker->id,
                'name' => $worker->worker->name,
                'ci' => $worker->worker->ci,
                'school_level' => $worker->school_level,
                'ocupation' => $worker->ocupation,
                'province' => $worker->worker->address->province,
                'municipality' => $worker->worker->address->municipality,
                'address' => $worker->worker->address->address,
            ];
        }

        return $workersParse;
    }

    public function store(array $data)
    {
        $address = new AddressModel();
        $address->province = $data['provincia'];
        $address->municipality = $data['municipio'];
        $address->address = $data['direccion'];
        $address->save();

        $worker = new WorkerModel();
        $worker->name = $data['nombre'];
        $worker->ci = $data['ci'];
        $worker->address_id = $address->id;
        $worker->save();

        $t_worker = new $this->model();
        $t_worker->school_level = $data['nivel_escolar'];
        $t_worker->ocupation = $data['ocupacion'];
        $t_worker->worker_id = $worker->id;
        $t_worker->save();
    }
}
