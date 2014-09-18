<?php 

function my_define($a){
    foreach($a as $k => $v)
    define($k, $v);
}

my_define(array(
    "second" => 1,
    "minute" => 60,
    "hour" => 3600,
    "day" => 86400,
    "week" => 604800,
    "month" => 2592000, // 30 days month
    "year" => 31536000,
    "year2" => 31622400
));

echo second;
?>