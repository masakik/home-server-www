<?php
exec('cat /sys/class/thermal/thermal_zone0/temp', $ret);
$data['CpuTemp'] = round($ret[0] / 1000, 1);

$data['OS'] = exec('uname -a', $ret);

$data['DiskUsage'] = exec('df / --output=used -h|grep -v "Used" ', $ret);
$data['DiskTotal'] = exec('df / --output=size -h|grep -v "Used" ', $ret);

$data['ip'] = $_SERVER['SERVER_ADDR'];

$file = fopen('/var/tmp/system.updates','r');
$updt['datetime'] = trim(fgets($file,50));
$updt['data'] = array();
while (($line = fgets($file,50)) !== false) {
  $updt['data'][] = trim($line);
}
fclose($file);
$data['updates'] = $updt;
echo json_encode($data);
?>

