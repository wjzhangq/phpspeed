<?php

for($i=0; $i<10000; $i++){
    if ($i % 21 ==0){
        sleep(1);
    }
    uping();
}


function uping(){
    static $curr = 0;
    static $pid = '';
    static $path = '';
    static $sock;
    static $port = 0;
    
    if (!$pid){
        $pid = chr(getmypid() && 255);
        $path = sys_get_temp_dir() . '/phpspeed.pid';
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    }
    
    $now  = time();
    if ($now - $curr > 1){
        $curr = $now;
        if (is_file($path)){
            $port = intval(file_get_contents($path));
        }else{
            $port = 0;
        }
    }
    
    if ($port > 0){
        socket_sendto($socket, $pid, 1, 0, '127.0.0.1', $port);
    }
}

?>