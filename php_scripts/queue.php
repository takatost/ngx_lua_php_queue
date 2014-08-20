<?php
include 'redisserver/RedisServer.php';
include 'config.php';

$redis = new RedisServer();
$redis->connect($redisConfig['host'], $redisConfig['port']);
$stock = $redis->send_command('get', 'lua_queue_stock');
if($stock && $stock > 0)
{
    $redis->send_command('decr', 'lua_queue_stock');
    $result = $redis->send_command('get', 'lua_queue_count');
    echo json_encode(['code' => 1, 'message' => 'success', 'stock' => intval($stock) - 1, 'queue' => intval($result), 'environment' => 'Php']);
}
else
    echo json_encode(['code' => -2, 'message' => 'failed. out of stock.', 'stock' => intval($stock), 'environment' => 'Php']);
?>
