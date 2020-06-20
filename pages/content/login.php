<?php
// untuk token mencegah terjadi perulangan
if (!isset($_SESSION['token']))
{
	$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(26));
}
// untuk masuk
if (isset($_POST["masuk"]))
{
	if ($_SESSION['token'] == $_POST['_token_form'])
	{
		$username = htmlspecialchars($_POST['username'], ENT_QUOTES);
		$password = htmlspecialchars($_POST['password'], ENT_QUOTES);
		$check    = isset($_POST['ingat_saya']) ? $_POST['ingat_saya'] : '';

		$query = $pdo->Query("SELECT * FROM tb_users WHERE username = '$username'");
		$data  = $query->fetch(PDO::FETCH_OBJ);

		if ($query->rowCount() > 0)
		{
			if (password_verify($password, $data->password))
			{
				// untuk mengecek level user
				if ($data->level == 'admin')
				{
					// set session
					$_SESSION['id_users'] = $data->id_users;
					$_SESSION['login']    = true;
					// untuk mengenerate session id
					session_regenerate_id();
					// mengecek ingat saya
					if ($check)
					{
						setcookie('id_users', $data->id_users, time() + 3600, '/', $_SERVER['SERVER_NAME']);
						setcookie('key', $_SESSION['token'], time() + 3600, '/', $_SERVER['SERVER_NAME']);
					}
					header("location: ../views/admin/index");
					exit;
				}
			} else
			{
				$valid_password = true;
			}
		} else
		{
			$valid_username = true;
		}
	} else
	{
		echo "jangan nakal!";
	}
}
?>

<!-- untuk validasi akun -->
<?php if (isset($_GET['akses'])) { ?>
	<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
		Anda harus <strong>Login</strong> terlebih dahulu untuk mengakses!
	</div>
<?php } else if (isset($valid_username)) { ?>
	<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
		<strong>Username</strong> atau <strong>Password</strong> yang Anda masukkan Salah!
	</div>
<?php } else if (isset($valid_password)) { ?>
	<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
		<strong>Username</strong> atau <strong>Password</strong> yang Anda masukkan Salah!
	</div>
<?php } else if (isset($_GET['ubah_password'])) { ?>
	<p>Ubah Password Berhasil !</p>
<?php } else if (isset($_GET['ubah_password_gagal'])) { ?>
	<p>Ubah Password Gagal !</p>
<?php } ?>

<form method="post">
	<input class="input100" type="text" name="username" placeholder="Username">	
	<input class="input100" type="password" name="password" placeholder="Password">
	<input type="hidden" name="_token_form" value="<?= $_SESSION['token']; ?>">
	<input type="checkbox" class="hidden-xs-up" id="cbx" name="ingat_saya" />
	<label class="cbx" for="cbx"></label>&nbsp;Remember Me!
	<input type="submit" name="masuk" value="Login" class="login100-form-btn" />
</form>