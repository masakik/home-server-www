<?php

$x = simplexml_load_file('/var/tmp/fing.network');
$x->mtime = date("d-m-Y H:i:s", filemtime('/var/tmp/fing.network'));
//print_r($x);
echo json_encode($x);

?>
