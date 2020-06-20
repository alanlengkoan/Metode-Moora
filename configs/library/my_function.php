<?php
/*
* kumpulan jenis fungsi yang sudah diproses
*/

include_once 'my_root.php';
// untuk koneksi
router('connect', 'configs/models/');

class My_function
{
    // private variabel
    private $pdo;

    function __construct()
    {
        // untuk memanggil class sql
        $sql = new sql;
        $this->pdo = $sql;
    }

    // fungsi untuk id otomatis
    public function get_id_otomatis($nmtbl, $key)
    {
        $qry = $this->pdo->GetAll($nmtbl, $key);
        $dta = $qry->fetch(PDO::FETCH_NUM);
        $row = $qry->rowCount();
        $kodeoto = "";
        $karakter = range('0', '9');
        $max = count($karakter) - 1;
        for ($i = 0; $i < 7; $i++) {
            $rand = mt_rand(0, $max);
            $kodeoto .= $karakter[$rand];
        }
        if ($dta) {
            $nilkode  = substr($row[0], 1);
            $kode     = (int) $nilkode;
            $kode     = $row + 1;
            return "{$kodeoto}{$kode}";
        } else {
            return "{$kodeoto}1";
        }
    }

    // fungsi untuk kode otomatis
    public function get_kode_otomatis($nmtbl, $key, $kd)
    {
        $qry = $this->pdo->GetAll($nmtbl, $key);
        $dta = $qry->fetch(PDO::FETCH_NUM);
        $row = $qry->rowCount();
        $y = date('y');
        $m = date('m');
        if ($dta) {
            if (date('d') != 01) {
                $nilkod = substr($row[0], 1);
                $kode   = (int) $nilkod;
                $kode   = $row + 1;
                return "{$kd}{$m}{$y}{$kode}";   
            } else {
                return "{$kd}{$m}{$y}1";
            }
        } else {
            return "{$kd}{$m}{$y}1";
        }
    }

    // fungsi untuk kode urut
    public function get_kode_urut($nmtbl, $key, $kd)
    {
        $qry = $this->pdo->GetAll($nmtbl, $key);
        $dta = $qry->fetch(PDO::FETCH_NUM);
        $row = $qry->rowCount();
        if ($dta) {
            $nilkod = substr($row[0], 1);
            $kode   = (int) $nilkod;
            $kode   = $row + 1;
            $add_k  = str_pad($kode, 3, "0", STR_PAD_LEFT);
            return "{$kd}{$add_k}";
        } else {
            return "{$kd}001";
        }
    }

    // fungsi untuk tanggal indonesia
    public function tanggal_indo($tanggal)
    {
        $bulan = array (
            1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
        );
        $pecahkan = explode('-', $tanggal); 
        return $pecahkan[2].' '.$bulan[ (int)$pecahkan[1] ].' '.$pecahkan[0];
    }

    // fungsi untuk bulan biasa
    public function bulan_biasa($bulan)
    {
        $bulan_biasa = array(
            1 => "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
        );
        $result_bulan = $bulan_biasa[$bulan];
        return $result_bulan;
    }

    // fungsi untuk bulan romawi
    public function bulan_romawi($bulan)
    {
        $bulan_romawi = array(
            1 => "I",
                "II",
                "III",
                "IV",
                "V",
                "VI",
                "VII",
                "VIII",
                "IX",
                "X",
                "XI",
                "XII"
        );
        $result_bulan = $bulan_romawi[$bulan];
        return $result_bulan;
    }

    // fungsi untuk acak token lupa password
    public function acak_token()
    {
        $token = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
        $token = str_shuffle($token);
        $token = substr($token, 0, 32);
        return $token;
    }

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}