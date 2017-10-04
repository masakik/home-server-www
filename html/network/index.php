<?php

$x = simplexml_load_file('/var/tmp/fing.network');
$x->mtime = date("d-m-Y H:i:s", filemtime('/var/tmp/fing.network'));

foreach ($x->Hosts->Host as $host) {
    if ($host->Vendor == '') {
        $mac = substr($host->HardwareAddress,0,2).substr($host->HardwareAddress,3,2).substr($host->HardwareAddress,6,2);
        $host->Vendor = getvendor($mac);
        $mac_array[$mac] = (string) $host->Vendor;
    }

}

function getvendor($mac)
{
    $url = "http://api.macvendors.com/" . urlencode($mac);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    if ($response) {
        return $response;
    } else {
        return '-- not found --';
    }
}

function write_cache($config_data) {
    $config_file = '../../data/mac_vendor_cache.txt';
    $new_content = '';
    foreach ($config_data as $section => $section_content) {
        $section_content = array_map(function($value, $key) {
            return "$key=$value";
        }, array_values($section_content), array_keys($section_content));
        $section_content = implode("\n", $section_content);
        $new_content .= "[$section]\n$section_content\n";
    }
    file_put_contents($config_file, $new_content);
}





echo 'ok';
print_r($mac_array);
echo serialize($mac_array);exit;
/*print_r($x);
exit;*/


echo json_encode($x);
?>
