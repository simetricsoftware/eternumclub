<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = [
        'name', 'amount', 'quantity'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
