<?php

namespace App\Transfers\User;

class CreateUserTransfer
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
