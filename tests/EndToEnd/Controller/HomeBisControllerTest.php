<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HomeBisControllerTest extends WebTestCase
{
    public function testRendersWithDefaultName(): void
    {
        $client = self::createClient();
        $client->request('GET', '/home/bis');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'anonyme');
    }

    public function testRendersWithCustomNameFromQueryParam(): void
    {
        $client = self::createClient();
        $client->request('GET', '/home/bis', ['name' => 'Bob']);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Bob');
    }
}
