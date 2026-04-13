<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class UserControllerWebTestCase extends WebTestCase
{
    protected function createUser(string $fullName, string $username, string $email): int
    {
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);

        $user = new User();
        $user->setFullName($fullName);
        $user->setUsername($username);
        $user->setEmail($email);
        $entityManager->persist($user);
        $entityManager->flush();

        return $user->getId();
    }

    protected function tearDown(): void
    {
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        foreach ($entityManager ->getRepository(User::class)->findAll() as $user) {
            $entityManager ->remove($user);
        }
        $entityManager ->flush();

        parent::tearDown();
    }
}
