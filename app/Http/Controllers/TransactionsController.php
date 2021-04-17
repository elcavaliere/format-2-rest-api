<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::orderBy('created_at','desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate(
            $request,
            [
                'user_id' => 'required',
                'value' => 'required',
                'type' => 'required',
                'description' => 'required'
            ]);

        try {

            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'value' => $request->value,
                'type' => $request->type,
                'description' => $request->description
            ]);

            $newBalance = $transaction->type == 1 ? ($transaction->user->profile->balance + $transaction->value) : ($transaction->user->profile->balance - $transaction->value);
            $transaction->user->profile->balance = $newBalance;
            $transaction->user->profile->save();

            if($transaction)
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Transaction created successfully',
                    'transaction' => $transaction,
                ]);
            }

        }catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {

            $transaction = Transaction::find($id);

            if($transaction)
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Transaction retrieved successfully',
                    'transaction' => $transaction
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction dont exist',
                ]);
            }

        }catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {

            $transaction = Transaction::find($id);

            if($transaction)
            {
                $newBalance = $transaction->type == 1 ? ($transaction->user->profile->balance - $transaction->value) : ($transaction->user->profile->balance + $transaction->value);
                $transaction->user->profile->balance = $newBalance;
                $transaction->user->profile->save();

                $transaction->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Transaction canceled successfully',
                    'balance' => $newBalance
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction dont exist',
                ]);
            }

        }catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
