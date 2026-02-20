<?php

declare(strict_types=1);

namespace App\DTO\Request\User;


use App\DTO\Request\RequestContract;
use App\Validation\UniqueLogin;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequest implements RequestContract
{
    public static function fromArray(array $params): static
    {
        $dto = new static();
        foreach ($params as $key => $value) {
            if (!property_exists($dto, $key)) {
                continue;
            }
            if ($key === 'id') {
                $dto->$key = (int) $value;
            } else {
                $dto->$key = strval($value);
            }
        }
        return $dto;
    }

    #[Assert\NotNull(message: 'Id є обов\'язковим')]
    public ?int $id = null;

    #[Assert\AtLeastOneOf([
        new Assert\IsNull(),
        new Assert\Length(
            min: 3,
            max: 8,
            minMessage: 'Логін повинен бути довше {{ limit }} символів',
            maxMessage: 'Занадто довгий логін',
        ),
    ])]
    public ?string $login = null;

    #[Assert\AtLeastOneOf([
        new Assert\IsNull(),
        new Assert\Length(
            min: 6,
            max: 8,
            minMessage: 'Пароль повинен бути довше {{ limit }} символів',
            maxMessage: 'Занадто довгий пароль',
        ),
    ])]
    public ?string $password = null;

    #[Assert\Regex(
        pattern: '/^\+?[0-9]{10,15}$/',
        message: 'Phone must be a valid number'
    )]
    public ?string $phone;
}
