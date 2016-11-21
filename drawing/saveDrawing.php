<?php 
	date_default_timezone_set('PRC');

	$imgData=base64ToImage($_POST["img"]);
	$fileName = getRandomName();
	$src = "tempImage/".$fileName.".png";
	file_put_contents($src, $imgData); 
	echo $src;

	function base64ToImage($str){
	    if ($str) {
		    $str=substr($str, 22);
		    $str= str_replace(" ","+",$str);
		    return base64_decode($str);
	    }
	}

	function getRandomName() {
		$date = getdate();
		$str1 = $date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"].$date["seconds"];
		$str2 =rand(0,100);
		return $str1.$str2;
	}
?>