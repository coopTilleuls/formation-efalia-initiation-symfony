<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteUserController extends AbstractController
{
    #[Route('/user/remove/{id}')]
    public function __invoke(
        Request $request,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        int $id
    ): Response
    {
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $entityManager->remove($user);
        $entityManager->flush();
        $entityManager->clear();

        return $this->redirectToRoute('app_user_listuser__invoke', status: Response::HTTP_SEE_OTHER);
    }
}
