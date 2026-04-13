<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Controller sans le AbstractController de Symfony, + d'infos: Action-Domain-Responder Pattern.
 */
final readonly class HomeBisController
{
    public function __construct(private Environment $twig){}

    /**
     * @throws RuntimeError|SyntaxError|LoaderError
     */
    #[Route('/home/bis', name: 'home_bis', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return new Response($this->twig->render('home/index.html.twig', [
            'name' => $request->query->get('name', 'anonyme'),
        ]));
    }
}
