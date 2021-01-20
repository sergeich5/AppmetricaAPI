<?php


namespace Sergeich5\Yandex;


abstract class OAuth
{
    static function getAuthLink(string $clientID) : string
    {
        return 'https://oauth.yandex.ru/authorize?response_type=token&client_id='.$clientID;
    }
}
