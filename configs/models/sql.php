<?php
// untuk koneksi
include_once 'connect.php';

class Sql
{
  // private variabel
  private $kon;

  function __construct()
  {
    $koneksi   = new Koneksi;
    $db        = $koneksi->kondb();
    $this->kon = $db;
  }

  // fungsi untuk semua query
  public function Query($sql)
  {
    $query = $this->kon->prepare($sql);
    $query->execute();
    return $query;
  }

  // fungsi query untuk mengambil semua data
  public function GetAll($tabel, $id)
  {
    $query = $this->kon->prepare("SELECT * FROM $tabel ORDER BY $id");
    $query->execute();
    return $query;
  }

  // fungsi query untuk mengambil data berdasarkan id
  public function GetWhere($tabel, $field, $field_value)
  {
    $query = $this->kon->prepare("SELECT * FROM $tabel WHERE $field = $field_value");
    $query->bindParam($field, $field_value, PDO::PARAM_INT);
    $query->execute();
    return $query;
  }

  // function insert for all
  public function Insert($tabel, array $kolom, array $data)
  {
    try
    { 
      // untuk mengecek field pada tabel
      $query = $this->Query("DESCRIBE {$tabel}");
      $field = [];
      while ($row = $query->fetch(PDO::FETCH_OBJ)) {
          $field[] = $row->Field;
      }
      if (array_search('ins', $field) && array_search('upd', $field) && array_search('ins_l', $field) && array_search('upd_l', $field)) {
        array_push($kolom, 'ins', 'upd');
        array_push($data, date("Y-m-d h:i:s"), date("Y-m-d h:i:s"));
      }
      // untuk kolom
      $columns = implode(", ", $kolom);
      // untuk melakukan prepare
      $b_colomns = implode(", :", $kolom);
      // menyimpan data
      $query = $this->kon->prepare("INSERT INTO $tabel ($columns) VALUES (:$b_colomns)");
      // membuat variabel array
      $post_data = [];
      // menggabungkan kolom dan data
      for ($i = 0; $i < count($kolom); $i++) { 
        $post_data[$kolom[$i]] = $data[$i];
      }
      // untuk melakukan bind param
      foreach ($post_data as $key => $value) {
        $query->bindParam($key, $value);
      }
      // untuk mengeksekusi
      $query->execute($post_data);
      return 1;
    }
    catch(PDOException $e)
    {
      return 0;
    }
  }

  // update for all
  public function Update($tabel, $u_id, $id, array $kolom, array $value)
  {
    try
    { 
      // untuk mengecek field pada tabel
      $query = $this->Query("DESCRIBE {$tabel}");
      $field = [];
      while ($row = $query->fetch(PDO::FETCH_OBJ)) {
          $field[] = $row->Field;
      }
      if (array_search('ins', $field) && array_search('upd', $field) && array_search('ins_l', $field) && array_search('upd_l', $field)) {
        array_push($kolom, 'upd');
        array_push($value, date("Y-m-d h:i:s"));
      }
      // membuat variabel array
      $post_data = array();
      for ($i = 0; $i < count($value); $i++) {
        // menggabung kolom menjadi key value menjadi isi
        $post_data[$kolom[$i]]=$value[$i];
      }
      // membuat vriabel string
      $input = "";
      foreach ($post_data as $key => $val) {
        // mengambil hasil string
        $input .= $key.' = '.":$key".', ';
      }
      // menghilangkan koma pada bagian akhir
      $input = substr($input, 0, -2);
      // melakukan update
      $query = $this->kon->prepare("UPDATE $tabel SET $input WHERE $u_id = '$id'");
      // untuk melakukan bind param
      foreach ($post_data as $key => $value) {
        $query->bindParam($key, $value);
      }
      // untuk mengeksekusi
      $query->execute($post_data);
      return 1;
    }
    catch(PDOException $e)
    {
      return 0;
    }
  }

  // function delete for all
  public function Delete($tabel, $u_id, $id)
  {
    // melakukan hapus
    try
    { 
      $query = $this->kon->prepare("DELETE FROM $tabel WHERE $u_id = '$id'");    
      $query->execute();
      return 1;
    }
    catch(PDOException $e)
    {
      return 0;
    }
  }

}
?>
