<?php 
	//�������� �� ������ ���������
	
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
		//���� ���� � ����� NAME ����, �� ��� �� ����������������, � ����������� ����� � �����-�� ������!
		setcookie("id", $user["id"], time()+60);//���� ����� 60 ���
		setcookie("password", $user[password], time()+60);
		setcookie("timeCreate", time(), time()+100); //����� 1 ��� 40 ��� 
		header("Location: ./profile.php?id=$user[id]");
	}
	
	if(!$correctLogin)
		echo "�� ������ �����<br/>";
	if(!$correctPassword)
		echo "�� ������ ������<br/>";
	
	if($incorrectData)
	{
		echo "<a href='./index.php'>��������� ����</a>";
		exit();
	}
	
	header("Location: ./profile.php?id=$user[id]");
?>