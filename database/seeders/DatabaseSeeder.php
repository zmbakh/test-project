<?php

namespace Database\Seeders;

use App\Enums\Transaction\TransactionTypeEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\Transaction\ProcessTransactionService;
use App\Transfers\Transaction\ProcessTransactionTransfer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(ProcessTransactionService $processTransactionService): void
    {
        foreach (User::all() as $user) {
            $processTransactionService->process(new ProcessTransactionTransfer(
                $user->id,
                TransactionTypeEnum::CREDIT,
                50000,
                fake()->sentence,
            ));

            for ($i = 0; $i < 10; $i++) {
                $processTransactionService->process(new ProcessTransactionTransfer(
                    $user->id,
                    Arr::random([
                        TransactionTypeEnum::CREDIT,
                        TransactionTypeEnum::DEBIT,
                    ]),
                    random_int(0, 1000),
                    fake()->sentence,
                ));
            }
        }
    }
}
