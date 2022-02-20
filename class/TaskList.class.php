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
        $buffer .= "<tr>";
        $buffer .= "<td>Data zgłoszenia</td>
                    <td>Priorytet</td>
                    <td>Temat zgłoszenia</td>
                    <td>Status</td>";
        $buffer .= "</tr>";
        foreach ($this->taskList as $task) {
            $buffer .= "<tr>";
            $taskArray = $task->getAsArray();
            /* legacy code
            foreach ($taskArray as $key => $value) {
                $buffer .= "<td>";
                $buffer .= $value;
                $buffer .= "</td>";
            } */
            $buffer .= "<td>";
            $buffer .= $taskArray['created'];
            $buffer .= "</td>";
            $buffer .= "<td>";
            switch ($taskArray['priority']) {
                case 1:
                    $buffer .= "Niski";
                    break;
                case 2:
                    $buffer .= "Średni";
                    break;
                case 3:
                    $buffer .= "Wysoki";
                    break;
            }
            $buffer .= "</td>";
            $buffer .= "<td>";
            $buffer .= $taskArray['title'];
            $buffer .= "</td>";
            $buffer .= "<td>";
            if ($taskArray['resolvedTimestamp'] == 0) {
                //sprawa nierozwiązana
                $buffer .= "w toku";
            } else {
                //sprawa rozwiązana
                $buffer .= $taskArray['resolved'];
            }
            $buffer .= "</td>";
            $buffer .= "</tr>";
        }

        $buffer .= "</table>";
        return $buffer;
    }
}
