<?php require_once './autoload/Autoload.php'; ?>
<?php
if (Input::hasPost('login')) {
	$username = Input::post('username');
	$password = md5(Input::post('password'));

	Validator::required($username, "Vui lòng nhập username")
		->required($password, "Vui lòng nhập password");

	if (!Validator::anyErrors()) {
		$sql = "SELECT * FROM account WHERE username = '$username' && password = '$password'";
		$data = $DB->query($sql);

		if (is_array($data)) {
			Session::put('auth', $data);
			Redirect::url('index.php');
		} else {
			$errorLogin = "Sai tên đăng nhập hoặc mật khẩu";
		}
	}
}
?>

<div id="login" class="">
	<form class="" method="POST">
		<h2 class="title">Đăng nhập tài khoản</h2>
		<?php if (Validator::anyErrors()) : ?>
			<div class="">
				<ul>
					<?php foreach (Validator::$errors as $err) : ?>
						<li>
							<h4 class="message">
								<?= $err ?>
							</h4>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		<?php elseif (isset($errorLogin)) : ?>
			<div class="">
				<h4 class="">
					<?= $errorLogin ?>
				</h4>
			</div>
		<?php endif ?>
		<div class="box">
			<div class="">
				<label>Username *</label>
				<input name="username" id="username" type="text" placeholder="Your Username">
			</div>
			<div class="">
				<label>Mật khẩu *</label>
				<input type="password" name="password" id="password" placeholder="********">
			</div>
			<div class="">
				<button class="" type="submit" name="login">Đăng Nhập</button>
			</div>
		</div>
	</form>
</div>