<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddressModel;
use App\Models\WorkerNonTeachingModel;
use App\Models\WorkerTeachingModel;

class WorkerModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ci',
        'address_id'
    ];

    public function address()
    {
        return $this->belongsTo(AddressModel::class);
    }

    public function nonTeachingWorker()
    {
        return $this->hasMany(WorkerNonTeachingModel::class);
    }

    public function teachingWorker()
    {
        return $this->hasMany(WorkerTeachingModel::class);
    }
}
