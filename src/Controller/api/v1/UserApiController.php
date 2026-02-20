<?php

namespace App\Controller\api\v1;

use App\Dto\User\CreateUserRequest;
use App\Helpers\ValidationHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UserApiController extends AbstractController
{
    #[Route('/api/v1/user', name: 'app_user_api', methods: ['GET'])]
    public function index(): JsonResponse
    {

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'data' => 'test',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }

    #[Route('/api/v1/user', name: 'app_user_api_create', methods: ['POST'])]
    public function create(Request $request, ValidationHelper $validator): JsonResponse
    {
        try {
            $data = $validator->validate($request, new CreateUserRequest());

            return $this->json([
                'message' => 'Welcome to your new controller!',
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                'type' => 'Error',
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ]);
        }
    }

    #[Route('/api/v1/user', name: 'app_user_api_update', methods: ['PUT'])]
    public function update(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }

    #[Route('/api/v1/user', name: 'app_user_api_delete', methods: ['DELETE'])]
    public function delete(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }


}
