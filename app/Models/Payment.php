<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['Name', 'User_id', 'Invoice_id', 'Paid'];

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class, 'Invoice_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'User_id');
    }

    //
}
