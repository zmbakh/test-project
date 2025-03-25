<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TransactionIndexRequest;
use App\Http\Resources\Transaction\TransactionResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(TransactionIndexRequest $request)
    {
        $transactions = Auth::user()
            ->transactions()
            ->when($request->input('description'), function(Builder $query) use ($request) {
                $query->where('description', 'like', '%' . $request->input('description') . '%');
            })
            ->orderBy($request->input('order_by', 'created_at'), $request->input('order', 'desc'))
            ->paginate($request->input('per_page', 15));

        return TransactionResource::collection($transactions);
    }
}
