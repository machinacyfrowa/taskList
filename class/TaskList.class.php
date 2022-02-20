<?php
require "class/Task.class.php";
class TaskList
{
    private $taskList;

    function __construct()
    {
        $this->taskList = array();
    }

    function syncToDB() {
        $db = new mysqli('localhost', 'root','','taskList');
        foreach ($this->taskList as $task) {
            $taskArray = $task->getAsArray();
            $code = $taskArray['code'];
            $q = $db->prepare("SELECT * FROM task WHERE code = ?");
            $q->bind_param('s', $code);
            $q->execute();
            $result = $q->get_result();
            if($result->num_rows > 0) 
            {
                //zadanie juz istnieje w bazie danych - zaktualizuj
                $q = $db->prepare("UPDATE task 
                                    SET created = ?, resolved = ?,
                                        title = ?, content = ?,
                                        priority = ?
                                    WHERE code = ?");
                $createdTimestamp = date('Y-m-d H:i:s',$taskArray['createdTimestamp']);
                $resolvedTimestamp = date('Y-m-d H:i:s',$taskArray['resolvedTimestamp']);
                $q->bind_param('ssssis', 
                                    $createdTimestamp,
                                    $resolvedTimestamp,
                                    $taskArray['title'],
                                    $taskArray['content'],
                                    $taskArray['priority'],
                                    $taskArray['code']
                );

                $q->execute();
            } else {
                //zadania nie ma w bazie danych - dodaj
                $q = $db->prepare("INSERT INTO task 
                    (code, created, resolved, title, content, priority)
                    VALUES (?, ?, ?, ?, ?,?)");
                $q->bind_param('sssssi', $taskArray['code'],
                date('Y-m-d H:i:s',$taskArray['createdTimestamp']),
                date('Y-m-d H:i:s',$taskArray['resolvedTimestamp']),
                                    $taskArray['title'],
                                    $taskArray['content'],
                                    $taskArray['priority']
                                    
                );
                $q->execute();
            }
        }
        

    }
    function syncFromDB() {
        $db = new mysqli('localhost', 'root','','taskList');
        $q = $db->prepare("SELECT * FROM task");
        $q->execute();
        $result = $q->get_result();
        $this->taskList = array();
        while($row = $result->fetch_assoc()) {
            $t = new Task($row['title'], $row['content'], $row['priority']);
            $t->assignCode($row['code']);
            $t->setTimestamps(strtotime($row['created']), strtotime($row['resolved']));
            array_push($this->taskList, $t);
        }
    }

    function addTask(Task $task)
    {
        $task->assignCode($this->generateNewCode());
        array_push($this->taskList, $task);
    }

    function generateNewCode() : string
    {
        $code = "";
        for($i = 0; $i < 11; $i++) 
        {
            if($i == 3 || $i ==7) //na trzecim i 7 miejscu
                $code .= '-';
            else {
                $char = chr(rand(65,90)); //generuj losowa literę A-Z
                $code .= $char;
            }
        }
        // TODO : check form duplicate codes

        return $code;
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
        $buffer .= "<td>Kod zgłoszenia</td>
                    <td>Data zgłoszenia</td>
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
            $buffer .= $taskArray['code'];
            $buffer .= "</td>";
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
            $buffer .= '<a href="task.php?code='
                            .$taskArray['code']
                            .'">';
            $buffer .= $taskArray['title'];
            $buffer .= '</a>';
            $buffer .= "</td>";
            $buffer .= "<td>";
            if ($taskArray['resolvedTimestamp'] == 0) {
                //sprawa nierozwiązana
                $buffer .= "w toku";
            } else {
                //sprawa rozwiązana
                $buffer .= "Zamknięte ";
                $buffer .= $taskArray['resolved'];
            }
            $buffer .= "</td>";
            $buffer .= "</tr>";
        }

        $buffer .= "</table>";
        return $buffer;
    }
    function getByCode(string $code) {
        //przejdz przez wszystkie zapisane zadania
        foreach ($this->taskList as $task) {
            //pobierz pojedyńczo całe zadanie jako tablice
            $taskArray = $task->getAsArray();
            //sprawdz czy kod zadania jest zgodny  z poszukiwanym
            if($taskArray['code'] == $code)
                // jesli kod jest zgodny zwroc tablice z zadaniem
                return $taskArray;
        }
        //jeśli doszliśmy tu to nie znaleziono zgodnego kodu - zwróć pusty
        return NULL;
    }
    function closeByCode(string $code) {
        foreach ($this->taskList as $task) {
            $task->close($code);
        }
    }
}
