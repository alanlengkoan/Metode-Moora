<h4>Reset Password Anda !</h4>
<p>Masukkan email Anda.</p>

<form id="form-forget">
    <input type="email" name="email" id="email" placeholder="Email" />
    <br />
    <br /> 
    <input type="submit" name="reset" id="reset" value="Reset Password" />
</form>

<div class="response"></div>

<?php
if(isset($_POST["email"])) {
    // email tujuan
    $email = $mysqli->realEscapeString($_POST['email']);
    // cek email
    $sql = $mysqli->GetWhere('tb_user', 'email', $email);
    $row = $sql->fetch_array(MYSQLI_ASSOC);
    if ($sql->num_rows > 0) {
        $token = $myfunction->acak_token();
        $tokenExpire = date('U') + 1800;
        // untuk update token
        $sql = $mysqli->Update('tb_user', 'email' ,$email, ['token', 'tokenExpire'], [$token, $tokenExpire]);
        // untuk url
        $url = "http://localhost/modelsistemku/forgot_password?email=$email&token=$token";
        // isi pesan
        $pesan = 'Hi, '.$row['nama'];
        $pesan .= '<p> Silahkan klik link dibawah untuk reset password Anda :';
        $pesan .= '<br /> <a href="'.$url.'">'.$url.'</a> </p>';
        // kirim email dan mengecek
        $myvendor->kirim_email($email, $pesan);
    } else {
        // gagal
        exit(json_encode(array('status' => 0, 'msg' => 'Email yang Anda masukkan tidak terdaftar !')));
    }
}
?>