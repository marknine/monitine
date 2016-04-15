<?php

// Grabbing server time, uptime, load averages and number of users logged in.
exec( "uptime", $cmd );
$uptime = explode( " ", $cmd[0] );

$servertime = $uptime[1];
$up = $uptime[3];
$users = $uptime[5];
$load_avg_1 = $uptime[10];
$load_avg_5 = $uptime[11];
$load_avg_15 = $uptime[12];



$cmd = "";
// Grabbing sensor information (CPU temps)
exec( "sensors", $cmd );

// Searching specifically for Core CPU temps
// Search specifically for lines starting with "Core " and reindex the array so it starts at 0
$cpu_temps = array_values( preg_grep ( "/^Core\.*/", $cmd ) );
$temps = array();
foreach ( $cpu_temps as $core ) {
    $exploded_string = explode( " ", $core );
    $coreNum = explode( ":" , $exploded_string[1] );
    $coreNum = "Core " . $coreNum[0];
    $temps[$coreNum] = $exploded_string[8];
}


$cmd = "";
// Grabbing ethernet link information
exec( "ifconfig | grep eth -A 2", $cmd );
$ifconfig = $cmd;


print_r($uptime);
print_r($temps);
print_r($ifconfig);