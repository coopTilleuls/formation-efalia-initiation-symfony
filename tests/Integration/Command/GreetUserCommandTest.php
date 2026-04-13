<?php

declare(strict_types=1);

namespace App\Tests\Integration\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class GreetUserCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:greet-user');
        $this->commandTester = new CommandTester($command);
    }

    public function testGreetsUser(): void
    {
        $this->commandTester->execute(['username' => 'Alice']);

        $this->commandTester->assertCommandIsSuccessful();
        self::assertStringContainsString('Bonjour, Alice !', $this->commandTester->getDisplay());
    }

    public function testAliasWorks(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:g');
        $tester = new CommandTester($command);
        $tester->execute(['username' => 'Bob']);

        $tester->assertCommandIsSuccessful();
        self::assertStringContainsString('Bonjour, Bob !', $tester->getDisplay());
    }
}
