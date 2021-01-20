<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


class Batch extends Obj
{
    public AndroidMessage $androidMessage;
    private array $devices = [];

    function addDevice(Device $device) : self
    {
        $this->devices[] = $device->buildForQuery();
        return $this;
    }

    function buildForQuery(): array
    {
        if (!isset($this->androidMessage))
            $this->notSet('android_message');
        if (count($this->devices) == 0)
            $this->notSet('devices');


        return [array(
            'messages' => array(
                'android' => $this->androidMessage->buildForQuery()
            ),
            'devices' => $this->devices
        )];
    }
}
