<?php

namespace Hogus\LaravelMiniProgram\Providers;

class TouTiaoProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @var string
     */
    protected $baseUri = 'https://developer.toutiao.com/api/apps';

    /**
     * jscode2session
     *
     * @param string $code
     *
     * @see https://developer.toutiao.com/dev/cn/mini-app/develop/server/log-in/code2session
     *
     * @return array|string
     */
    public function jscode2session(string $code, string $anonymous_code = null)
    {
        $query = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'code' => $code,
            'anonymous_code' => $anonymous_code,
        ];

        return $this->httpGet('jscode2session', $query);
    }

    /**
     * getAccessToken
     *
     * @see https://developer.toutiao.com/dev/cn/mini-app/develop/server/interface-request-credential/getaccesstoken
     *
     * @return array|string
     */
    public function getAccessToken()
    {
        $query = [
            'grant_type' => 'client_credential',
            'appid' => $this->appid,
            'secret' => $this->secret,
        ];

        return $this->httpGet('token', $query);
    }
}
