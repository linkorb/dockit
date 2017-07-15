<?php
namespace DockIt\Loader;

use Symfony\Component\Yaml\Yaml as YamlParser;
use DockIt\Model\App;
use DockIt\Model\Deployment;

class ConfigLoader
{
    public function load($dockIt)
    {
        $this->loadApps($dockIt);
        $this->loadDeployments($dockIt);
    }

    public function loadApps($dockIt)
    {
        $parser = new YamlParser();
        $path = $dockIt->getAppPath();
        $files = glob($path . '/*/dapp.yml');
        foreach ($files as $filename) {
            $path = realpath(dirname($filename));
            $app = new App();
            $app->setName(basename($path));
            $app->setLocalPath($path);

            $data = $parser->parse(file_get_contents($path . '/dapp.yml'));
            if (isset($data['description'])) {
                $app->setDescription($data['description']);
            }
            if (isset($data['parameters'])) {
                $app->setParameters($data['parameters']);
            }
            $dockIt->addApp($app);
        }
    }

    public function loadDeployments($dockIt)
    {
        $parser = new YamlParser();
        $path = $dockIt->getDeploymentPath();
        $files = glob($path . '/*.yml');
        foreach ($files as $filename) {
            //$path = dirname($filename);
            $data = $parser->parse(file_get_contents($filename));
            //print_r($data); exit();
            foreach ($data as $name => $config) {
                $deployment = new Deployment();
                $deployment->setName($name);
                $app = $dockIt->getAppByName($config['app']);
                $deployment->setApp($app);
                $host = $dockIt->ensureHostByName($config['host']);
                $deployment->setHost($host);
                $deployment->setParameters($config['parameters']);



                $dockIt->addDeployment($deployment);
            }

        }
    }
}
