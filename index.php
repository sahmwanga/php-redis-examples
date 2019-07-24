<?php

//DONE: this is all done using the installation not library: sudo apt-get -y install php-redis

$redis = new Redis();
$redis->connect("127.0.0.1",6379);
$redis->auth("guest");

//set and get key
$redis->set("key01","value01");
print 'key01.value: '.$redis->get("key01")."\n";

//append and get key
$redis->append("key01","value02");
print "key01.value: ".$redis->get("key01")."\n";

$redis->set("key02",1);
print "key02.value ".$redis->get("key02")."\n";

//increment
$redis->incr("key02",100);
print "key02.value: ".$redis->get("key02")."\n";

//list
$redis->lPush("list01","value01");
$redis->lPush("list01","value02");
print "list01.values : ";
print_r($redis->lRange("list01",0,"-1"))


?>