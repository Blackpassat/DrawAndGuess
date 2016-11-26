<?php

	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	sleep(1);
	// array{userName, userName}
	$id_numbers = array("Spark", "Raymond", "Yisha", "Joshua", "Aaron");
	echo json_encode($id_numbers);
?>