<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['Name', 'Counter_id', 'Value', 'Total', 'Remainder', 'Status'];

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
