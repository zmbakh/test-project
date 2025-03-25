<?php

namespace App\Http\Resources\Transaction;

use App\Models\Transaction;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property array{balance: UserBalance, transactions: array<Transaction>} $resource
 */
class UserBalanceWithTransactionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'balance' => new UserBalanceResource($this->resource['balance']),
            'transactions' => TransactionResource::collection($this->resource['transactions']),
        ];
    }
}
