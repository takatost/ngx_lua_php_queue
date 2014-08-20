<?php
include 'redisserver/RedisServer.php';
include 'config.php';

$redis = new RedisServer();
$redis->connect($redisConfig['host'], $redisConfig['port']);
$result = $redis->send_command('set', 'lua_queue_count', '10');
echo 'success';
?>
