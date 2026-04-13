<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ForwardController extends AbstractController
{
    #[Route(path: '/forward', name: 'forward', methods: ['GET'])]
    public function forwardRequest(LoggerInterface $logger): Response
    {
        $logger->info('Hello, je suis passé par la.');

        // Plus de redirection HTTP
        return $this->forward(sprintf('%s::forwardedRequest', self::class));
    }

    #[Route(path: '/forwarded', name: 'display_something', methods: ['GET'])]
    public function forwardedRequest(): Response
    {
        return new Response('Je arrivé là.');
    }
}
