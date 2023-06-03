<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index() {
        $currentPath = request()->path();
        if (!str_starts_with($currentPath, 'storage')) {
            return view('web.index');
        }
    }
}
