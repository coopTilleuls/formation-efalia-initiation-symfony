<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SessionControllerTest extends WebTestCase
{
    public function testCounterIncrementsOnEachVisit(): void
    {
        $client = self::createClient();

        $client->request('GET', '/session');
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('1 fois.', $client->getResponse()->getContent());

        $client->request('GET', '/session');
        self::assertStringContainsString('2 fois.', $client->getResponse()->getContent());

        $client->request('GET', '/session');
        self::assertStringContainsString('3 fois.', $client->getResponse()->getContent());
    }
}
