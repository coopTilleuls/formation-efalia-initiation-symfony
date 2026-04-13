<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SessionBisControllerTest extends WebTestCase
{
    public function testCounterIncrementsOnEachVisit(): void
    {
        $client = self::createClient();

        $client->request('GET', '/session/bis');
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('1 fois.', $client->getResponse()->getContent());

        $client->request('GET', '/session/bis');
        self::assertStringContainsString('2 fois.', $client->getResponse()->getContent());
    }

    public function testSessionIsIndependentFromOtherRoutes(): void
    {
        $client = self::createClient();

        $client->request('GET', '/session');
        $client->request('GET', '/session/bis');

        self::assertStringContainsString('1 fois.', $client->getResponse()->getContent());
    }
}
