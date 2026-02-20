<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\User\CreateUserRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
        $this->em = $em;
    }
    public function register(CreateUserRequest $object): User
    {
        $user = new User();
        $user->setLogin($object->login);
        $user->setPass(password_hash($object->pass, PASSWORD_BCRYPT));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
