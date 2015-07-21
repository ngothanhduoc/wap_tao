<?php
$memcache = memcache_connect('10.10.20.93', 11211);
//$memcache = @memcache_connect('localhost', 11211);
try{
	if ($memcache) {
		echo '{"error_code":"0","error_string":"SUCCESS"}';
                memcache_close($memcache);
	}else {
		echo '{"error_code":"1","error_string":"Connection to memcached failed"}';
	}
        
}catch (Exception $ex){
    echo '{"error_code":"1","error_string":"' . $ex->getMessage() . '"}';
}

?>