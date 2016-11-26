<?php

	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	sleep(2);
	// array{nextUserID, nextUserName, questionContent}
	// *When game is over, set nextUserID to null
	$parameters = array("12345", "YiSha", "pirate of the caribbean");
	echo json_encode($parameters);
?>