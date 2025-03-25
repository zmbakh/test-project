<?php

namespace App\Enums\Transaction;

enum TransactionTypeEnum: string
{
    case CREDIT = 'credit';
    case DEBIT = 'debit';
}
