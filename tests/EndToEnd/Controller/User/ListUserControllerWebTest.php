<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller\User;

final class ListUserControllerWebTest extends UserControllerWebTestCase
{
    public function testListPageLoadsWithEmptyDatabase(): void
    {
        $client = self::createClient();
        $client->request('GET', '/users');

        self::assertResponseIsSuccessful();
        self::assertStringContainsString('Aucun utilisateur trouvé.', $client->getResponse()->getContent());
    }

    public function testListPageShowsExistingUsers(): void
    {
        $client = self::createClient();
        $this->createUser('Alice Martin', 'alice', 'alice@example.com');
        $this->createUser('John Martin', 'john', 'john@example.com');

        $client->request('GET', '/users');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('body');
        self::assertStringContainsString('Alice Martin', $client->getResponse()->getContent());
        self::assertStringContainsString('John Martin', $client->getResponse()->getContent());
    }
}
