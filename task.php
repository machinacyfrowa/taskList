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

        echo "Kod zadania: ".$task['code']."<br>";
        echo "Tytuł zadania: ".$task['title']."<br>";
        //TODO: pobrać i wyświetlić pozostałe pola zadania
    }

    ?>
</body>
</html>