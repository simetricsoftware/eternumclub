<?php

namespace App\Http\Controllers\web\dashboard;

use App\Actions\TicketType\DeleteAction;
use App\Actions\TicketType\StoreAction;
use App\Actions\TicketType\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Query\TicketTypeIndex;
use App\Http\Requests\TicketType\StoreRequest;
use App\Post;
use App\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->authorizeResource(TicketType::class, 'ticket-type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, TicketTypeIndex $query)
    {
        $tickets = $query->query($post)->paginate(10);

        return view('dashboard.ticket-type.index', compact('post', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('dashboard.ticket-type.create', ['post' => $post, 'ticketType' => new TicketType()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Post $post, StoreAction $storeAction)
    {
        $storeAction->execute($request, $post);

        return redirect()->route('ticket-type.index', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketType  $ticketType
     * @return \Illuminate\Http\Response
     */
    public function show(TicketType $ticketType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketType  $ticketType
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, TicketType $ticketType)
    {
        return view('dashboard.ticket-type.edit', compact('post', 'ticketType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketType  $ticketType
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Post $post, TicketType $ticketType, UpdateAction $updateAction)
    {
        $updateAction->execute($request, $ticketType);

        return redirect()->route('ticket-type.index', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketType  $ticketType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, TicketType $ticketType, DeleteAction $deleteAction)
    {
        $deleteAction->execute($ticketType);

        return redirect()->route('ticket-type.index', ['post' => $post]);
    }
}
