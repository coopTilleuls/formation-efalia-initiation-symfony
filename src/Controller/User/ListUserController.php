<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListUserController extends AbstractController
{
    #[Route('/users', methods: ['GET'])]
    public function __invoke(UserRepository $userRepository): Response
    {
        return $this->render('users/list.html.twig', [
            'users' => $userRepository->findAll(), // Attention pas de pagination et très couteux (récupère tous les users) !
        ]);
    }
}
