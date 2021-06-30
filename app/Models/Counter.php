<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counter extends Model
{
    use SoftDeletes;
    protected $fillable = ['Name', 'Box_id', 'is_active'];

    //protected $guarded = [];

    public function Box()
    {
        return $this->belongsTo(Box::class, 'Box_id');
    }

    public function Invoice()
    {
        return $this->hasMany(Invoice::class, 'Counter_id');
    }


    public function getActive()
    {
        return $this->is_active == 1 ? 'مفعل' : 'غير مفعل';

    }


}
