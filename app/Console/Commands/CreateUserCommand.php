<?php

namespace App\Console\Commands;

use App\Services\User\CreateUserService;
use App\Transfers\User\CreateUserTransfer;
use Illuminate\Console\Command;
use Throwable;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating a new user in the system';

    /**
     * Execute the console command.
     */
    public function handle(CreateUserService $createUserService): void
    {
        $name = $this->ask('Введите имя нового пользователя');
        $email = $this->ask('Введите email');
        $password = $this->secret('Введите пароль');

        try {
            $createUserService->register(new CreateUserTransfer($name, $email, $password));
            $this->info('Пользователь успешно создан');
        } catch (Throwable) {
            $this->error('Произошла ошибка при создании пользователя');
        }
    }
}
