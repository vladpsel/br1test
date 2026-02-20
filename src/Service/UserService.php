<?php

declare(strict_types=1);

namespace App\Service;

//use App\DTO\User\CreateUserRequest;
//use App\DTO\User\UserResponse;
//use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class UserService
{
    public function __construct(
        private EntityManagerInterface $em,
        private Security $security,
    ) {
        $this->em = $em;
        $this->security = $security;
        $this->user = null;
    }

    public function setUser(User $user)
    {

    }

    public function getUser(UserRepository $repository)
    {
        $user = $this->security->getUser();
        if (!$user) {
            throw new \RuntimeException('User not authenticated');
        }

        // Не сама вдала реалізація, але поки не відомо вцілому архітектуру як фічі і доступ має відбуватися
        // через фіче-флаги або контроль ролі і т.д. то зроблено так. + по ТЗ вказано що роути однакові
        // В прод варіанті виносив би юзеру доступ до його аккаунту на роут /me
        // а цей лишав би тільки адміну. Відповідно можливо було б повернути фікс тип замість mixed
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return $repository->findAll();
        }
        if ($this->security->isGranted('ROLE_USER')) {
            return $user;
        }
        return null;
    }

//    public function register(CreateUserRequest $object): User
//    {
//        $user = new User();
//        $user->setLogin($object->login);
//        $user->setPass(password_hash($object->pass, PASSWORD_BCRYPT));
//        $user->setPhone($object->phone);
//
//        $this->em->persist($user);
//        $this->em->flush();
//
//        return $user;

//        return new UserResponse(
//            $user->getId(),
//            $user->getLogin(),
//            $user->getPhone(),
//        );
//    }
}
