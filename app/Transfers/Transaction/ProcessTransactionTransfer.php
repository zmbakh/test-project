<?php

namespace App\Transfers\Transaction;

use App\Enums\Transaction\TransactionTypeEnum;

class ProcessTransactionTransfer
{
    public function __construct(
        public readonly int $userId,
        public readonly TransactionTypeEnum $type,
        public readonly int $amount,
        public readonly string $description,
    )
    {
    }
}
