<?php

namespace Hogus\LaravelMiniProgram\Supports;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait HttpRequest
 * @package Hogus\LaravelMiniProgram\Supports
 */
trait HttpRequest
{
    /**
     * httpGet
     *
     * @param $uri
     * @param array $query
     * @return array|string
     */
    public function httpGet($uri, $query = [])
    {
        return $this->request('get', $uri, [
            'query' => $query
        ]);
    }

    /**
     * httpPost
     *
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return array|string
     */
    public function httpPost($uri, $params = [], $headers = [])
    {
        return $this->request('post', $uri, [
            'headers' => $headers,
            'form_params' => $params
        ]);
    }

    /**
     * request
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array|string
     */
    public function request(string $method, string $uri, array $options = [])
    {
        return $this->unwrapResponse($this->getHttpClient($this->getBaseOptions())->request($method, $uri, $options));
    }

    /**
     * getBaseOptions
     *
     * @return array
     */
    protected function getBaseOptions()
    {
        return [
          'base_uri' => method_exists($this, 'getBaseUri') ? $this->getBaseUri() : ''
        ];
    }

    /**
     * Return http client.
     *
     * @param array $options
     *
     * @return \GuzzleHttp\Client
     *
     * @codeCoverageIgnore
     */
    public function getHttpClient(array $options = [])
    {
        return new Client($options);
    }

    /**
     * Convert response contents to json.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array|string
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();

        if (false !== stripos($contentType, 'json') || stripos($contentType, 'javascript')) {
            return json_decode($contents, true);
        } elseif (false !== stripos($contentType, 'xml')) {
            return json_decode(json_encode(simplexml_load_string($contents)), true);
        }

        return $contents;
    }
}
