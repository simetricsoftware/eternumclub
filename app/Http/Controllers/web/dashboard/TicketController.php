<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Query\Ticket\Index;
use App\Post;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Post $post, Index $index, Request $request)
    {
        $tickets = $index->query($request, $post)->with('assistant', 'voucher', 'ticketType')->paginate(12);

        return view('dashboard.ticket.index', compact('tickets', 'post'));
    }
}
