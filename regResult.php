<?php
	$incorrectData = false;
	if(isset($_POST["login"]) && empty($_POST["login"]))
	{
		echo "<font color='red'>�� ������ �����</font><br/>";
		$incorrectData = true;
	}
	
	if(isset($_POST["password"]) && empty($_POST["password"]))
	{
		echo "<font color='red'>�� ������ ������</font><br/>";
		$incorrectData = true;
	}
	
	if(isset($_POST["password_confirmation"]) && empty($_POST["password_confirmation"]))
	{
		echo "<font color='red'>������ ������������� �� ������</font><br/>";
		$incorrectData = true;
	}
	
	if($incorrectData)
	{
		echo "<b><a href='./registration.php'>����������� ��� ���</a><b><br/>";
		exit();
	}
	
	//��� �������� ������������ ������
	$usersRead = file("./users.txt", FILE_IGNORE_NEW_LINES);
	if($usersRead == false)
	{
		echo "�� ������� ������� ���� users.txt";
		exit();
	}
	
	$user;
	foreach($usersRead as $line)
	{
		$userData = explode(' ', $line);
		$Users[] = Array("login" => $userData[0]);
	}
	
	$isEmpty = true; //�������� �� �����?
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
		echo "<font color='red'>������������ � ����� ������� ��� ����������</font><br/><a href='./registration.php'>����������� ��� ���</a>";
		exit();
	}
	//�������� ������������ ��������������� ������
	if(strcmp($_POST["password"], $_POST[password_confirmation]) != 0)
	{
		echo "<font color='red'>������ �� ���������!</font><br/>";
		echo "<b><a href='./registration.php'>����������� ��� ���</a><b><br/>";
		exit();
	}
	
	if($incorrectData)
	{
		echo "<b><a href='./registration.php'>����������� ��� ���</a><b><br/>";
		exit();
	}
	
	//���������, ��� �� �������� � ������ users.txt
	
	$fd = fopen("users.txt", "r");
	if($fd == false)
	{
		echo "<font color='red'><b>����������� ������!</b><br>���� users.txt �����������!</font>";
		echo "���� users.txt �� ��������<br/>";
		exit();
	}
	
	$line = "\r\n".$_POST["login"]." ".$_POST["password"];
	if(isset($_POST["NickName"]) && !empty($_POST["NickName"]))
		$line .= " ".$_POST["NickName"];
	else
		$line .= " None";
	//���������, ��� �� �������� � ������ newID.txt
	$fd = fopen("newID.txt", "r");
	if($fd == false)
	{
		echo "<font color='red'><b>����������� ������!</b><br>���� newID.txt �����������!</font>";
		echo "���� newID.txt �� ��������<br/>";
		exit();
	}
	$id = file_get_contents("newID.txt");
	$line .= " ".$id;
	file_put_contents("users.txt", $line, FILE_APPEND);
	$id++;
	file_put_contents("newID.txt", $id);
?>
�� ������� �����������������<br/>
<a href="index.php"><b>�����</b></a>