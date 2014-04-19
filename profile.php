<?php
	if(isset($_COOKIE["timeCreate"]) && !empty($_COOKIE["timeCreate"]))
	{
		$delta = time() - $_COOKIE["timeCreate"];
		if($delta > 60)
		{
			header("Location: index.php?clear=true");
			echo "header Location: index.php отработал";
		}
	}
	else
		header("Location: index.php"); //Пользователь не авторизирован
		
	echo "Страница может быть закеширована вашим браузером<br>";
	echo "Пожалуйста, обновите(F5) страницу для перепроверки<br><br>";
		
	include("./users.php");
	
	$user = getUserByID($_GET["id"]);
	if(FALSE === $user )
	{
		echo "<font color='red'>Пара пользователь/пароль не валидная.<font><br>";
		exit();
	}
	
	if(isset($_COOKIE["id"]) && (strcmp($_COOKIE["id"], $user["id"]) === 0))
	{}
	else
		echo "Страница другого пользователя. Только для просмотра.<br><br>";

	if(isset($user["nickName"]) && !empty($user["nickName"]) && strcmp($user["nickName"], "None") != 0)
		echo "Пользователь $user[nickName] авторзирован.<br>";
	else
		echo "Пользователь $user[login] авторзирован.<br>";
	
	echo "<br><br><br><br><br><br>";
	echo "------------------------------------------------------------<br>";
	echo "Сессия длится $delta сек (обновляем смами F5).<br>";
	echo "Сессия действительна только 1 мин.<br>";  
?>
	<form method='post' action='./index.php?clear=true'>
		<input type="submit" value="Выход">
		<input type="hidden" name="isDelete" value="true">
	<form>