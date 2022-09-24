<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestHash;
use App\Http\Requests\RegisterHash;
use App\Models\Hash;
use App\Services\HashService;

class HashController extends Controller
{
    public function __construct(
        protected HashService $hash_service,
    ) {}

    public function requestQr(RequestHash $request)
    {
        $qr_url = $this->hash_service->requestQr($request->hash, $request->email, $request->name, $request->phone);

        $url = $this->hash_service->requestUrl($request->hash, $request->email);

        $this->hash_service->sendByEmail($request->email, $qr_url, $url);
        
        return redirect($request->redirect_to)->with([
            'qr_url' => $qr_url,
        ]);
    }

    public function registerHash(RegisterHash $request)
    {
        $this->hash_service->registerHash($request->hash, $request->email);

        return response()->noContent();
    }
}