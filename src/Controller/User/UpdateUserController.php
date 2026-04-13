<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class UpdateUserController extends AbstractController
{
    #[Route('/user/update/{id}')]
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

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $entityManager->clear();

            return $this->redirectToRoute('app_user_listuser__invoke', status: Response::HTTP_SEE_OTHER);
        }

        return $this->render('users/update.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
