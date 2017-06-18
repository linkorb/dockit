<?php

namespace DockIt\Model;

class App
{
    protected $name;
    protected $parameters = [];

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    private $localPath;

    public function setLocalPath($path)
    {
        $this->localPath = $path;
    }
    public function getLocalPath()
    {
        return $this->localPath;
    }

    public function hasParameter($key)
    {
        return isset($this->parameters[$key]);
    }
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }



}
