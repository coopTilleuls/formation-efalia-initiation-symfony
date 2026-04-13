<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CookieControllerTest extends WebTestCase
{
    public function testFirstVisitCountsOne(): void
    {
        $client = self::createClient();
        $client->request('GET', '/cookie');

        self::assertResponseIsSuccessful();
        self::assertStringContainsString("L'utilisateur est venu 1 fois !", $client->getResponse()->getContent());
        self::assertResponseHasCookie('countVisits', '/cookie');
        self::assertResponseCookieValueSame('countVisits', '1', '/cookie');
    }

    public function testCounterIncrementsOnEachVisit(): void
    {
        $client = self::createClient();

        $client->request('GET', '/cookie');
        self::assertStringContainsString("L'utilisateur est venu 1 fois !", $client->getResponse()->getContent());

        $client->request('GET', '/cookie', [], [], ['HTTP_COOKIE' => 'countVisits=1']);

        self::assertStringContainsString("L'utilisateur est venu 2 fois !", $client->getResponse()->getContent());
        self::assertResponseCookieValueSame('countVisits', '2', '/cookie');
    }
}
