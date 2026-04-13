<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NotFoundController extends AbstractController
{
    #[Route('/test404/{name}')]
    public function __invoke(string $name): Response
    {
        if ('foo' === $name) {
            return new Response('Foo is in the database');
        }

        throw $this->createNotFoundException(sprintf('%s n\'existe pas.', $name));
    }
}
