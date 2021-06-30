<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'boxes';
    protected $fillable = ['Name', 'Location'];

    public function Counter()
    {
        return $this->hasMany(Counter::class, 'Box_id');
    }

    public function State()
    {
        return $this->belongsTo(State::class, 'State_id');
    }
}
