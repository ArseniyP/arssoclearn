<?php

	if(isset($_POST["login"]) || isset($_POST["password"]))
		fromAutorization();
	else if(isset($_GET["id"]))
		inProfile();
	else
	{
		echo "Ошибка 404";
		exit();
	}

function fromAutorization()
{
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
	$usersRead = file("./users.txt", FILE_IGNORE_NEW_LINES); //РЕШИТЬ ВОПРОС С КОДИРОВКОЙ users.txt ANSI
	if($usersRead == false)
	{
		echo "Не удалось открыть файл users.txt";
		exit();
	}
	
	foreach($usersRead as $line)
	{
		//$line = iconv("CP1251", "UTF-8", $line); //Баг пофиксен изменением кодировки файла users.txt ANSI->UTF8
		//На всякий случай аналогичное проделал с newID.txt
		$logAndPass = explode(' ', $line);
		$Users[] = Array("login" => $logAndPass[0], "password" => $logAndPass[1], "nickName" => $logAndPass[2], "id" => $logAndPass[3]);
	}


	$user;
	$isSearch = false;
	foreach($Users as $sUser)
	{
		if(strcmp($sUser["login"], $_POST["login"]) === 0) //БАГ где-то ТУТ!
		{
			$isSearch = true;
			$user = $sUser;
			break;
		}
	}
	
	if($isSearch)
	{
		if(strcmp($user["password"], $_POST["password"]) === 0)
		{
			if(strcmp($user["nickName"], "None") == 0)
				echo "Пользователь ".$user["login"]." авторизирован.";
			else
				echo "Пользователь ".$user["nickName"]." авторизирован.";
		}
		else
		{
			echo "Введен неверный пароль";
			exit();
		}
	}
	else
	{
		echo "Пользователь ".$_POST['login']." не зарегистирован";
		exit();
	}
	echo "<br/><br/><br/><br/>Странийа профайла пользователя находится на стадии разработки.";
}

function inProfile()
{
}
	
?>