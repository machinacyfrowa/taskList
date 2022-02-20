<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
<pre>
<?php
require "class/TaskList.class.php";

$tl = new TaskList();
$tl->loadTestData();

//var_dump($tl);

echo $tl->getHTMLTable();
?>
</pre>
</body>
</html>
