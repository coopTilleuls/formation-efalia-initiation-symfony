<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class SessionBisController extends AbstractController
{
    private const string SESSION_KEY_COUNT = 'countBis';

    #[Route("/session/bis", name: "session_bis", methods: ['GET'])]
    public function __invoke(SessionInterface $session): Response
    {
        $currentCount = $session->get(self::SESSION_KEY_COUNT, 0); // Équivalent à : $currentCount = $session->has(self::SESSION_KEY_COUNT) ? $session->get(self::SESSION_KEY_COUNT) : 0;
        ++$currentCount;

        $session->set(self::SESSION_KEY_COUNT, $currentCount);

        return new Response(sprintf('<body>%d fois.</body>', $currentCount));
    }
}
