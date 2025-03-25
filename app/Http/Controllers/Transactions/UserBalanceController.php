<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\UserBalanceWithTransactionsResource;
use Illuminate\Support\Facades\Auth;

class UserBalanceController extends Controller
{
    public function balance(): UserBalanceWithTransactionsResource
    {
        $balance = Auth::user()->userBalance();
        $transactions = Auth::user()->transactions()->latest()->limit(5)->get();

        return new UserBalanceWithTransactionsResource([
            'balance' => $balance,
            'transactions' => $transactions,
        ]);
    }
}
