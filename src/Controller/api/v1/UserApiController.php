<?php

namespace App\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class UserApiController extends AbstractController
{
    #[Route('/api/v1/user', name: 'app_user_api', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
    }

    #[Route('/api/v1/user', name: 'app_user_api_create', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserApiController.php',
        ]);
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
