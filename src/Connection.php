<?php

namespace Tbs\LineBot;

use Illuminate\Support\Facades\Http;

class Connection
{
    /**
     * @var string
     */
    protected $access_token;

    public function __construct()
    {
        $this->access_token = config('line-bot.channel_access_token');
    }

    /**
     * @param string $access_token
     * @return $this
     */
    public function setAccessToken(string $access_token)
    {
        $this->access_token = $access_token;

        return $this;
    }

    /**
     * @return \Illuminate\Http\Client\PendingRequest
     */
    protected function http()
    {
        return Http::withOptions([
            'verify' => config('line-bot.request_options.http_verify'),
        ]);
    }

    /**
     * @return \Illuminate\Http\Client\PendingRequest
     */
    protected function httpWithChannelAccessToken()
    {
        return $this->http()
            ->withHeaders([
                'Authorization' => "Bearer {$this->access_token}",
            ]);
    }
}
