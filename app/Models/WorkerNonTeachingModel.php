<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkerModel;

class WorkerNonTeachingModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'school_level',
        'ocupation'
    ];

    public function worker()
    {
        return $this->belongsTo(WorkerModel::class);
    }
}
