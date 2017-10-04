<?php
exec('cat /sys/class/thermal/thermal_zone0/temp', $ret);
$data['CpuTemp'] = round($ret[0] / 1000, 1);

$data['OS'] = exec('uname -a', $ret);

$data['DiskUsage'] = exec('df / --output=used -h|grep -v "Used" ', $ret);
//$data['DiskTotal'] = disk_total_space('/');
$data['DiskTotal'] = exec('df / --output=size -h|grep -v "Used" ', $ret);
$data['ip'] = $_SERVER['SERVER_ADDR'];

echo json_encode($data);
?>

