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
    if (isset($_REQUEST['title']) &&
        isset($_REQUEST['content']) &&
        isset($_REQUEST['priority'])) 
    {
        $tl = $_SESSION['tl'];
        $t = new Task($_REQUEST['title'],$_REQUEST['content'], $_REQUEST['priority']);
        $tl->addTask($t);
        header('Location: tasklist.php');
    }
    ?>
    <h1>Dodaj nowe zadanie:</h1>
    <div id="newTaskForm">
        <form action="new.php" method="post">
            <label for="titleInput">Temat zgłoszenia (zadania):</label>
            <input type="text" name="title" id="titleInput">
            <label for="contentInput">Treść zgłoszenia</label>
            <textarea type="text" name="content" id="contentInput"></textarea>
            <label for="prioritySelect">Priorytet:</label>
            <select name="priority" id="prioritySelect">
                <option value="1">Niski</option>
                <option value="2" selected="selected">Średni</option>
                <option value="3">Wysoki</option>
            </select>
            <input type="submit" value="Dodaj zadanie">
        </form>
        
    </div>
    <a href="taskList.php">Wróć do listy zadań</a>
</body>

</html>