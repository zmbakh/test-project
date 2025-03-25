<?php

namespace App\Services\Transaction;

use App\Enums\Transaction\TransactionTypeEnum;
use App\Models\Transaction;
use App\Transfers\Transaction\ProcessTransactionTransfer;
use Illuminate\Support\Facades\DB;

class ProcessTransactionService
{
    public function process(ProcessTransactionTransfer $transfer): void
    {
        DB::beginTransaction();

        try {
            $balance = $this->lockAndGetBalance($transfer->userId);

            $this->checkNegativeBalance($transfer, $balance);

            $balanceAfter = $this->calculateBalanceAfter($transfer, $balance);

            $this->createTransaction($transfer, $balance, $balanceAfter);

            $this->updateBalance($transfer, $balanceAfter);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function lockAndGetBalance(int $userId): float
    {
        $balance = DB::table('user_balances')
            ->where('user_id', $userId)
            ->lockForUpdate()
            ->first();

        if (!$balance) {
            throw new \Exception('Баланс пользователя не найден');
        }

        return $balance->balance;
    }

    protected function createTransaction(ProcessTransactionTransfer $transfer, float $balance, int|float $balanceAfter): void
    {
        Transaction::create([
            'user_id'        => $transfer->userId,
            'type'           => $transfer->type,
            'amount'         => $transfer->amount,
            'description'    => $transfer->description,
            'balance_before' => $balance,
            'balance_after'  => $balanceAfter,
        ]);
    }

    protected function checkNegativeBalance(ProcessTransactionTransfer $transfer, float $balance): void
    {
        if ($transfer->type === TransactionTypeEnum::DEBIT && $balance < $transfer->amount) {
            throw new \Exception('Недостаточно средств');
        }
    }

    protected function calculateBalanceAfter(ProcessTransactionTransfer $transfer, float $balance): float
    {
        return $transfer->type === TransactionTypeEnum::CREDIT
            ? $balance + $transfer->amount
            : $balance - $transfer->amount;
    }

    protected function updateBalance(ProcessTransactionTransfer $transfer, float $balanceAfter): void
    {
        DB::table('user_balances')
            ->where('user_id', $transfer->userId)
            ->update(['balance' => $balanceAfter]);
    }
}
