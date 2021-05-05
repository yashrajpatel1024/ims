<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estimate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [''];

    public function estimatedata()
    {
        return $this->hasMany(EstimateData::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}