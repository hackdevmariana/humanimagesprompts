<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\InMemoryUser;

#[Route('/api')]
class AuthController extends AbstractController
{
    #[Route('/login', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request,
        TokenStorageInterface $tokenStorage,
        UserPasswordHasherInterface $passwordHasher,
        #[Autowire('%env(ADMIN_EMAIL)%')] string $adminEmail,
        #[Autowire('%env(ADMIN_PASSWORD_HASH)%')] string $adminPasswordHash,
    ): JsonResponse {
        $data = json_decode($request->getContent() ?: '{}', true) ?: [];

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if ($email !== $adminEmail) {
            return $this->json(['error' => 'Credenciales invalidas'], 401);
        }

        $user = new InMemoryUser($adminEmail, $adminPasswordHash, ['ROLE_ADMIN']);

        if (!$passwordHasher->isPasswordValid($user, $password)) {
            return $this->json(['error' => 'Credenciales invalidas'], 401);
        }

        $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
        $tokenStorage->setToken($token);

        return $this->json([
            'logged_in' => true,
            'user' => ['email' => $adminEmail],
        ]);
    }

    #[Route('/me', name: 'api_me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['authenticated' => false], 401);
        }

        return $this->json([
            'authenticated' => true,
            'user' => ['email' => $user->getUserIdentifier()],
        ]);
    }
}
