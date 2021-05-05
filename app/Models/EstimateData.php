<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];   

    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
