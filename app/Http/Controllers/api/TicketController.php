<?php

namespace App\Http\Controllers\api;

use App\Actions\Ticket\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreRequest;
use App\Post;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Post $post, StoreAction $action)
    {
        try {
            DB::beginTransaction();
            $action->execute($request, $post);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Ticket created successfully'
        ], 201);
    }
}
