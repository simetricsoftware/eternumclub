<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'identification_number',
        'name',
        'bank',
        'account_number',
        'account_type',
        'email',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
