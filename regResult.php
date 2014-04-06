<?php
	$incorrectData = false;
	if(isset($_POST["login"]) && empty($_POST["login"]))
	{
		echo "<font color='red'>Не введен логин</font><br/>";
		$incorrectData = true;
	}
	
	if(isset($_POST["password"]) && empty($_POST["password"]))
	{
		echo "<font color='red'>Не введен пароль</font><br/>";
		$incorrectData = true;
	}
	
	if(isset($_POST["password_confirmation"]) && empty($_POST["password_confirmation"]))
	{
		echo "<font color='red'>Пароль подтверждения не введен</font><br/>";
		$incorrectData = true;
	}
	
	if($incorrectData)
	{
		echo "<b><a href='./registration.php'>Попробывать еще раз</a><b><br/>";
		exit();
	}
	
	//Тут проверка уникальности логина
	$usersRead = file("./users.txt", FILE_IGNORE_NEW_LINES);
	if($usersRead == false)
	{
		echo "Не удалось открыть файл users.txt";
		exit();
	}
	
	$user;
	foreach($usersRead as $line)
	{
		$userData = explode(' ', $line);
		$Users[] = Array("login" => $userData[0]);
	}
	
	$isEmpty = true; //Свободен ли логин?
	foreach($Users as $sUser)
	{
		if(strcmp($sUser["login"], $_POST["login"]) === 0)
		{
			$isEmpty = false;
			$incorrectData = true;
		}
	}
	if($isEmpty == false)
	{
		echo "<font color='red'>Пользователь с таким логином уже существует</font><br/><a href='./registration.php'>Попробывать еще раз</a>";
		exit();
	}
	//Проверка соответствия подтверждающего пароля
	if(strcmp($_POST["password"], $_POST[password_confirmation]) != 0)
	{
		echo "<font color='red'>Пароли не совпадают!</font><br/>";
		echo "<b><a href='./registration.php'>Попробывать еще раз</a><b><br/>";
		exit();
	}
	
	if($incorrectData)
	{
		echo "<b><a href='./registration.php'>Попробывать еще раз</a><b><br/>";
		exit();
	}
	
	//Проверяем, все ли впорядке с файлом users.txt
	
	$fd = fopen("users.txt", "r");
	if($fd == false)
	{
		echo "<font color='red'><b>Критическая ошибка!</b><br>Файл users.txt отсутствует!</font>";
		echo "Файл users.txt не открылся<br/>";
		exit();
	}
	
	$line = "\r\n".$_POST["login"]." ".$_POST["password"];
	if(isset($_POST["NickName"]) && !empty($_POST["NickName"]))
		$line .= " ".$_POST["NickName"];
	else
		$line .= " None";
	//Проверяем, все ли впорядке с файлом newID.txt
	$fd = fopen("newID.txt", "r");
	if($fd == false)
	{
		echo "<font color='red'><b>Критическая ошибка!</b><br>Файл newID.txt отсутствует!</font>";
		echo "Файл newID.txt не открылся<br/>";
		exit();
	}
	$id = file_get_contents("newID.txt");
	$line .= " ".$id;
	file_put_contents("users.txt", $line, FILE_APPEND);
	$id++;
	file_put_contents("newID.txt", $id);
?>
Вы успешно зарегистрированны<br/>
<a href="index.php"><b>Войти</b></a>