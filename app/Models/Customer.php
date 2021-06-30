<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'Name', 'email', 'password', 'Phone', 'Price', 'Address', 'State_id', 'Counter_id', 'Box_id', 'Status'
    ];

    public function State()
    {
        return $this->belongsTo(State::class, 'State_id');
    }

    public function Counter()
    {
        return $this->belongsTo(Counter::class, 'Counter_id');
    }

//    public function getAuthPassword()
//    {
//        return $this->Password;
//    }
}
