<?php
	//Удаление кук
	setcookie("id");
	setcookie("password");
	setcookie("timeCreate");
	
	echo "Время истекло<br><br>";
	echo "<a href='./index.php'>Войти еще раз</a>";
?>