<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class ShowCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('show')
            ->setDescription('Show apps and deployments')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);
        //print_r($this->dockIt);

        $output->writeln("<info>Configuration:</info>");
        $output->writeln("<comment>DOCKIT_APPS</comment>=" . getenv('DOCKIT_APPS'));
        $output->writeln("<comment>DOCKIT_DEPLOYMENTS</comment>=" . getenv('DOCKIT_DEPLOYMENTS'));
        $output->writeln("<comment>DOCKIT_USERNAME</comment>=" . getenv('DOCKIT_USERNAME'));
        $output->writeln("<comment>DOCKIT_PRIVATE_KEY</comment>=" . getenv('DOCKIT_PRIVATE_KEY'));

        $output->writeln("");
        $output->writeln("<info>Apps:</info>");
        foreach ($this->dockIt->getApps() as $app) {
            //print_r($app);
            $output->writeln('* <comment>' . $app->getName() . '</comment>: ' . $app->getDescription());
            //$output->writeln('  path: ' . $app->getLocalPath());
        }

        $output->writeln("");
        $output->writeln("<info>Deployments:</info>");
        foreach ($this->dockIt->getDeployments() as $deployment) {
            //print_r($deployment);
            $output->writeln('* <comment>' . $deployment->getName() . '</comment>');
            $output->writeln('  host: ' . $deployment->getHost()->getName());
            foreach ($deployment->getParameters() as $key => $value) {
                $output->writeln('    ' . $key . '=' . $value);
            }
        }
    }
}
