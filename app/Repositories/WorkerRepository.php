<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\AddressModel;
use App\Models\WorkerModel;

class WorkerRepository extends BaseRepository
{
    public function destroy($ci)
    {
        $worker = WorkerModel::where('ci', $ci)->select('id')->first();
        $worker->delete();
        $address = AddressModel::where('worker_id', $worker->id);
        $address->delete();
    }
}
