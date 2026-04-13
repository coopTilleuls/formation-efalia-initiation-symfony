<?php

declare(strict_types=1);

namespace App\Tests\Integration\Command;

use App\Command\GreetUserBonusCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class GreetUserBonusCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:greet-user-bonus');
        $this->commandTester = new CommandTester($command);
    }

    public function testGreetsUser(): void
    {
        $this->commandTester->execute(['username' => 'Alice']);

        $this->commandTester->assertCommandIsSuccessful();
        self::assertStringContainsString('Bonjour, Alice !', $this->commandTester->getDisplay());
    }

    public function testGreetsUserWithUppercase(): void
    {
        $this->commandTester->execute([
            'username' => 'Alice',
            '--uppercase' => true,
        ]);

        $this->commandTester->assertCommandIsSuccessful();
        self::assertStringContainsString('Bonjour, ALICE !', $this->commandTester->getDisplay());
    }

    public function testAliasWorks(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:gb');
        $tester = new CommandTester($command);
        $tester->execute(['username' => 'Bob']);

        $tester->assertCommandIsSuccessful();
        self::assertStringContainsString('Bonjour, Bob !', $tester->getDisplay());
    }

    /**
     * @throws \ReflectionException
     */
    protected function tearDown(): void
    {
        $bonusCommand = self::getContainer()->get(GreetUserBonusCommand::class);

        (new \ReflectionProperty($bonusCommand, 'lock'))->getValue($bonusCommand)?->release();

        parent::tearDown();
    }
}
