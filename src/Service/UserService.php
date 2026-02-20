<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\User\CreateUserRequest;
use App\DTO\User\UserResponse;
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
        $user->setPhone($object->phone);

        $this->em->persist($user);
        $this->em->flush();

        return $user;

//        return new UserResponse(
//            $user->getId(),
//            $user->getLogin(),
//            $user->getPhone(),
//        );
    }
}
