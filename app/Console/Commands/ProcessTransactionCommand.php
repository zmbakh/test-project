<?php

namespace App\Console\Commands;

use App\Enums\Transaction\TransactionTypeEnum;
use App\Jobs\ProcessTransactionJob;
use App\Models\User;
use Illuminate\Console\Command;

class ProcessTransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes money transaction';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Введите email пользователя');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('Пользователь не найден');
            return 1;
        }

        $type = $this->choice(
            'Какую операцию выполнить?',
            ['Пополнение', 'Списание'],
        );

        $amount = $this->ask('Введите сумму');
        $description = $this->ask('Введите описание');

        $typeEnum = $type === 'Пополнение' ? TransactionTypeEnum::CREDIT : TransactionTypeEnum::DEBIT;

        ProcessTransactionJob::dispatch($user->id, $typeEnum->value, $amount, $description);
    }
}
