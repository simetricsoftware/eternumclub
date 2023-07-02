<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Query\BankAccount\Index;
use App\Http\Resources\BankAccount\IndexResource;
use App\Post;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Index $bankAccount)
    {
        $bankAccounts = $bankAccount->query($post)->get();

        return IndexResource::collection($bankAccounts);
    }
}
