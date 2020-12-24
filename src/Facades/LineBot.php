<?php

namespace Tbs\LineBot\Facades;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Facade;

/**
 * Class Line
 *
 * @package Tbs\Line\Facades
 *
 * @method \Illuminate\Http\RedirectResponse redirectToLine(string $redirect_uri, string $scope = null, array $options = [])
 * @method \Tbs\LineBot\Message appendTextMessage(string $message, array $options = [])
 * @method \Illuminate\Http\Client\Response sendReplyMessage(string $reply_token, $messages = null, bool $notification_disabled = false)
 * @method \Illuminate\Http\Client\Response sendPushMessage(string $to, $messages = null, bool $notification_disabled = false)
 * @method \Illuminate\Http\Client\Response sendMulticastMessage(iterable $to, $messages = null, bool $notification_disabled = false)
 * @method \Illuminate\Http\Client\Response sendNarrowCastMessage(array $options, bool $notification_disabled = false)
 * @method \Illuminate\Http\Client\Response getNarrowCastMessage()
 * @method \Illuminate\Http\Client\Response sendBroadcastMessage($messages = null, bool $notification_disabled = false)
 * @method \Illuminate\Http\Client\Response getContent(string $message_id)
 * @method \Illuminate\Http\Client\Response getTargetLimitForAdditionalMessages()
 * @method \Illuminate\Http\Client\Response getNumberOfMessagesSentInThisMonth()
 * @method \Illuminate\Http\Client\Response getNumberOfSendReplyMessage(Carbon $date)
 * @method \Illuminate\Http\Client\Response getNumberOfSendPushMessage(Carbon $date)
 * @method \Illuminate\Http\Client\Response getNumberOfSendMulticastMessage(Carbon $date)
 * @method \Illuminate\Http\Client\Response getNumberOfSendBroadcastMessage(Carbon $date)
 * @method \Illuminate\Http\Client\Response issueAccessToken(string $code, string $redirect_uri)
 * @method \Illuminate\Http\Client\Response verifyAccessToken(string $access_token)
 * @method \Illuminate\Http\Client\Response refreshAccessToken(string $refresh_token)
 * @method \Illuminate\Http\Client\Response revokeAccessToken(string $access_token)
 * @method \Illuminate\Http\Client\Response verifyIdToken(string $id_token)
 * @method \Illuminate\Http\Client\Response getProfile(string $access_token)
 * @method \Illuminate\Http\Client\Response createRichMenu(array $config)
 * @method \Illuminate\Http\Client\Response uploadRichMenu(string $richmenu_id, string $file_path)
 * @method \Illuminate\Http\Client\Response downloadRichMenuImage(string $richmenu_id)
 * @method \Illuminate\Http\Client\Response getRichMenuList()
 * @method \Illuminate\Http\Client\Response getRichMenu(string $richmenu_id)
 * @method \Illuminate\Http\Client\Response deleteRichMenu(string $richmenu_id)
 * @method \Illuminate\Http\Client\Response setDefaultRichMenu(string $richmenu_id)
 * @method \Illuminate\Http\Client\Response getDefaultRichMenu()
 * @method \Illuminate\Http\Client\Response cancelDefaultRichMenu()
 * @method \Illuminate\Http\Client\Response linkRichMenuToUser(string $richmenu_id, string $line_user_id)
 * @method \Illuminate\Http\Client\Response linkRichMenuToMultipleUser(string $richmenu_id, iterable $line_user_ids)
 * @method \Illuminate\Http\Client\Response getRichMenuOfUser(string $line_user_id)
 * @method \Illuminate\Http\Client\Response unLinkRichMenuFromUser(string $line_user_id)
 * @method \Illuminate\Http\Client\Response unLinkRichMenuFromMultipleUser(iterable $line_user_ids)
 *
 * @see \Tbs\LineBot\LineBot
 */
class LineBot extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'line-bot';
    }
}
