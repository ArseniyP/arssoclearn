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

function mySetCookie()
{
	$durationOfStayLim = 30; //Длительность прибывания в сессии в секундах

	if(!isset($_COOKIE["ssesionTime"]))
	{
		//Выставляем уровень обработки ошибок
		//http://www.softtime.ru/info/articlephp.php?id_article=23
		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); //~E_WARNING - подавляю Warning, но это не решает проблемму с её созданием
		
		$_COOKIE['ssesionTime'] = time(); //Без этой инициализации куки работать не будут!
		$isCreate = setcookie("ssesionTime", $_COOKIE['ssesionTime'], time() + $durationOfStayLim);
		if(FALSE == $isCreate)
			echo "<font color='red'>Кукис не создан!</font><br>";
		else
			echo "Куки создан<br>";
		//Устанавливаем cookie на длительность прибывания пользователя на странице
		//durationOfStay - длительнсть прибывания
		/* Параметры
			1 - имя устанавливаемого cookie, 
			2 - значение, хранящееся в cookie
			3 - время в секундах с начала эпохи, по истечение которого текущий cookie становится недейтвительным */
	}
}	
	
function fromAutorization() //ТУТ ТОЖЕ НАДО ПОДКЛЮЧИТЬ КУКИ
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
	$usersRead = file("./users.txt", FILE_IGNORE_NEW_LINES);
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
			inProfile();
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
}

function inProfile()
{
	mySetCookie();
	
	$Users;
	$usersRead = file("./users.txt", FILE_IGNORE_NEW_LINES);
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
		if(strcmp($sUser["id"], $_GET["id"]) === 0) //БАГ где-то ТУТ!
		{
			$isSearch = true;
			$user = $sUser;
			break;
		}
	}
	
	if($isSearch)
	{
		if(strcmp($user["nickName"], "None") == 0)
			echo "Пользователь ".$user["login"]." авторизирован.";
		else
			echo "Пользователь ".$user["nickName"]." авторизирован.";
	}
	else
	{
		echo "Пользователь с id $_GET[id] не зарегистирован";
		exit();
	}
	
	echo "<h4 align='center'>Странийа профайла пользователя находится на стадии разработки.</h4>";
	echo "Общая длительность сессии установленна в 30 сек<br/>"; //30 - магическое число, правильно $durationOfStayLim
	if(isset($_COOKIE["ssesionTime"]))
		echo "Ссесия еще длится".time() - $_COOKIE['ssesionTime']." сек<br>";
	else
		header("Location: ./index.php");
}
	
?>