<?php
// cek data
$email = $_GET['email'];
$token = $_GET['token'];
$sql = $mysqli->GetWhere('tb_user', 'email', $email);
$row = $sql->fetch_array(MYSQLI_ASSOC);

if (empty($email) && empty($token)) {
    header('location: index.php');
} else {
    if ($row['token'] != $token) {
        header('location: index.php');
    } else { ?>

        <form method="post">
            <input type="hidden" name="inp_token" value="<?= $token ?>" />
            <input type="hidden" name="inp_email" value="<?= $email ?>" />
            <input type="password" name="inp_new_password" id="inp_new_password" placeholder="Masukkan Password Baru" />
            <br />
            <input type="password" name="inp_new_password_ulangi" class="form-password" id="inp_new_password_ulangi" placeholder="Ulangi Password Baru" oninput="cekPass()" />
            <label class="pesan"></label>
            <br />
            <label>
                <input type="checkbox" class="form-checkbox" /> Lihat Password!
            </label>
            <br />
            <input type="submit" name="ubah" id="ubah" value="Ubah">
        </form>

        <!-- jquery js -->
        <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
        <!-- validator js -->
        <script src="assets/js/validator.js"></script>

        <?php 
        if (isset($_POST['ubah'])) {
            
            $token = $mysqli->realEscapeString($_POST['inp_token']);
            $email = $mysqli->realEscapeString($_POST['inp_email']);
            $pass1 = $mysqli->realEscapeString($_POST['inp_new_password']);
            $pass2 = $mysqli->realEscapeString($_POST['inp_new_password_ulangi']);

            $passhash = password_hash($pass2, PASSWORD_DEFAULT);
            if (empty($pass1) && empty($pass2)) {
                header('location: forgot_password.php');
                exit();
            } else {
                $update = $mysqli->Update('tb_user', 'email' ,$email, ['password'], [$passhash]);

                if ($update === TRUE) {
                    header('location: login.php?ubah_password');
                } else {
                    header('location: login.php?ubah_password_gagal');
                }
            }

        }
        ?>

    <?php }
}