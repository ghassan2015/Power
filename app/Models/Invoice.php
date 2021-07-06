<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //protected $fillable = ['Name', 'Counter_id', 'current_reading', 'Total', 'previous_reading', 'Status'];
    protected $guarded = [];

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id');
    }

    public function Payment()
    {
        return $this->hasMany(Payment::class, 'Invoice_id');
    }

    public function scopeActive($qery)
    {

        return $qery->where('Status', 1) ? 'مدفوعة' : 'غير مدفوعة';
    }
}
