<?php
$output = shell_exec('gpio readall');
echo "<pre>$output</pre>";

shell_exec('gpio -g mode 17 out');
shell_exec('gpio -g write 17 1');
sleep(3);
shell_exec('gpio -g write 17 0');
?>

<button value="Refresh Page" onClick="window.location.reload()">Do it again!</button>