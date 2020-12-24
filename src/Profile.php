<?php

namespace Tbs\LineBot;

trait Profile
{
    /**
     * https://developers.line.biz/en/reference/line-login/#get-user-profile
     *
     * @param string $access_token
     * @return \Illuminate\Http\Client\Response
     */
    public function getProfile(string $access_token)
    {
        return $this->http()
            ->withHeaders([
                'Authorization' => "Bearer {$access_token}",
            ])
            ->get('https://api.line.me/v2/profile');
    }
}
