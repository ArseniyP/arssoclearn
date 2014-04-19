<?php
	if(isset($_GET["clear"]) && $_GET["clear"])
	{
		setcookie("id");
		setcookie("password");
		setcookie("timeCreate");
	}else if(isset($_COOKIE["id"]) && !empty($_COOKIE["id"]))
	{
		echo "<script type='text/javascript'>
				window.location = './profile.php?id=$_COOKIE[id]'
				</script>";
	}
?>
<a href="./users.txt">Просмотреть список зарегистрированных пользователей(тестовая версия)</a><br/>
<form method='post' action='./authorization.php'>
	<table>
		<tr>
			<td>Логин(ник)</td>
			<td><input type='text' name='login'></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type='password' name='password'></td>
		</tr>
		<tr>
			<td><input type='submit' value="Войти"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>

<form method='post' action='./registration.php'>
<table><tr><td>
<input type='submit' value="Регистрация">
</td></tr></table>
</form>