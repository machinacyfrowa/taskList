<?php
class Task
{
    private $code; //unikatowy kod sprawy
    private $createdTimestamp; //data i czas utworzenia
    private $resolvedTimestamp; //data i czas zamknięcia
    private $title; //tytuł (nazwa) zadania
    private $content; // treść zadania
    private $priority; //priorytet zadania {1=>'Low',2=>'Med',3=>'High'}

    function __construct(string $title, string $content, int $priority = 2)
    {
        $this->createdTimestamp = time();
        $this->resolvedTimestamp = 0; //0 oznacza sprawę nierozwiązaną
        $this->title = $title;
        $this->content = $content;
        if ($priority < 1 || $priority > 3)
            $this->priority = 2;
        else
            $this->priority = $priority;
    }

    function getAsArray()
    {
        $result = array(); //stwórz pustą tabelę
        //zapisz kolejno właściwości zadania do tej tabeli pod indeksami
        //(kluczami) zgodnymi z ich nazwą
        $result['code'] = $this->code;
        $result['createdTimestamp'] = $this->createdTimestamp;
        $result['created'] = date('d M Y H:i:s', $this->createdTimestamp);
        $result['resolvedTimestamp'] = $this->resolvedTimestamp;
        $result['resolved'] = date('d M Y H:i:s', $this->resolvedTimestamp);
        $result['title'] = $this->title;
        $result['content'] = $this->content;
        $result['priority'] = $this->priority;
        //zwróć tablicę
        return $result;
    }

    function assignCode(string $code) 
    {
        $this->code = $code;
    }

    function close(string $code) {
        if($this->code == $code)
            $this->resolvedTimestamp = time();
    }
}
