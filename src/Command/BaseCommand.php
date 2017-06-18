<?php

namespace DockIt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;
use DockIt\DockIt;
use DockIt\Loader\ConfigLoader;

abstract class BaseCommand extends Command
{

    protected $dockIt;

    public function init(InputInterface $input, OutputInterface $output)
    {
        $this->dockIt = new DockIt();
        $this->dockIt->setAppPath(getenv('DOCKIT_APPS'));
        $this->dockIt->setDeploymentPath(getenv('DOCKIT_DEPLOYMENTS'));
        $this->dockIt->setUsername(getenv('DOCKIT_USERNAME'));
        $this->dockIt->setPrivateKey(getenv('DOCKIT_PRIVATE_KEY'));

        $loader = new ConfigLoader();
        $loader->load($this->dockIt);
    }
}
