<?php
include "config/koneksi.php";
include "library/oop.php";


$go = new oop();
$tabel = 'login';
@$username = $_POST['username'];
@$password = base64_encode(@$_POST['password']);
@$redirect = 'dashboard.php';

if(isset($_POST['login'])){

	$go->login($con, $tabel, $username, $password, $redirect);
}


?>

<form method='post'>
	<table align="center">
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="password"></td>
		</tr>
			<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="login" value="MASUK"></td>
		</tr>
	</table>
</form>