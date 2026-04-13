<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller\User;

use Symfony\Component\HttpFoundation\Response;

final class DeleteUserControllerWebTest extends UserControllerWebTestCase
{
    public function testDeleteExistingUserRedirects(): void
    {
        $client = self::createClient();
        $id = $this->createUser('Alice Martin', 'alice', 'alice@example.com');

        $client->request('GET', '/user/remove/' . $id);

        self::assertResponseStatusCodeSame(Response::HTTP_SEE_OTHER);
        $client->followRedirect();
        self::assertResponseIsSuccessful();
        self::assertStringNotContainsString('Alice Martin', $client->getResponse()->getContent());
    }

    public function testDeleteNonExistentUserReturns404(): void
    {
        $client = self::createClient();
        $client->request('GET', '/user/remove/99999');

        self::assertResponseStatusCodeSame(404);
    }
}
