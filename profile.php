<?php
	//Проверка на пустые параметры
	$incorrectData = false;
	if(isset($_POST["login"]) && empty($_POST["login"]))
	{
		echo "Не введен логин<br/>";
		$incorrectData = true;
	}
	if(isset($_POST["password"]) && empty($_POST["password"]))
	{
		echo "Не введен пароль<br/>";
		$incorrectData = true;
	}
	
	if($incorrectData)
	{
		echo "<a href='./index.php'>Повторить вход</a>";
		exit();
	}
	
	$Users;
	$usersRead = file("./users.txt", FILE_IGNORE_NEW_LINES);
	if($usersRead == false)
	{
		echo "Не удалось открыть файл users.txt";
		exit();
	}
	
	foreach($usersRead as $line)
	{
		$logAndPass = explode(' ', $line);
		$Users[] = Array("login" => $logAndPass[0], "password" => $logAndPass[1]);
	}
	
	$user;
	$isSearch = false;
	foreach($Users as $sUser)
	{
		if(strcmp($sUser["login"], $_POST["login"]) === 0)
		{
			$isSearch = true;
			$user = $sUser;
		}
	}
	
	if($isSearch)
	{
		if(strcmp($user["password"], $_POST["password"]) === 0)
			echo "Пользователь ".$user["login"]." авторизирован.";
		else
			echo "Введен неверный пароль";
	}
	else
		echo "Пользователь ".$_POST["login"]." не зарегистирован";
?>