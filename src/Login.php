<?php

namespace Tbs\LineBot;

use Illuminate\Support\Str;

trait Login
{
    /**
     * https://developers.line.biz/en/docs/line-login/integrate-line-login/#making-an-authorization-request
     *
     * @param string $redirect_uri
     * @param string|null $scope
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToLine(string $redirect_uri, string $scope = null, array $options = [])
    {
        $state = Str::random(6);
        session(['state' => $state]);

        $request_data = array_merge([
            'response_type' => 'code',
            'client_id' => config('line-bot.channel_id'),
            'redirect_uri' => $redirect_uri,
            'state' => $state,
            'scope' => $scope ?? config('line-bot.scope'),
        ], $options);

        $nonce = md5(json_encode($request_data));
        $params = http_build_query(array_merge($request_data, ['nonce' => $nonce]));
        $url = 'https://access.line.me/oauth2/v2.1/authorize';

        return response()->redirectTo("{$url}?{$params}");
    }
}
