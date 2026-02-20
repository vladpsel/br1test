<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class UserApiController extends AbstractController
{
    public function __construct(private UserService $service)
    {
    }

    /**
     * Обовязковий парам id
     */
    #[Route('/api/v1/user', name: 'app_user_api', methods: ['GET'])]
    public function index(): JsonResponse
    {

        $data = $this->service->getUser();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'data' => $data,
        ]);
    }

    /**
     * Обовязковий парам login pass phone
     * Тільки адмін - (бо не розумію який функціонал несе для юзера)
     */
    #[Route('/api/v1/user', name: 'app_user_api_create', methods: ['POST'])]
//    public function create(Request $request, ValidationHelper $validator): JsonResponse
    public function create(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'data' => 'test',
            'path' => 'src/Controller/UserApiController.php',
        ]);
//        try {
//            $data = $validator->validate($request, new CreateUserRequest());
//            $result = $this->service->register($data);
//
//            return $this->json(new ApiResponse(
//                $result,
//                'User created successfully',
//                200,
//            )->toArray(),
//                200, [],
//                ['groups' => ['user:list']
//                ]);
//        } catch (\Throwable $e) {
//            return $this->json([
//                'type' => 'Error',
//                'code' => Response::HTTP_BAD_REQUEST,
//                'message' => $e->getMessage(),
//            ]);
//        }
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
    public function delete(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }

}
