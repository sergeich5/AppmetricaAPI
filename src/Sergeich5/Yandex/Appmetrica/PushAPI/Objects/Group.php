<?php

namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;

class Group extends Obj
{
    public int $id;
    public int $app_id;
    public string $name;

    function __construct(array $data = [])
    {
        if (isset($data['id']))
            $this->id = $data['id'];

        if (isset($data['app_id']))
            $this->app_id = $data['app_id'];

        if (isset($data['name']))
            $this->name = $data['name'];
    }
    function buildForQuery() : array
    {
        if (!isset($this->app_id))
            $this->notSet('app_id');

        if (!isset($this->name))
            $this->notSet('name');

        return array(
            'app_id' => $this->app_id,
            'name' => $this->name
        );
    }
}
