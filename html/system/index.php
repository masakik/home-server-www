<?php
exec('cat /sys/class/thermal/thermal_zone0/temp', $ret);
$data['CpuTemp'] = round($ret[0] / 1000, 1);

$data['OS'] = exec('uname -a', $ret);

$data['DiskUsage'] = exec('df / --output=used -h|grep -v "Used" ', $ret);
//$data['DiskTotal'] = disk_total_space('/');
$data['DiskTotal'] = exec('df / --output=size -h|grep -v "Used" ', $ret);


echo json_encode($data);exit;


unset($ret);

$uname = $ret[0];

?>
Temperatura da CPU: <?= $t1 ?><br/>
Sistema: <?= $uname ?> <br/>

<pre>
<?php

echo shell_exec('whoami');
//echo "pi\n";
//echo shell_exec('ls /home/pi -la');
//echo "tmp\n";
//echo shell_exec('ls /var/tmp/ -la');


if (file_exists('/var/tmp/network.json')) {
    $network = file_get_contents('/var/tmp/network.json');
    echo $network;
    print_r(json_decode($network));
    echo json_last_error();
} else {
    echo "nao existe";
}
?>
</pre>
OK
