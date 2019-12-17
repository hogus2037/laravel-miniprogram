<?php

namespace Hogus\LaravelMiniProgram\Providers;

class WeChatProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @var string
     */
    protected $baseUri = 'https://api.weixin.qq.com';

    /**
     * jscode2session
     *
     * @param string $code
     *
     * @see https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/login/auth.code2Session.html
     *
     * @return array|string
     */
    public function jscode2session(string $code)
    {
        $query = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'js_code' => $code,
            'gtant_type' => 'authorization_code'
        ];

        return $this->httpGet('sns/jscode2session', $query);
    }

    /**
     * getAccessToken
     *
     * @see https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/access-token/auth.getAccessToken.html
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

        return $this->httpGet('cgi-bin/token', $query);
    }
}
