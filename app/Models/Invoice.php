<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //protected $fillable = ['Name', 'Counter_id', 'current_reading', 'Total', 'previous_reading', 'Status'];
    protected $guarded = [];

    public function Counter()
    {
        return $this->belongsTo(Counter::class, 'Counter_id');
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
