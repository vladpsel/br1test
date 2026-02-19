<?php

namespace App\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class SecurityApiController extends AbstractController
{
    #[Route('/api/v1/login', name: 'app_security_api')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SecurityApiController.php',
        ]);
    }

    #[Route('/api/v1/me', name: 'app_security_api_me')]
    public function me(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SecurityApiController.php',
        ]);
    }
}
