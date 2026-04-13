<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\assertStringNotContainsString;

final class UpdateUserControllerWebTest extends UserControllerWebTestCase
{
    public function testFormPageLoadsForExistingUser(): void
    {
        $client = self::createClient();
        $id = $this->createUser('Alice Martin', 'alice', 'alice@example.com');

        $client->request('GET', '/user/update/' . $id);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form');
        self::assertStringContainsString('Alice Martin', $client->getResponse()->getContent());
    }

    public function testSubmittingValidFormUpdatesUserAndRedirects(): void
    {
        $client = self::createClient();
        $id = $this->createUser('Alice Martin', 'alice', 'alice@example.com');

        $crawler = $client->request('GET', '/user/update/' . $id);

        $form = $crawler->filter('form')->form([
            'user[fullName]' => 'Alice Dupont',
            'user[username]' => 'alice_dupont',
            'user[email]' => 'alice.dupont@example.com',
        ]);
        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_SEE_OTHER);
        $client->followRedirect();
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('Alice Dupont', $client->getResponse()->getContent());
        self:assertStringNotContainsString('Alice Martin', $client->getResponse()->getContent());
    }

    public function testUpdateNonExistentUserReturns404(): void
    {
        $client = self::createClient();
        $client->request('GET', '/user/update/99999');

        self::assertResponseStatusCodeSame(404);
    }
}
