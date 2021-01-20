<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


class AppmetricaDeviceIDs extends Device
{
    function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->setType('appmetrica_device_id');
    }
}
