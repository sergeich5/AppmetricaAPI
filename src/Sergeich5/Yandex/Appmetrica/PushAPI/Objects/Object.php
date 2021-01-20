<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


abstract class Obj
{
    function __construct(array $data = []) {}
    abstract function buildForQuery() : array;
    protected function notSet(string $param)
    {
        throw new \Exception($param.' not set');
    }
}
