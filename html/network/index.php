<?php
if (isset($_GET['f']) and $_GET['f'] == 'up') {

}

$data = [];
$labels = ['datetime', 'state', 'ip', 'field', 'host', 'mac', 'vendor'];

$x = simplexml_load_file('/var/tmp/log.xml');
//print_r($x);
echo json_encode($x);exit;



$j = file_get_contents('/var/tmp/network.json');
$json = str_replace("'",'"',$j);
$json = str_replace(",}",'}',$json);
$json = str_replace(",]",']',$json);

echo $json;exit;

if (($handle = fopen("/var/tmp/fing.network", "r")) !== FALSE) {
    $count = 0;
    while (($tmp = fgetcsv($handle, 1000, ";")) !== FALSE) {
        if ($tmp[5])
        $data[$count] = [];
        for ($i = 0; $i < 7; $i++) {
            $label = $labels[$i];
            $data[$count][$label] = $tmp[$i];
            //print_r($data);
        }
        $count++;
    }
    fclose($handle);
}

//$csv = file_get_contents('/var/tmp/fing.network');
print_r($data);exit;
echo json_encode($data);
?>
