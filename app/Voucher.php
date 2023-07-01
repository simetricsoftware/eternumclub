<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'file',
        'amount',
    ];

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
