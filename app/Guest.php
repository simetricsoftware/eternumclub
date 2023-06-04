<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'identification_number',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
