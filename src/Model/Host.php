<?php

namespace DockIt\Model;

use SSHClient\ClientConfiguration\ClientConfiguration;
use SSHClient\ClientBuilder\ClientBuilder;
use RuntimeException;

class Host
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    protected $username;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    protected $privateKey;

    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }



    protected function getBuilder()
    {
        if (!$this->getUsername()) {
            throw new RuntimeException("Username not configured for host ". $this->name);
        }
        if (!$this->getPrivateKey()) {
            throw new RuntimeException("Private key file not configured for host ". $this->name);
        }
        $config = new ClientConfiguration($this->getName(), $this->getUsername());
        $config->setOptions(array(
            'IdentityFile' => $this->getPrivateKey(),
            'IdentitiesOnly' => 'yes',
        ));
        $builder = new ClientBuilder($config);
        return $builder;
    }

    public function getScp()
    {
        $builder = $this->getBuilder();
        return $builder->buildSecureCopyClient();
    }
    public function getSsh()
    {
        $builder = $this->getBuilder();
        return $builder->buildClient();
    }
}
