<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestHash;
use App\Http\Requests\RegisterHash;
use App\Http\Requests\RegisterVoucher;
use App\Http\Requests\StoreHashRequest;
use App\Http\Requests\UpdateHashRequest;
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
        
        return redirect()->route('dashboard.hashes.index');
    }

    public function galery()
    {
        $hashes = Hash::all();

        return view('web.galery')->with([ 'hashes' => $hashes ]);
    }

    public function registerVoucher(RegisterVoucher $request)
    {
        $this->hash_service->registerVoucher($request->hash, $request->email, $request->name, $request->phone, $request->file('voucher'));

        return redirect()->route('confirmation');
    }

    public function requestQr(string $hash)
    {
        $hash = Hash::firstWhere('hash', $hash);

        $qr_url = $this->hash_service->requestQr($hash);

        $this->hash_service->sendByEmail($hash->user, $qr_url);
        
        return redirect()->route('dashboard.hashes.index');
    }

    public function registerHash(RegisterHash $request)
    {
        $this->hash_service->registerHash($request->hash, $request->email);

        return redirect()->route('approved');
    }

    public function reverse(string $hash)
    {
        $this->hash_service->reverseHash($hash);

        return redirect()->route('dashboard.hashes.index');
    }
}
