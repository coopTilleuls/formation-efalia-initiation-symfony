<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller\User;

use Symfony\Component\HttpFoundation\Response;

final class CreateUserControllerWebTest extends UserControllerWebTestCase
{
    public function testFormPageLoads(): void
    {
        $client = self::createClient();
        $client->request('GET', '/user/create');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form');
    }

    public function testSubmittingValidFormCreatesUserAndRedirects(): void
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/user/create');

        $form = $crawler->filter('form')->form([
            'user[fullName]' => 'Jean Dupont',
            'user[username]' => 'jdupont',
            'user[email]' => 'jean.dupont@example.com',
        ]);
        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_SEE_OTHER);
        $client->followRedirect();
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('Jean Dupont', $client->getResponse()->getContent());
    }

    public function testSubmittingInvalidFormShowsErrors(): void
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/user/create');

        $form = $crawler->filter('form')->form([
            'user[fullName]' => '',
            'user[username]' => '',
            'user[email]' => 'not-an-email',
        ]);
        $client->submit($form);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form');
        self::assertStringContainsString('This value should not be blank.', $client->getResponse()->getContent());
        self::assertStringContainsString('This value should not be blank.', $client->getResponse()->getContent());
        self::assertStringContainsString( 'This value is not a valid email address.',$client->getResponse()->getContent());
    }
}
