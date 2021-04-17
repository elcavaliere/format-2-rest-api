<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'users' => User::orderBy('created_at','desc')->get()
        ]);
    }

    public function show($id)
    {
        if($user = User::find($id))
        {
            return response()->json([
                'status' => 'success',
                'message' => 'user retrieved successfully',
                'user' => $user
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'user dont exit'
            ]);
        }
    }

    public function balance($id)
    {
        if($user = User::find($id))
        {
            return response()->json([
                'status' => 'success',
                'user_balance' => $user->profile->balance
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'user dont exit'
            ]);
        }
    }

    public function transactions($id)
    {
        if($user = User::find($id))
        {
            return response()->json([
                'status' => 'success',
                'transactions' => $user->transactions
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'user_balance' => 'user dont exit'
            ]);
        }
    }
}
