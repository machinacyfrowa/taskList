<pre>
<?php
require "class/Task.class.php";

$t = new Task("zadanie testowe", "Treść zadania testowego");

var_dump($t->getAsArray());
?>
</pre>