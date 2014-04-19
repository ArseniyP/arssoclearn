<?php
	//echo "Страница профайла<br>"; exit;
	
	if(isset($_COOKIE["timeCreate"]) && !empty($_COOKIE["timeCreate"]))
	{
		$delta = time() - $_COOKIE["timeCreate"];
		if($delta > 60)
		{
			echo "<script type='text/javascript'>
				window.location = './timeOut.php'
				</script>";
			exit();
		}
	}
	else
	{
		echo "<script type='text/javascript'>
				window.location = './index.php'
				</script>"; //Пользователь не авторизирован
		exit();
	}
		
	echo "Страница может быть закеширована вашим браузером<br>";
	echo "Пожалуйста, обновите (F5) страницу для перепроверки<br><br>";
		
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
	echo "На момент загрузки страницы была $delta секунда сессии (обновляем сами F5).<br>";
	echo "Сессия действительна только 1 мин.<br>";  
?>
	<form method='post' action='./index.php?clear=true'>
		<input type="submit" value="Выход">
		<input type="hidden" name="isDelete" value="true">
	<form>