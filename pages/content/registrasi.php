<form method="post">
  <input type="text" name="inpnama" placeholder="Nama" />
  <br />
  <input type="email" name="inpemail" placeholder="Email" />
  <br />
  <input type="text" name="inpusername" placeholder="Username" />
  <br />
  <input type="password" name="inppassname" id="inppassname" placeholder="Password" />
  <br />
  <input type="password" name="inppassword" id="inppassword" class="form-password" placeholder="Ulangi Password" oninput="cekPass()" />
  <label class="pesan"></label>
  <br />
  <label>
    <input type="checkbox" class="form-checkbox" /> Lihat Password!
  </label>
  <br />
  <a href="index">Batal</a>
  <input type="submit" name="daftar" id="daftar" value="Daftar" />
  Sudah punya akun? <a href="login">Masuk</a>
</form>

<?php
if (isset($_POST['daftar'])) {
  $nama   = htmlspecialchars($_POST['inpnama'], ENT_QUOTES);
  $usernm = htmlspecialchars($_POST['inpusername'], ENT_QUOTES);
  $email  = htmlspecialchars($_POST['inpemail'], ENT_QUOTES);
  $passnm = htmlspecialchars($_POST['inppassname'], ENT_QUOTES);
  $passwd = htmlspecialchars($_POST['inppassword'], ENT_QUOTES);
  $level  = 'users';

  if ($passnm != $passwd) {
    echo "Password tidak sama!";
  } else {

    $passhash = password_hash($passwd, PASSWORD_DEFAULT);
    // untuk fungsi INSERT parameternya (nama_tabel, nama_kolom, nama_value/nama_hasil)
    $insert = $mysqli->Insert("tb_user", ["nama", "email", "username", "passname", "password", "level"], [$nama, $email, $usernm, $passnm, $passhash, $level]);

    if ($insert === TRUE) {
      echo "Berhasil";
    } else {
      echo "Gagal";
    }
  }
}
?>