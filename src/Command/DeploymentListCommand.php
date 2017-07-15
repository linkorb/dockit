<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class DeploymentListCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('deployment:list')
            ->setDescription('Shows list of deployments')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);

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
