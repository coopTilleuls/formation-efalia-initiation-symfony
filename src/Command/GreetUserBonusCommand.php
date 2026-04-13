<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function Symfony\Component\String\u;

#[AsCommand(
    name: 'app:greet-user-bonus',
    description: 'Salue un utilisateur en lui donnant son nom.',
    aliases: ['app:gb'],
    help: 'Cette commande vous permet de saluer un utilisateur en lui donnant son nom.',
)]
final class GreetUserBonusCommand
{
    use LockableTrait;

    public function __invoke(
        InputInterface $input,
        OutputInterface $output,
        #[Argument('The username of the user.')] string $username,
        #[Option('Print username in Uppercase')] bool $uppercase = false,
    ): int
    {
        $inputOutput = new SymfonyStyle($input, $output);
        if (!$this->lock()) {
            $inputOutput->warning('The command is already running in another process.');

            return Command::SUCCESS;
        }

        if ($uppercase) {
            $formattedUsername = u($username)->upper()->toString();
        }

        $inputOutput->success(sprintf('Bonjour, %s ! 👋', $formattedUsername ?? $username));

        // Pour tester que notre lock fonctionne
        // sleep(5);

        return Command::SUCCESS;
    }
}
