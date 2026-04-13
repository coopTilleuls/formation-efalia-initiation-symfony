<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class NotFoundControllerTest extends WebTestCase
{
    public function testReturnsOkForKnownName(): void
    {
        $client = self::createClient();
        $client->request('GET', '/test404/foo');

        self::assertResponseIsSuccessful();
        self::assertStringContainsString('Foo is in the database', $client->getResponse()->getContent());
    }

    public function testReturns404ForUnknownName(): void
    {
        $client = self::createClient();
        $client->request('GET', '/test404/bar');

        self::assertResponseStatusCodeSame(404);
    }
}
