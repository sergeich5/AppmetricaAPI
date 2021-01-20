<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


class DeepLink extends OpenAction
{
    public string $deeplink;
    function __construct(string $deeplink, array $data = [])
    {
        $this->deeplink = $deeplink;
        parent::__construct($data);
    }

    function buildForQuery(): array
    {
        if (!isset($this->deeplink))
            $this->notSet('deeplink');

        return array(
            'deeplink' => $this->deeplink
        );
    }
}
