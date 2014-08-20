<?php
include 'redisserver/RedisServer.php';

$redis = new RedisServer();
$redis->connect('localhost', 6379);
$result = $redis->send_command('set', 'lua_queue_count', '10');
echo 'success';
?>
