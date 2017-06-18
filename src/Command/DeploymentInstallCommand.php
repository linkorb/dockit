<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use DockIt\DockIt;
use DockIt\Loader\ConfigLoader;

class DeploymentInstallCommand extends BaseCommand
{
    public function configure()
    {
        $this
            ->setName('deployment:install')
            ->setDescription('Install deployment on remote host')
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
        $deployment = $this->dockIt->getDeploymentByName($name);
        $deployment->validateParameters();
        $deployment->ensureRemotePath();
        $deployment->copyAppFiles();
        $deployment->copyEnv();
    }

}
