<?php 
// untuk session start
session_start();
// untuk router
include_once '../../../configs/library/my_root.php';
// autoload class
spl_autoload_register('autoLoadClass');
// untuk memanggil class sql
$pdo = new Sql;
// untuk class my_login
$mylog = new My_login;
// untuk class my_function
$myfun = new My_function;

// mengambil id user
$id   = $_SESSION['id_users'];
$data = $mylog->GetDataUser($_SESSION['id_users']);

$aksi = $_REQUEST['aksi'];
if (file_exists($aksi.'.php')) {
    switch ($aksi) {
        case $aksi:
            include_once $aksi.'.php';
            break;
	}
} else {
	include_once '403.html';
}