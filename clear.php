<?php
$path = sys_get_temp_dir() . '/phpspeed.pid';
unlink($path);
echo "clear ok!\n";
?>