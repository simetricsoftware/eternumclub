<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::forCurrentUser()->get();

        return view('dashboard.events.index', [ 'events' => $events ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Request $request)
    {
        $hashes = $event->hashes()
            ->search($request->search)
            ->showUsedOnly($request->used_first)
            ->showEmailOnly($request->email_first)
            // ->sex($request->sex)
            ->orderBy('approved_at')
            ->paginate(52);

        $pending_to_approve = $event->hashes()->whereNotNull('approved_at')->count();
        $total_used = $event->hashes()->whereNotNull('used_at')->count();
        $total_hashes = $event->hashes()->count();

        return view('dashboard.events.show', [
            'event' => $event,
            'hashes' => $hashes,
            'pending_to_approve' => $pending_to_approve,
            'total_hashes' => $total_hashes,
            'total_used' => $total_used,
            'whatsapp_message' => function(string $name): string {
            return <<<WAME
"Holi {$name} 💚😊 gracias por ser parte de la Chaviza! Va hacer una fiestita bien privada  lo cual  tú eres uno de nuestros invitados especiales espero que puedas asisitir con tu vestimenta de acuerdo a la temática 🪩🥳

1- Etiquetame @yanziizadj para validar tu invitación con la imagen que te mande por aqui (Instagram)
2- El código QR para ingresar a la fiesta te llegará a tu correo electrónico
3- Ven a disfrutar el perreo hasta abajo
4- La ubicación de la fiesta es personal ñia porfa no 👎 des a nadie

Gracias por el acolite la barra libre será solo para ti 😊

OJO👀 El código QR solo se abrirá una vez con tu invitación así que guarda bien tu código del correo 📦

Gracias por ser parte de la Chaviza

No te olvides de validar tu invitación reposteando en el Instagram"
WAME;
            }
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }


    public function settings(Event $event)
    {
        return view('dashboard.events.settings', [ 'event' => $event ]);
    }
}
