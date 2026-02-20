<?php


namespace App\DTO\User;

class UserResponse
{
    public function __construct(
        public int $id,
        public string $login,
        public ?string $phone,
    ) {}
}
