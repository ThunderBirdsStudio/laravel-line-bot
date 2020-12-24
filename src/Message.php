<?php

namespace Tbs\LineBot;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

trait Message
{
    protected $messages = [];

    /**
     * https://developers.line.biz/en/reference/messaging-api/#message-objects
     *
     * @param string $message
     * @param array $options
     * @return $this
     */
    public function appendTextMessage(string $message, array $options = [])
    {
        $this->messages[] = array_merge([
            'type' => 'text',
            'text' => $message,
        ], $options);

        return $this;
    }

    /**
     * @param string|string[]|null $messages
     * @return array
     */
    private function buildMessages($messages = null)
    {
        $messages = collect(Arr::wrap($messages))
            ->map(function ($message) {
                return [
                    'type' => 'text',
                    'text' => $message,
                ];
            })
            ->merge($this->messages)
            ->toArray();

        if (count($messages) > 5) {
            throw new \Exception('Messages amount can not greater than 5.');
        }

        return $messages;
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#send-reply-message
     *
     * @param string $reply_token
     * @param string|string[]|null $messages
     * @param bool $notification_disabled
     * @return Response
     */
    public function sendReplyMessage(string $reply_token, $messages = null, bool $notification_disabled = false)
    {
        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/message/reply', [
                'replyToken' => $reply_token,
                'messages' => $this->buildMessages($messages),
                'notificationDisabled' => $notification_disabled,
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#send-push-message
     *
     * @param string $to
     * @param string|string[]|null $messages
     * @param bool $notification_disabled
     * @return Response
     */
    public function sendPushMessage(string $to, $messages = null, bool $notification_disabled = false)
    {
        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/message/push', [
                'to' => $to,
                'messages' => $this->buildMessages($messages),
                'notificationDisabled' => $notification_disabled,
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#send-multicast-message
     *
     * @param iterable $to
     * @param string|string[]|null $messages
     * @param bool $notification_disabled
     * @return Response
     */
    public function sendMulticastMessage(iterable $to, $messages = null, bool $notification_disabled = false)
    {
        if ($to instanceof Arrayable) {
            $to = $to->toArray();
        }

        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/message/multicast', [
                'to' => $to,
                'messages' => $this->buildMessages($messages),
                'notificationDisabled' => $notification_disabled,
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#send-narrowcast-message
     *
     * @param null $messages
     * @param bool $notification_disabled
     * @return Response
     * @throws \Exception
     */
    public function sendNarrowCastMessage(array $options, bool $notification_disabled = false)
    {
        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/message/narrowcast', array_merge([
                'messages' => $this->buildMessages(),
                'notificationDisabled' => $notification_disabled,
            ], $options));
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-narrowcast-progress-status
     *
     * @return Response
     */
    public function getNarrowCastMessage()
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/progress/narrowcast');
    }

    /**
     * @param string|string[]|null $messages
     * @param bool $notification_disabled
     * @return Response
     * @throws \Exception
     */
    public function sendBroadcastMessage($messages = null, bool $notification_disabled = false)
    {
        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/message/broadcast', [
                'messages' => $this->buildMessages($messages),
                'notificationDisabled' => $notification_disabled,
            ]);
    }

    /**
     * @param string $message_id
     * @return Response
     */
    public function getContent(string $message_id)
    {
        return $this->httpWithChannelAccessToken()
            ->get("https://api-data.line.me/v2/bot/message/{$message_id}/content");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-quota
     *
     * @return Response
     */
    public function getTargetLimitForAdditionalMessages()
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/quota');
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-consumption
     *
     * @return Response
     */
    public function getNumberOfMessagesSentInThisMonth()
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/quota/consumption');
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-number-of-reply-messages
     *
     * @param Carbon $date
     * @return Response
     */
    public function getNumberOfSendReplyMessage(Carbon $date)
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/delivery/reply', [
                'date' => $date->setTimezone('Asia/Tokyo')->format('Ymd'),
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-number-of-push-messages
     *
     * @param Carbon $date
     * @return Response
     */
    public function getNumberOfSendPushMessage(Carbon $date)
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/delivery/push', [
                'date' => $date->setTimezone('Asia/Tokyo')->format('Ymd'),
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-number-of-multicast-messages
     *
     * @param Carbon $date
     * @return Response
     */
    public function getNumberOfSendMulticastMessage(Carbon $date)
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/delivery/multicast', [
                'date' => $date->setTimezone('Asia/Tokyo')->format('Ymd'),
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-number-of-broadcast-messages
     *
     * @param Carbon $date
     * @return Response
     */
    public function getNumberOfSendBroadcastMessage(Carbon $date)
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/message/delivery/broadcast', [
                'date' => $date->setTimezone('Asia/Tokyo')->format('Ymd'),
            ]);
    }
}
