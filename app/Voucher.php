<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'file',
    ];

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }
}
