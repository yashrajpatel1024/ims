<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [''];
    
    public function invoicedata()
    {
        return $this->hasMany(InvoiceData::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
