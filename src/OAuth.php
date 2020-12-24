<?php

namespace Tbs\LineBot;

trait OAuth
{
    /**
     * https://developers.line.biz/en/reference/line-login/#issue-access-token
     *
     * @param string $code
     * @param string $redirect_uri
     * @return \Illuminate\Http\Client\Response
     */
    public function issueAccessToken(string $code, string $redirect_uri)
    {
        $request_data = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'client_id' => config('line-bot.channel_id'),
            'client_secret' => config('line-bot.channel_secret'),
        ];

        return $this->http()
            ->asForm()
            ->post('https://api.line.me/oauth2/v2.1/token', $request_data);
    }

    /**
     * https://developers.line.biz/en/reference/line-login/#verify-access-token
     *
     * @param string $access_token
     * @return \Illuminate\Http\Client\Response
     */
    public function verifyAccessToken(string $access_token)
    {
        return $this->http()
            ->get('https://api.line.me/oauth2/v2.1/verify', ['access_token' => $access_token]);
    }

    /**
     * @param string $refresh_token
     * @return \Illuminate\Http\Client\Response
     */
    public function refreshAccessToken(string $refresh_token)
    {
        $request_data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' => config('line-bot.channel_id'),
            'client_secret' => config('line-bot.channel_secret'),
        ];

        return $this->http()
            ->asForm()
            ->post('https://api.line.me/oauth2/v2.1/token', $request_data);
    }

    /**
     * @param string $access_token
     * @return \Illuminate\Http\Client\Response
     */
    public function revokeAccessToken(string $access_token)
    {
        $request_data = [
            'access_token' => $access_token,
            'client_id' => config('line-bot.channel_id'),
            'client_secret' => config('line-bot.channel_secret'),
        ];

        return $this->http()
            ->asForm()
            ->post('https://api.line.me/oauth2/v2.1/revoke', $request_data);
    }

    /**
     * https://developers.line.biz/en/reference/line-login/#verify-id-token
     *
     * @param string $id_token
     * @return \Illuminate\Http\Client\Response
     */
    public function verifyIdToken(string $id_token)
    {
        $request_data = [
            'id_token' => $id_token,
            'client_id' => config('line-bot.channel_id'),
        ];

        return $this->http()
            ->post('https://api.line.me/oauth2/v2.1/verify', $request_data);
    }
}
