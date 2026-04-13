<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RedirectControllerTest extends WebTestCase
{
    public function testRedirectsToHome(): void
    {
        $client = self::createClient();
        $client->request('GET', '/redirection');

        self::assertResponseRedirects('/');
    }
}
