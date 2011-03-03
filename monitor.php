<?php
$pid = getmypid();
$socket = stream_socket_server("udp://127.0.0.1:" . $pid, $errno, $errstr, STREAM_SERVER_BIND);
if (!$socket) {
    die("$errstr ($errno)");
}
//record the pid
$path = sys_get_temp_dir() . '/phpspeed.pid';
file_put_contents($path, $pid);


while(true){
    $pkt = stream_socket_recvfrom($socket, 1, 0, $peer);
    if ($pkt === false){
        break;
    }
    
    $i = ord($pkt);
    
    inc_fun();
    
}

unlink($path);

function inc_fun(){
    static $curr_time = 0;
    static $old = 0;
    static $curr = 0;
    $now = time();
    $curr++;
    
    $sep = $now - $curr_time;
    if ($sep > 1){
        $speed = $curr - $old / $sep;
        $curr_time = $now;
        $old = $curr;
        exec("clear");
        echo $speed;
    } 
}
?>

