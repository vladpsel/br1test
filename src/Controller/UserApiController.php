<?php

namespace App\Controller;

use App\DTO\Request\User\CreateUserRequest;
use App\DTO\Request\User\GetUserRequest;
use App\DTO\Response\ApiResponse;
use App\Helpers\ValidationHelper;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UserApiController extends AbstractController
{
    public function __construct(private UserService $service)
    {
    }

    /**
     * Обовязковий парам id
     * Відповідь login* phone* pass? - не зовсім секюрно по ТЗ є питання на обговорення
     */
    #[Route('/api/v1/user', name: 'app_user_api', methods: ['GET'])]
    public function index(Request $request, ValidationHelper $validator): JsonResponse
    {
        try {
            $user = $this->getUser();
            $data = $validator->validate($request, new GetUserRequest());
            $result = $this->service->setUser($user)->userById($data->id);

            return $this->json(new ApiResponse($result, 'User fetched successfully')->toArray(), 200, [], [
                'groups' => ['user:read'],
            ]);

        } catch (\Throwable $e) {
            return $this->json([
                'type' => 'Error',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Обовязковий парам login pass phone
     * Тільки адмін - (бо не розумію який функціонал несе для юзера)
     * Відповідь id, login* phone* - не зовсім секюрно по ТЗ є питання на обговорення
     */
    #[Route('/api/v1/user', name: 'app_user_api_create', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Request $request, ValidationHelper $validator): JsonResponse
    {
        try {
            $data = $validator->validate($request, new CreateUserRequest());
            $result = $this->service->register($data);

            return $this->json(new ApiResponse($result, 'User created successfully', 200,)->toArray(), 200, [],
                ['groups' => ['user:create']
                ]);
        } catch (\Throwable $e) {
            return $this->json([
                'type' => 'Error',
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Обовязковий парам id login pass phone
     */
    #[Route('/api/v1/user', name: 'app_user_api_update', methods: ['PUT'])]
    public function update(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }

    /**
     * Обовязковий парам id - Тільки для адміна
     */
    #[Route('/api/v1/user', name: 'app_user_api_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }

}
