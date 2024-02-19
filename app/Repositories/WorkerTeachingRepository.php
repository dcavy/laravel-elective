<?php

namespace App\Repositories;

use App\Models\WorkerModel;
use App\Models\AddressModel;

class WorkerTeachingRepository extends WorkerRepository
{
    public function all()
    {
        $workers_t = $this->model::select('worker_id', 't_category', 's_category')->get();
        $workersParse = [];
        foreach ($workers_t as $worker) {
            $workersParse[] =
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
        $t_worker->t_category = $data['categoria_docente'];
        $t_worker->s_category = $data['categoria_cientifica'];
        $t_worker->worker_id = $worker->id;
        $t_worker->save();
    }
}
