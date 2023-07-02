<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Query\TicketType\Index;
use App\Http\Resources\TicketType\IndexResource;
use App\Post;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Index $query)
    {
        $tickets = $query->query($post)->get();

        return IndexResource::collection($tickets);
    }
}
