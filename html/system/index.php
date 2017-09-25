<?php
exec('cat /sys/class/thermal/thermal_zone0/temp',$ret);
$t1 = round($ret[0]/1000,1);
unset($ret);
exec('uname -a',$ret);
$uname = $ret[0];

?>
Temperatura da CPU: <?=$t1?><br />
Sistema: <?=$uname?> <br />
