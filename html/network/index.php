<?php

require '../../lib/redbean-php/rb.php';
R::setup('sqlite:../../data/website.db');
//R::setup('sqlite:/tmp/website.db');
//R::setup();

$x = simplexml_load_file('/var/tmp/fing.network');
$x->mtime = date("d-m-Y H:i:s", filemtime('/var/tmp/fing.network'));

foreach ($x->Hosts->Host as $host) {
    if ($host->Vendor == '') {
        $mac = substr($host->HardwareAddress,0,2).substr($host->HardwareAddress,3,2).substr($host->HardwareAddress,6,2);
        $host->Vendor = getvendor($mac);
        //$mac_array[$mac] = (string) $host->Vendor;
    }

}

function getvendor($mac)
{
    if($r = R::findOne('vendor','mac=?',[ $mac ])) {
        return $r->vendor;
    } else {
        $url = "http://api.macvendors.com/" . urlencode($mac);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if ($response) {
            $r = R::dispense('vendor');
            $r->mac = $mac;
            $r->vendor = $response;
            R::store($r);
            return $response;
        } else {
            return '-- not found --';
        }
    }


}

function write_cache($config_file , $config_data) {
    $config_file = '../../data/mac_vendor_cache.txt';
    $new_content = '';
    foreach ($config_data as $key => $val) {
        $new_content .= $key.'='.$val."\n";
    }
    file_put_contents($config_file, $new_content);
}



//write_cache('../../data/mac_vendor_cache.txt', $mac_array);

//echo 'ok';
//print_r($mac_array);
//echo serialize($mac_array);exit;
/*print_r($x);
exit;*/


echo json_encode($x);
?>
