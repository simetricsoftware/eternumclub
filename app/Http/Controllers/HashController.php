<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterHash;
use App\Http\Requests\RegisterVoucher;
use App\Http\Requests\StoreHashRequest;
use App\Http\Requests\UpdateHashRequest;
use App\Models\Event;
use App\Models\Hash;
use App\Services\HashService;
use Illuminate\Http\Request;

class HashController extends Controller
{
    public function __construct(
        protected HashService $hash_service,
    ) {}

    public function index(Request $request)
    {
        $hashes = Hash::filterHash($request->hash)->get();

        return view('dashboard.hash.index')->with([ 'hashes' => $hashes ]);
    }

    public function create()
    { 
        return view('dashboard.hash.create')->with([ 'hash' => new Hash() ]);
    }

    public function save(StoreHashRequest $request)
    { 
        $this->hash_service->save($request->hash, $request->file('file'));
        
        return redirect()->route('dashboard.hashes.index');
    }

    public function edit(Hash $hash)
    { 
        return view('dashboard.hash.edit')->with([ 'hash' => $hash ]);
    }

    public function update(Hash $hash, UpdateHashRequest $request)
    { 
        $this->hash_service->update($hash, $request->hash, $request->file('file'));
        
        return redirect()->route('dashboard.hashes.index');
    }

    public function delete(Hash $hash)
    { 
        $this->hash_service->delete($hash);
        
        return redirect()->route('events.show', [ 'event' => $hash->event]);
    }

    public function galery(Event $event)
    {
        return view('web.galery')->with([ 'event' => $event ]);
    }

    public function registerVoucher(Event $event, RegisterVoucher $request)
    {
        $this->hash_service->registerVoucher($event, $request->only('email', 'name', 'phone', 'sex', 'is-ready', 'instagram'), $request->file('voucher'));

        return redirect()->route('confirmation');
    }

    public function requestQr(Hash $hash)
    {
        $qr_url = $this->hash_service->requestQr($hash);

        $this->hash_service->sendByEmail($hash, $qr_url);
        
        return redirect()->route('events.show', [ 'event' => $hash->event ]);
    }

    public function registerHash(RegisterHash $request)
    {
        $this->hash_service->registerHash($request->hash, $request->email);

        return redirect()->route('approved');
    }

    public function downloadInvitation(Hash $hash) {
        $path = $this->hash_service->generateInvitation($hash);
      
        return response()->download(storage_path($path), 'invitation.png')->deleteFileAfterSend();
   }
}
