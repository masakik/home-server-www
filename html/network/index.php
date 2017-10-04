<?php
$x = simplexml_load_file('/var/tmp/fing.network');
//print_r($x);
echo json_encode($x);

?>
