<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ForwardControllerTest extends WebTestCase
{
    public function testForwardedRouteIsDirectlyAccessible(): void
    {
        $client = self::createClient();
        $client->request('GET', '/forwarded');

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);
        self::assertStringContainsString('Je arrivé là.', $client->getResponse()->getContent());
    }

    public function testForwardServesForwardedContent(): void
    {
        $client = self::createClient();
        $client->request('GET', '/forward');

        self::assertResponseIsSuccessful();
        self::assertStringContainsString('Je arrivé là.', $client->getResponse()->getContent());
    }
}
