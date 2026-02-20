<?php

declare(strict_types=1);

namespace App\DTO\Request\User;

use App\DTO\Request\RequestContract;
use App\Entity\User;

class GetUserRequest implements RequestContract
{

    #[Assert\NotBlank]
    public string $id = '';
    public static function fromArray(array $data): static
    {
        return new static();
    }

}
