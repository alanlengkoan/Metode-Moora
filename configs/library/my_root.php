<?php 
/*
* konfigurasi untuk mengubah root atau direktori
*/

// variabel global untuk root file
$root = $_SERVER['DOCUMENT_ROOT'] . '/spk/Metode-Moora/';

// untuk include file
function router($file, $lokasi)
{
    global $root;
    if (file_exists($root . $lokasi . $file . '.php'))
    {
        $fullPath = $root . $lokasi . $file . '.php';
        include_once $fullPath;
    }
}

// untuk include file dengan class
function autoLoadClass($namaClass) 
{
    global $root;
    $lokasi = 'configs/';
    $lokasiFile = [
        'models/',
        'library/'
    ];
    foreach ($lokasiFile as $direktori) {
        if (file_exists($root . $lokasi . $direktori . $namaClass . '.php'))
        {
            $fullPath = $root . $lokasi . $direktori . $namaClass . '.php';
            include_once $fullPath;
        }
    }
}