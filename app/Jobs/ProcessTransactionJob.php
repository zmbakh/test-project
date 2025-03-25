<?php

namespace App\Jobs;

use App\Enums\Transaction\TransactionTypeEnum;
use App\Services\Transaction\ProcessTransactionService;
use App\Transfers\Transaction\ProcessTransactionTransfer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessTransactionJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $userId,
        public string $type,
        public int $amount,
        public string $description,
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(ProcessTransactionService $service): void
    {
        $service->process(new ProcessTransactionTransfer(
            $this->userId,
            TransactionTypeEnum::from($this->type),
            $this->amount,
            $this->description,
        ));
    }
}
