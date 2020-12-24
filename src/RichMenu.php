<?php

namespace Tbs\LineBot;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Client\Response;

trait RichMenu
{
    /**
     * https://developers.line.biz/en/reference/messaging-api/#create-rich-menu
     *
     * @param array $config
     * @return Response
     */
    public function createRichMenu(array $config)
    {
        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/richmenu', $config);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#upload-rich-menu-image
     *
     * @param string $richmenu_id
     * @param string $file_path
     * @return Response
     */
    public function uploadRichMenu(string $richmenu_id, string $file_path)
    {
        return $this->httpWithChannelAccessToken()
            ->withBody(file_get_contents($file_path, 'r'), mime_content_type($file_path))
            ->post("https://api-data.line.me/v2/bot/richmenu/{$richmenu_id}/content");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#download-rich-menu-image
     *
     * @param string $richmenu_id
     * @return Response
     */
    public function downloadRichMenuImage(string $richmenu_id)
    {
        return $this->httpWithChannelAccessToken()
            ->get("https://api-data.line.me/v2/bot/richmenu/{$richmenu_id}/content");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-rich-menu-list
     *
     * @return Response
     */
    public function getRichMenuList()
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/richmenu/list');
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-rich-menu
     *
     * @param string $richmenu_id
     * @return Response
     */
    public function getRichMenu(string $richmenu_id)
    {
        return $this->httpWithChannelAccessToken()
            ->get("https://api.line.me/v2/bot/richmenu/{$richmenu_id}");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#delete-rich-menu
     *
     * @param string $richmenu_id
     * @return Response
     */
    public function deleteRichMenu(string $richmenu_id)
    {
        return $this->httpWithChannelAccessToken()
            ->delete("https://api.line.me/v2/bot/richmenu/{$richmenu_id}");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#set-default-rich-menu
     *
     * @param string $richmenu_id
     * @return Response
     */
    public function setDefaultRichMenu(string $richmenu_id)
    {
        return $this->httpWithChannelAccessToken()
            ->post("https://api.line.me/v2/bot/user/all/richmenu/{$richmenu_id}");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-default-rich-menu-id
     *
     * @return Response
     */
    public function getDefaultRichMenu()
    {
        return $this->httpWithChannelAccessToken()
            ->get('https://api.line.me/v2/bot/user/all/richmenu');
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#cancel-default-rich-menu
     *
     * @return Response
     */
    public function cancelDefaultRichMenu()
    {
        return $this->httpWithChannelAccessToken()
            ->delete('https://api.line.me/v2/bot/user/all/richmenu');
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#link-rich-menu-to-user
     *
     * @param string $richmenu_id
     * @param string $line_user_id
     * @return Response
     */
    public function linkRichMenuToUser(string $richmenu_id, string $line_user_id)
    {
        return $this->httpWithChannelAccessToken()
            ->post("https://api.line.me/v2/bot/user/{$line_user_id}/richmenu/{$richmenu_id}");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#link-rich-menu-to-users
     *
     * @param string $richmenu_id
     * @param iterable $line_user_ids
     * @return Response
     */
    public function linkRichMenuToMultipleUser(string $richmenu_id, iterable $line_user_ids)
    {
        if ($line_user_ids instanceof Arrayable) {
            $line_user_ids = $line_user_ids->toArray();
        }

        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/richmenu/bulk/link', [
                'richMenuId' => $richmenu_id,
                'userIds' => $line_user_ids,
            ]);
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#get-rich-menu-id-of-user
     *
     * @param string $line_user_id
     * @return Response
     */
    public function getRichMenuOfUser(string $line_user_id)
    {
        return $this->httpWithChannelAccessToken()
            ->post("https://api.line.me/v2/bot/user/{$line_user_id}/richmenu");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#unlink-rich-menu-from-user
     *
     * @param string $line_user_id
     * @return Response
     */
    public function unLinkRichMenuFromUser(string $line_user_id)
    {
        return $this->httpWithChannelAccessToken()
            ->delete("https://api.line.me/v2/bot/user/{$line_user_id}/richmenu");
    }

    /**
     * https://developers.line.biz/en/reference/messaging-api/#unlink-rich-menu-from-users
     *
     * @param iterable $line_user_ids
     * @return Response
     */
    public function unLinkRichMenuFromMultipleUser(iterable $line_user_ids)
    {
        if ($line_user_ids instanceof Arrayable) {
            $line_user_ids = $line_user_ids->toArray();
        }

        return $this->httpWithChannelAccessToken()
            ->asJson()
            ->post('https://api.line.me/v2/bot/richmenu/bulk/unlink', [
                'userIds' => $line_user_ids,
            ]);
    }
}
