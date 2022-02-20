<pre>
<?php
require "class/TaskList.class.php";

$tl = new TaskList();
$tl->loadTestData();

//var_dump($tl);

echo $tl->getHTMLTable();
?>
</pre>