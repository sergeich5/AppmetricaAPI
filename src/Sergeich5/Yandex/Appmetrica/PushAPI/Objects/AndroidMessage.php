<?php


namespace Sergeich5\Yandex\Appmetrica\PushAPI\Objects;


class AndroidMessage extends Obj
{
    public string $title;
    public string $text;
    public string $data = '';
    public int $priority = 0;
    public int $time_to_live = 86400;
    public string $urgency = 'high';
    public string $visibility = 'public';
    public OpenAction $open_action;

    function buildForQuery(): array
    {
        if (!isset($this->text))
            $this->notSet('text');

        if (!isset($this->title))
            $this->notSet('title');

        if (!isset($this->open_action))
            $this->notSet('open_action');

        $arr = array(
            'silent' => false,
            'content' => array(
                'title' => $this->title,
                'text' => $this->text,
                'data' => $this->data,
                'priority' => $this->priority,
                'time_to_live' => $this->time_to_live,
                'urgency' => $this->urgency,
                'visibility' => $this->visibility
            )
        );

        $action = $this->open_action->buildForQuery();
        if (count($action) > 0)
            $arr['open_action'] = $action;

        return $arr;
    }
}
