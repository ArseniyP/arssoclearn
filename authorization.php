<?php 
	//Проверка на пустые параметры
	
	$correctLogin = true;
	$correctPassword = true;
	
	if(isset($_POST["login"]) && empty($_POST["login"]))
		$correctLogin = false;

	if(isset($_POST["password"]) && empty($_POST["password"]))

		$correctPassword = false;
	
	if($correctLogin && $correctPassword)
	{
		include("users.php");
		$user = getUser("login", $_POST["login"]);
		//ЕСЛИ КУКА С ТАКИМ NAME ЕСТЬ, ТО ОНА НЕ ПЕРЕЗАПИСЫВАЕТСЯ, А ДОБАВЛЯЕТСЯ НОВАЯ С ТАКИМ-ЖЕ ИМЕНЕМ!
		setcookie("id", $user["id"], time()+60, "/");//Куки живут 60 сек
		setcookie("password", $user[password], time()+60, "/");
		setcookie("timeCreate", time(), time()+100, "/"); //Живет 1 мин 40 сек
		echo "<script type='text/javascript'>
				window.location = './profile.php?id=$user[id]'
				</script>";
		exit();		
	}
	
	if(!$correctLogin)
		echo "Не введен логин<br/>";
	if(!$correctPassword)
		echo "Не введен пароль<br/>";
	
	if(!$correctLogin || !$correctPassword)
	{
		echo "<a href='./index.php'>Повторить вход</a>";
		exit();
	}
	else
		echo "<script type='text/javascript'>
				window.location = './profile.php?id=$user[id]'
			</script>";
?>