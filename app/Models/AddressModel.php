<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkerModel;

class AddressModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'province',
        'municipality',
        'address', // street and number
    ];

    public function workers()
    {
        return $this->hasMany(WorkerModel::class);
    }
}
