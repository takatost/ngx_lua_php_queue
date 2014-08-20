ngx.header.content_type = "text/plain";
local parser = require "redis.parser"
 
local res = ngx.location.capture("/redis?",
{ 
    args = {
	query = 'get lua_queue_count\n' 
    }
})
 
if res.status ~= 200 or not res.body then
    ngx.log(ngx.ERR, "failed to query redis")
    ngx.say('{"code": 0, "message": "failed to query redis server", "environment": "Lua"}')
    ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE);
end

local res,typ = parser.parse_reply(res.body)
if typ == parser.BULK_REPLY then
    if res ~= nil and res > '0' then
	ngx.location.capture("/redis?",
	{
	    args = {
        	query = 'decr lua_queue_count\n'
	    }
	})
    else    
	ngx.say('{"code": -1, "message": "sorry, haven\'t you turn.", "environment": "Lua"}')
	ngx.exit(200);
    end
else
    ngx.say('{"code": 0, "message": "redis server error", "environment": "Lua"}')
    ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE);
end
