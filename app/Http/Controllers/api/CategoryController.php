<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return CategoryResource::collection(Category::orderBy('title', 'ASC')->get())
            ->additional([
                'status'    => '200',
                'message'   => 'succes'
            ]);
    }
}
