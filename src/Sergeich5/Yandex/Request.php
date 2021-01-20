<?php


namespace Sergeich5\Yandex;


abstract class Request
{
    static function GETrequest(string $url, array $headers = []) : string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);

        if (count($headers) > 0)
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
    static function POSTrequest(string $url, string $body = '', array $headers = []) : string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($body != '')
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $body);

        if (count($headers) > 0)
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
