<?php
/*
* kumpulan jenis vendor yang sudah diproses
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once 'my_root.php';
// menload vendor autoload
router('autoload', 'vendor/');
// untuk koneksi
router('connect', 'configs/models/');

class My_vendor {

    // fungsi untuk kirim email
    public function kirim_email($to, $pesan)
    {
        // class phpmailer
        $mail = new PHPMailer(true);
        // konfigurasi server dengan menggunakan akun gmail
        // $mail->SMTPDebug = true; // untuk mengetahui bugnya
        $mail->isSMTP(); // untuk melakukan proses pengiriman
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'alanlengkoan16@gmail.com';
        $mail->Password   = '26031998alan';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587; // port ssl dan 465
        // pengirim dari email
        $mail->setFrom('alanlengkoan16@gmail.com', 'Administrator !');
        // email yang akan dikirim
        $mail->addAddress($to);
        $mail->addCC('alanlengkoan16@gmail.com');
        $mail->addBCC('alanlengkoan16@gmail.com');
        // isi email yang akan dikirim
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password Anda !';
        // penyimpanan isi pesan
        $mail->Body    = $pesan;
        $mail->AltBody = strip_tags($pesan);
        // untuk mengirim pesan
        if ($mail->send()) {
            exit(json_encode(array('status' => 1, 'msg' => 'Silahkan cek Email Anda !')));
        } else {
            exit(json_encode(array('status' => 1, 'msg' => 'Silahkan coba kembail Anda ! '.$mail->ErrorInfo)));
        }
    }

    // funsgi untuk mengambil data dengan server-side
    public function dt_server_side($tabel, $primaryKey, $kolom)
    {
        $koneksi = new Koneksi;
        $kon = array(
            'host' => $koneksi->host,
            'user' => $koneksi->user,
            'pass' => $koneksi->pass,
            'db'   => $koneksi->dbnm
        );

        // echo json_encode(
        //     SSP::simple( $_POST, $kon, $tabel, $primaryKey, $kolom )
        // );
    }

}