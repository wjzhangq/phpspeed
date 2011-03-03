<?php
$path = sys_get_temp_dir() . '/phpspeed.pid';
$port = intval(file_get_contents($path));

$fp = stream_socket_client("udp://127.0.0.1:" . $port, $errno, $errstr);
if (!$fp) {
    echo "ERROR: $errno - $errstr<br />\n";
} else {
    fwrite($fp, "1");
    fclose($fp);
}

?>