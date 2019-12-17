<?php

namespace Hogus\LaravelMiniProgram\Providers;

class BaiDuProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * jscode2session
     *
     * @param string $code
     *
     * @see https://smartprogram.baidu.com/docs/develop/api/open/log_Session-Key/
     *
     * @return array|string
     */
    public function jscode2session(string $code)
    {
        $params = [
            'client_id' => $this->appid,
            'sk' => $this->secret,
            'code' => $code,
        ];

        return $this->httpPost('https://spapi.baidu.com/oauth/jscode2sessionkey', $params);
    }

    /**
     * getAccessToken
     *
     * @see https://smartprogram.baidu.com/docs/develop/serverapi/power_exp/
     *
     * @return array|string
     */
    public function getAccessToken()
    {
        $params = [
            'grant_type' => 'client_credential',
            'client_id' => $this->appid,
            'client_secret' => $this->secret,
            'scope' => 'smartapp_snsapi_base'
        ];

        return $this->httpPost('https://openapi.baidu.com/oauth/2.0/token', $params);
    }
}
