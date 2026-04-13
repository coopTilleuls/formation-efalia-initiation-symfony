<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserEntityTest extends TestCase
{
    public function testUserEntityInitialization(): void
    {
        $user = new User();

        $user->setFullName('Jean Dupont');
        $user->setEmail('jean.dupont@gmail.com');
        $user->setUsername('jean_dupont');

        self::assertSame('Jean Dupont', $user->getFullName());
        self::assertSame('jean.dupont@gmail.com', $user->getEmail());
        self::assertSame('jean_dupont', $user->getUsername());
    }
}
