<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['Name', 'Price'];

    public function Option()
    {
        return $this->belongsTo(Option::class, 'Option_id');
    }
}
