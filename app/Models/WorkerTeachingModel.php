<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkerModel;

class WorkerTeachingModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        't_category',
        's_category'
    ];

    public function worker()
    {
        return $this->belongsTo(WorkerModel::class);
    }
}
