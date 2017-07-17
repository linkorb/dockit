<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class ConfigCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('config')
            ->setDescription('Show config')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);

        $output->writeln("<info>Configuration:</info>");
        $output->writeln("<comment>DOCKIT_APPS</comment>=" . getenv('DOCKIT_APPS'));
        $output->writeln("<comment>DOCKIT_DEPLOYMENTS</comment>=" . getenv('DOCKIT_DEPLOYMENTS'));
        $output->writeln("<comment>DOCKIT_USERNAME</comment>=" . getenv('DOCKIT_USERNAME'));
        $output->writeln("<comment>DOCKIT_PRIVATE_KEY</comment>=" . getenv('DOCKIT_PRIVATE_KEY'));
    }
}
