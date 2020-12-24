<?php

return [
    /**
     * LINE Login Channel ID
     */
    'channel_id' => env('LINE_CHANNEL_ID'),

    /**
     * LINE Login Channel secret
     */
    'channel_secret' => env('LINE_CHANNEL_SECRET'),

    /**
     * Messaging API Channel access token
     */
    'channel_access_token' => env('LINE_CHANNEL_ACCESS_TOKEN'),

    /**
     * Permissions requested from the user. For more information,
     * See https://developers.line.biz/en/docs/line-login/integrate-line-login/#scopes
     */
    'scope' => 'profile openid',

    'request_options' => [
        /**
         * Describes the SSL certificate verification behavior of a request.
         * - Set to true to enable SSL certificate verification and use the default CA bundle provided by operating system.
         * - Set to false to disable certificate verification (this is insecure!).
         * - Set to a string to provide the path to a CA bundle to enable verification using a custom certificate.
         *
         * Read more [https://docs.guzzlephp.org/en/stable/request-options.html?highlight=verify#verify]
         */
        'http_verify' => true,
    ],
];
