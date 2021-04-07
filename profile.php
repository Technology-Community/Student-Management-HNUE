<?php require_once './autoload/Autoload.php'; ?>
<?php
$title = "Profile";
require_once './layouts/header.php';
?>
<?php
$id = Session::get('auth')[0]->id;

$sql = '
	SELECT account.username, account.full_name
	FROM account
	WHERE id =' .  $id;

$infomationUser = $DB->query($sql)[0];
// print_r($infomationUser);
?>


<div class="container">
	<div class="row">
		<h4>
			Thông tin người dùng
		</h4>
	</div>
	<div clas="container-fluid">
		<div class=row>
			<div class="col-sm-4 col-4">
				<h6>
					Username
				</h6>
			</div>
			<div class="col-sm-8 col-8">
				<h6>
					<?= $infomationUser->username ?>
				</h6>
			</div>
		</div>
		<div class=row>
			<div class="col-sm-4 col-4">
				<h6>
					Full Name
				</h6>
			</div>
			<div class="col-sm-8 col-8">
				<h6>
					<?= $infomationUser->full_name ?>
				</h6>
			</div>
		</div>
	</div>
</div>

<?php require_once './layouts/footer.php'; ?>