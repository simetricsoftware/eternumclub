<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'hash',
        'assistant_id',
        'voucher_id',
        'ticket_type_id',
    ];

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
