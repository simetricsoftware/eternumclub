<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'hash',
        'guest_id',
        'voucher_id',
        'ticket_type_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
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
