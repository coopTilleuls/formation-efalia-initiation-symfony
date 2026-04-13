<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Cookie;

final class CookieController extends AbstractController
{
    #[Route("/cookie")]
    public function __invoke(Request $request): Response
    {
        $count = $request->cookies->get('countVisits', 0); // Équivalent à : $count = $request->cookies->has('count') ? $request->cookies->get('count') : 0;

        ++$count;

        $response = new Response(sprintf('<body>L\'utilisateur est venu %d fois !</body>', $count));

        $response->headers->setCookie(
            new Cookie(
                name: 'countVisits',
                value: (string) $count,
                expire: new \DateTimeImmutable('tomorrow 8:00'),
                path: $request->getPathInfo(), // Équivalent à /cookie
                secure: true, // https only
                httpOnly: true, //sinon accessible par javascript, faille XSS !
            )
        );

        return $response;
    }
}
