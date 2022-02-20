<?php
require "class/TaskList.class.php";
session_start();
if(!isset($_SESSION['tl']))
{
    $tl = new TaskList();
    $tl->loadTestData();
    $_SESSION['tl'] = $tl;
} else {
    $tl = $_SESSION['tl'];
}
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
    <h1>Lista zadań:</h1>
    <?php
    echo $tl->getHTMLTable();
    ?>
    <a href="new.php">Dodaj nowe zadanie</a>
</body>

</html>