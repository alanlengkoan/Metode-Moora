<?php 
/*
* kumpulan jenis fungsi untuk proses login yang berhubungan dengan aktivitas login sampai logout
*/

include_once 'my_root.php';
// untuk koneksi
router('connect', 'configs/models/');

class My_login
{
    // private variabel
    private $pdo;

    function __construct()
    {
        // untuk memanggil class sql
        $sql = new sql;
        $this->pdo = $sql;
    }

    // fungsi untuk mengambil data yang login
    function GetDataUser($id_login)
    {
        // mengecek apabila id_login ada atau tidak
        if ($id_login == NULL || empty($id_login) || $id_login == 0) {
            // apa bila benar
            $data = "Data tidak terdaftar!";
            // mengembalikan hasil
            return $data;
        } else {
            // mengambil data berdasarkan id user
            $query = $this->pdo->GetWhere('tb_users', 'id_users', $id_login);
            $rows  = $query->fetch(PDO::FETCH_OBJ);
            $data  = array(
                'id_users' => $rows->id_users,
                'level'    => $rows->level,
                'login'    => true
            );
            // mengembalikan hasil
            return $data;
        }
    }

}