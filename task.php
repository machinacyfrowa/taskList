<?php
require "class/TaskList.class.php";
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if(isset($_REQUEST['code']))
    {
        $task = $_SESSION['tl']->getByCode($_REQUEST['code']);

        if(isset($_REQUEST['action']))
            if($_REQUEST['action'] == "close") 
            {
                $_SESSION['tl']->closeByCode($_REQUEST['code']);
                $tl->syncToDB();
                header('Location: tasklist.php');
            }
                

        echo "Kod zadania: ".$task['code']."<br>";
        echo "Tytuł zadania: ".$task['title']."<br>";
        echo "Treść zadania: ".$task['content']."<br>";
        if($task['resolvedTimestamp'] == 0) {
            echo "Status zadania: w toku<br>";
        } else {

            echo "Zadanie zakońćzono: ".$task['resolved']."<br>";
        }
        //TODO: pobrać i wyświetlić pozostałe pola zadania
        echo '<a href="task.php?'
            ."code=".$task['code']
            ."&action=close"
            .'">Zamknij zadanie</a><br>';
    }

    ?>
    <a href="taskList.php">Wróć do listy zadań</a>
</body>
</html>