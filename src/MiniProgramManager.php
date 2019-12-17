<?php

namespace Hogus\LaravelMiniProgram;

use Hogus\LaravelMiniProgram\Supports\Config;

/**
 * Class MiniProgramManager
 * @package Hogus\LaravelMiniProgram
 */
class MiniProgramManager
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var array
     */
    protected $gateways = [];

    /**
     * MiniProgramManager constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * gateway
     *
     * @param null $driver
     * @return mixed
     */
    public function gateway($driver = null)
    {
        $driver = $driver ?: $this->getDefaultGateway();

        if (!isset($this->gateways[$driver])) {
            $this->gateways[$driver] = $this->createGateway($driver);
        }

        return $this->gateways[$driver];
    }

    /**
     * getDefaultGateway
     *
     * @return array|mixed|null
     */
    protected function getDefaultGateway()
    {
        return $this->config->get('default');
    }

    /**
     * createGateway
     *
     * @param $driver
     * @return mixed
     */
    public function createGateway($driver)
    {
        $config = $this->config->get("gateways.".$driver);

        if (is_null($config)) {
            throw new \UnexpectedValueException("Gateway [$driver] is not defined.");
        }

        $class = __NAMESPACE__.'\\Providers\\'.$config['driver'].'Provider';

        if (!class_exists($class)) {
            throw new \UnexpectedValueException("Class '$class' not found");
        }

        return $this->buildProvider($class, $config);
    }

    /**
     * buildProvider
     *
     * @param $provider
     * @param $config
     * @return mixed
     */
    public function buildProvider($provider, $config)
    {
        return new $provider($config['appid'], $config['secret']);
    }
}

