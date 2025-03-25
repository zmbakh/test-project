<?php

namespace App\Services\User;

use App\Models\User;
use App\Transfers\User\CreateUserTransfer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserService
{
    public function register(CreateUserTransfer $transfer): User
    {
        DB::beginTransaction();
        $user = $this->createUser($transfer);
        $this->createBalance($user);
        DB::commit();

        return $user;
    }

    protected function createUser(CreateUserTransfer $transfer): User
    {
        return User::create([
            'name' => $transfer->name,
            'email' => $transfer->email,
            'password' => Hash::make($transfer->password),
        ]);
    }

    protected function createBalance(User $user): void
    {
        $user->userBalance()->create([
            'balance' => 0,
        ]);
    }
}
