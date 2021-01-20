<?php

namespace Sergeich5\Yandex\Appmetrica\PushAPI;

use Sergeich5\Yandex\Appmetrica\PushAPI\Objects\Batch;
use Sergeich5\Yandex\Appmetrica\PushAPI\Objects\Group;
use Sergeich5\Yandex\Request;

class Push
{
    private string $token;
    private const API_URL = 'https://push.api.appmetrica.yandex.net/push/v1/';

    function with(string $token) : self
    {
        $this->token = $token;
        return $this;
    }
    function getGroups(int $appId) : array
    {
        $response = self::GETrequest('management/groups', [
            'app_id' => $appId
        ]);

        $arr = [];
        foreach ($response['groups'] as $group) {
            $arr[] = new Group($group);
        }

        return $arr;
    }
    function createGroup(Group $group) : Group
    {
        $response = $this->POSTrequest('management/groups', json_encode(array(
            'group' => $group->buildForQuery()
        )));

        print_r($response);

        return new Group($response['group']);
    }
    function sendPush(int $group_id, string $tag, Batch $batch) : bool
    {
        $this->POSTrequest('send-batch', json_encode(array(
            'push_batch_request' => array(
                'group_id' => $group_id,
                'tag' => $tag,
                'batch' => $batch->buildForQuery()
            )
        )));

        return true;
    }

    private function GETrequest(string $endpoint, array $params = []) : array
    {
        if (!isset($this->token))
            throw new \Exception('Token not set: use method \'with(TOKEN) before\'');

        $url = self::API_URL.$endpoint;
        if (count($params) > 0)
            $url .= '?'.http_build_query($params);

        return json_decode(Request::GETrequest($url, [
            'Authorization: OAuth '.$this->token
        ]), true);
    }
    private function POSTrequest(string $endpoint, string $body) : array
    {
        if (!isset($this->token))
            throw new \Exception('Token not set: use method \'with(TOKEN) before\'');

        $url = self::API_URL.$endpoint;

        return $this->response(
            json_decode(
                Request::POSTrequest(
                    $url,
                    $body,
                    [
                        'Authorization: OAuth '.$this->token,
                        'Content-Type: application/json'
                    ]
                ),
                true
            )
        );
    }
    private function response(?array $response) : array
    {
        if (is_null($response))
            throw new \Exception('Empty response');

        if (isset($response['errors'])) {
            $e = [];
            foreach ($response['errors'] as $error)
                $e[] = $error['error_type'] . ': '.$error['message'];

            throw new \Exception(implode(PHP_EOL, $e));
        }

        return $response;
    }
}
