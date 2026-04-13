<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:greet-user',
    description: 'Salue un utilisateur en lui donnant son nom.',
    aliases: ['app:g'],
    help: 'Cette commande vous permet de saluer un utilisateur en lui donnant son nom.',
)]
final readonly class GreetUserCommand
{
    public function __invoke(#[Argument('The username of the user.')] string $username, InputInterface $input, OutputInterface $output): int
    {
        $inputOutput = new SymfonyStyle($input, $output);

        $inputOutput->success(sprintf('Bonjour, %s ! 👋', $username));

        return Command::SUCCESS;
    }
}
