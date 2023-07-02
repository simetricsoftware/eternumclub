<?php

namespace App\Http\Controllers\web\dashboard;

use App\Actions\BankAccount\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Query\BankAccount\Index;
use App\Http\Requests\BankAccount\StoreRequest;
use App\Post;

class BankAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Index $bankAccount)
    {
        $bankAccounts = $bankAccount->query($post)->get();

        return view('dashboard.bank-account.index', compact('post', 'bankAccounts'));
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

        return redirect()->route('bank-accounts.index', ['post' => $post])->with('status', 'Cuentas bancarias actualizadas con exito');
    }
}
