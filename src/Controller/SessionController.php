<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController
{
    private const string SESSION_KEY_COUNT = 'count';

    #[Route("/session", name: "session", methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        $session = $request->getSession();
        $current = $session->get(self::SESSION_KEY_COUNT, 0); // Équivalent à : $current = $session->has('count') ? $session->get('count') : 0;
        ++$current;

        $session->set(self::SESSION_KEY_COUNT, $current);

        return new Response(sprintf('<body>%d fois.</body>', $current));
    }
}
