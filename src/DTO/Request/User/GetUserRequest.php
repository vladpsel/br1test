<?php

declare(strict_types=1);

namespace App\DTO\Request\User;

use App\DTO\Request\RequestContract;
use Symfony\Component\Validator\Constraints as Assert;
use InvalidArgumentException;

class GetUserRequest implements RequestContract
{

    #[Assert\NotNull(message: 'Id є обов\'язковим')]
    public ?int $id = null;

    public static function fromArray(array $params): static
    {
        $dto = new static();
        foreach ($params as $key => $value) {
            if (!property_exists($dto, $key)) {
                throw new InvalidArgumentException("Property $key not found in class " . self::class);
            }
            $dto->$key = (int) $value;

        }
        return $dto;
    }

}
