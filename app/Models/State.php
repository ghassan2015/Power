<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $fillable = ['Name'];

    public function Customer()
    {
        return $this->hasMany(Customer::class, 'State_id', 'id');
    }

    public function Box()
    {
        return $this->hasMany(Box::class, 'State_id');
    }
}
