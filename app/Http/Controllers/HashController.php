<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestHash;
use App\Http\Requests\RegisterHash;
use App\Http\Requests\StoreHashRequest;
use App\Http\Requests\UpdateHashRequest;
use App\Models\Hash;
use App\Services\HashService;

class HashController extends Controller
{
    public function __construct(
        protected HashService $hash_service,
    ) {}

    public function index()
    {
        $hashes = Hash::all();

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

    public function requestQr(RequestHash $request)
    {
        $qr_url = $this->hash_service->requestQr($request->hash, $request->email, $request->name, $request->phone);

        $url = $this->hash_service->requestUrl($request->hash, $request->email);

        $this->hash_service->sendByEmail($request->email, $qr_url, $url);
        
        return redirect()->route('confirmation');
    }

    public function registerHash(RegisterHash $request)
    {
        $this->hash_service->registerHash($request->hash, $request->email);

        return response()->noContent();
    }
}