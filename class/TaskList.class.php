<?php
require "class/Task.class.php";
class TaskList
{
    private $taskList;

    function __construct()
    {
        $this->taskList = array();
    }

    function addTask(Task $task)
    {
        array_push($this->taskList, $task);
    }

    function loadTestData()
    {
        $t = new Task("zadanie testowe1", "Treść zadania testowego1");
        $this->addTask($t);
        $t = new Task("zadanie testowe2", "Treść zadania testowego2");
        $this->addTask($t);
        $t = new Task("zadanie testowe3", "Treść zadania testowego3");
        $this->addTask($t);
    }

    function getHTMLTable()
    {
        $buffer = "";
        $buffer .= "<table>";
        foreach ($this->taskList as $task) {
            $buffer .= "<tr>";
            $taskArray = $task->getAsArray();
            foreach ($taskArray as $key => $value) {
                $buffer .= "<td>";
                $buffer .= $value;
                $buffer .= "</td>";
            }
            $buffer .= "</tr>";
        }

        $buffer .= "</table>";
        return $buffer;
    }
}
