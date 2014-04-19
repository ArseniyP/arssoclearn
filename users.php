<?php

	function getUsers()
	{
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
		return $Users;
	}
	
	//Выборка одного пользователя из массива $Users по ключу
	function getUser($key, $value)
	{
		if(!isset($Users))
			$Users = getUsers();
		$User;
		foreach($Users as $sUser)
		{
			if(strcmp($sUser[$key], $value) === 0)
			{
				$User = $sUser;
				return $User;
			}
		}
		return false;
	}
	
	function getUserByID($id)
	{
		if(!isset($Users))
			$Users = getUsers();
		$User;
		foreach($Users as $sUser)
		{
			if(strcmp($sUser["id"], $id) === 0)
			{
				$User = $sUser;
				return $User;
			}
		}
		return false;
	}
?>