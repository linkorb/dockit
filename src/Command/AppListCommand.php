<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class AppListCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('app:list')
            ->setDescription('Shows app list')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);

        $output->writeln("<info>Apps:</info>");
        foreach ($this->dockIt->getApps() as $app) {
            //print_r($app);
            $output->writeln('* <comment>' . $app->getName() . '</comment>: ' . $app->getDescription());
            //$output->writeln('  path: ' . $app->getLocalPath());
        }
    }
}
