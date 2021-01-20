<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


class URL extends OpenAction
{
    public string $url;
    function __construct(string $url, array $data = [])
    {
        $this->url = $url;
        parent::__construct($data);
    }

    function buildForQuery(): array
    {
        if (!isset($this->url))
            $this->notSet('url');

        return array(
            'url' => $this->url
        );
    }
}