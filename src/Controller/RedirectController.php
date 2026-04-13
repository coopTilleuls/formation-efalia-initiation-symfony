<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RedirectController extends AbstractController
{
    #[Route('/redirection', name: 'redirection', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->redirectToRoute('home');
    }
}
