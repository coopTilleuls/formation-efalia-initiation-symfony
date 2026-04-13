<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HomeControllerTest extends WebTestCase
{
    public function testRendersWithDefaultName(): void
    {
        $client = self::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'anonyme');
    }

    public function testRendersWithCustomNameFromQueryParam(): void
    {
        $client = self::createClient();
        $client->request('GET', '/', ['name' => 'Alice']);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Alice');
    }
}
