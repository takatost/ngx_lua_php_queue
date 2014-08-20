ngx_lua_php_queue
=================

nginx+lua+php+redis实现单业务排队系统架构

在做并发量很大的秒杀活动时，php会因为并发量过大而php进程不足导致服务器负载过大，无法同时处理过多请求，返回不友好的502错误。该项目旨在将php进程的压力转移到nginx层，使用lua作为中间语言，redis读取/储存队列信息，大大提高了并发量，降低了php进程的负载压力。

LICENSE:
https://github.com/takatost/ngx_lua_php_queue/blob/master/LICENSE

安装
------------