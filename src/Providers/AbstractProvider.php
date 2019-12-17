<?php

namespace Hogus\LaravelMiniProgram\Providers;

use GuzzleHttp\Client;
use Hogus\LaravelMiniProgram\Supports\HttpRequest;

/**
 * Class AbstractProvider
 * @package Hogus\LaravelMiniProgram\Providers
 */
abstract class AbstractProvider
{
    use HttpRequest;

    /**
     * @var string
     */
    protected $appid;

    /**
     * @var string
     */
    protected $secret;

    /**
     * AbstractProvider constructor.
     * @param $appid
     * @param $secret
     */
    public function __construct($appid, $secret)
    {
        $this->appid = $appid;

        $this->secret = $secret;
    }

    /**
     * getBaseUri
     *
     * @return string
     */
    public function getBaseUri()
    {
        return property_exists($this, 'baseUri') ? $this->baseUri : '';
    }
}
