<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


abstract class Device extends Obj
{
    private string $type;
    private array $values = [];

    function setType(string $type) : self
    {
        $this->type = $type;
        return $this;
    }

    function addValue(string $value) : self
    {
        $this->values[] = $value;
        return $this;
    }

    function devicesCount() : int
    {
        return count($this->values);
    }

    function buildForQuery(): array
    {
        if (!isset($this->type))
            $this->notSet('type');

        return array(
            'id_type' => $this->type,
            'id_values' => $this->values
        );
    }
}
