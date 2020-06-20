<?php
// memulai session
session_start();
// untuk router
include_once '../configs/library/my_root.php';
// autoload class
spl_autoload_register('autoLoadClass');
// untuk memanggil class sql
$pdo = new Sql;
// untuk class my_login
$mylog = new My_login;
// untuk class my_function
$myfun = new My_function;
// untuk mengecek apakah terdapat cookie id
if (isset($_COOKIE['id_users']) && isset($_COOKIE['key']))
{
	$data = $mylog->GetDataUser($_COOKIE['id_users']);
}
// untuk mencegah agar user tidak dapat mengakses form login setelah login
if (isset($_SESSION['login']))
{
	$data = $mylog->GetDataUser($_SESSION['id_users']);
}
// mengecek data user
if (isset($data['id_users']))
{
	if ($data['level'] == 'admin')
	{
		// untuk admin
		$_SESSION['id_users'] = $data['id_users'];
		$_SESSION['login']    = $data['login'];
		header("location: ../views/admin/index");
	}
}
// fungsi untuk minifier html
function minifier($path)
{
	if (trim($path) === "") {
		return $path;
	}
	$path = preg_replace_callback(
		'#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s',
		function ($matches) {
			return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
		},
		str_replace("\r", "", $path)
	);
	$search = array(
		'#<(img|input)(>| .*?>)#s',
		'#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
		'#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s',
		'#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s',
		'#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s',
		'#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s',
		'#<(img|input)(>| .*?>)<\/\1\x1A>#s',
		'#(&nbsp;)&nbsp;(?![<\s])#',
		'#&\#(?:10|xa);#',
		'#&\#(?:32|x20);#',
		'#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
	);
	$replace = array(
		"<$1$2</$1\x1A>",
		'$1$2$3',
		'$1$2$3',
		'$1$2$3$4$5',
		'$1$2$3$4$5$6$7',
		'$1$2$3',
		'<$1$2',
		'$1 ',
		"\n",
		' ',
		""
	);
	$path = preg_replace($search, $replace, $path);
	return $path;
}

ob_start("minifier");
$content = ( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_REQUEST['content']) ) ? str_replace('-', '_', $_REQUEST['content']) : $_REQUEST['content'] ;
	if (file_exists('content/'.$content.'.php'))
	{
		include_once 'atribut/head.php';
		switch ($content)
		{
			case $content:
				include_once 'content/'.str_replace('-', '_', $content).'.php';
				break;
		}
		include_once 'atribut/foot.php';
	} else
	{
		include_once 'content/403.html';
	}
ob_end_flush();