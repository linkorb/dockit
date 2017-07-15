<?php

namespace DockIt;

use DockIt\Model\App;
use DockIt\Model\Deployment;
use DockIt\Model\Host;
use RuntimeException;

class DockIt
{
    protected $appPath;
    protected $deploymentPath;
    protected $apps=[];
    protected $hosts=[];
    protected $deployments=[];

    protected $username;
    protected $privateKey;

    public function setAppPath($path)
    {
        $this->appPath = $path;
    }
    public function getAppPath()
    {
        return $this->appPath;
    }


    public function setDeploymentPath($path)
    {
        $this->deploymentPath = $path;
    }
    public function getDeploymentPath()
    {
        return $this->deploymentPath;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }
    public function getPrivateKey()
    {
        return $this->privateKey;
    }


    public function addApp(App $app)
    {
        $this->apps[$app->getName()] = $app;
    }
    public function getApps()
    {
        return $this->apps;
    }

    public function addDeployment(Deployment $deployment)
    {
        $this->deployments[$deployment->getName()] = $deployment;
    }

    public function getDeployments()
    {
        return $this->deployments;
    }

    public function ensureHostByName($name)
    {
        if (!isset($this->hosts[$name])) {
            $host = new Host();
            $host->setName($name);
            $host->setUsername($this->username);
            $host->setPrivateKey($this->privateKey);
            $this->hosts[$name] = $host;
        }

        return $this->hosts[$name];
    }

    public function getAppByName($name)
    {
        if (!isset($this->apps[$name])) {
            throw new RuntimeException("No such app: " . $name);
        }
        return $this->apps[$name];
    }

    public function getDeploymentByName($name)
    {
        if (!isset($this->deployments[$name])) {
            throw new RuntimeException("No such deployment: " . $name);
        }
        return $this->deployments[$name];
    }

}
