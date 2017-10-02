<?php
$data = [];
if (($handle = fopen("/var/tmp/fing.network", "r")) !== FALSE) {
    while (($data[] = fgetcsv($handle, 1000, ",")) !== FALSE) {
	//$num = count($data);
    }
    fclose($handle);
}

//$csv = file_get_contents('/var/tmp/fing.network');
echo json_encode($data));
?>
