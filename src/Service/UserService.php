<?php

declare(strict_types=1);

namespace App\Service;

//use App\DTO\User\CreateUserRequest;
//use App\DTO\User\UserResponse;
//use App\Entity\User;
use App\DTO\Request\User\CreateUserRequest;
use App\DTO\Request\User\UpdateUserRequest;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class UserService
{
    private ?User $user = null;
    public function __construct(
        private EntityManagerInterface $em,
        private Security $security,
        private UserRepository $repository
    ) {
        $this->user = null;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function userById(int $userId): ?User
    {
        $current = $this->security->getUser();
        if (!$current instanceof User) {
            throw new \Exception('User not authenticated');
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $user = $this->repository->find($userId);
            if (!$user) {
                throw new \Exception('User not found');
            }
            return $user;
        }

        if ($current->getId() !== $userId) {
            throw new \Exception('You are not allowed to access this user');
        }

        return $current;
    }

    public function register(CreateUserRequest $object): User
    {
        $user = new User();
        $user->setLogin($object->login);
        $user->setPassword(password_hash($object->password, PASSWORD_BCRYPT));
        $user->setPhone($object->phone);
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @throws \Exception
     */
    public function update(UpdateUserRequest $object): User
    {
        $user = $this->userById($object->id);

        $user->setLogin($object->login ?? $user->getLogin());
        $user->setPassword(password_hash($object->password ?? $user->getPassword(), PASSWORD_BCRYPT));
        $user->setPhone($object->phone ?? $user->getPhone());

        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    private function checkUser(): void
    {

    }
}
