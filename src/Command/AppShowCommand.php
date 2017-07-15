<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class AppShowCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('app:show')
            ->setDescription('Shows app details')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name of the deployment'
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);
        $name = $input->getArgument('name');
        $output->writeln("<info>App: $name</info>");
        $app = $this->dockIt->getAppByName($name);
        $output->writeln('  <comment>Description:</comment> ' . $app->getDescription());
        $output->writeln('  <comment>Path:</comment> ' . $app->getLocalPath());
        $output->writeln('  Parameters:');

        foreach ($app->getParameters() as $name => $p) {
            $output->writeln('  * <comment>' . $name . '</comment> ' . $p['description'] . ' <info>(' . $p['type'] . ')</info>');

        }
    }
}
