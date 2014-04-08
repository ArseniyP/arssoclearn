<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
 <!-- Для корректного использования тега font-->

<h3 align="center">Страница регистрации</h3>
<form method='post' action='./regResult.php'>
	<table>
		<tr>
			<td>Логин (Должен быть уникальным)*</td>
			<td><input type='text' name='login'></td>
		</tr>
		<tr>
			<td>Пароль*</td>
			<td><input type='password' name='password'></td>
		</tr>
		<tr>
			<td>Подтверждение пароля*</td>
			<td><input type='password' name='password_confirmation'></td>
		</tr>
		<tr>
			<td>Ник(если не указать - совпадает с логином)</td>
			<td><input type='text' name='NickName'></td>
		</tr>
		<tr>
			<td><input type='submit' value="Зарегистрировать"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<font color="red">* - поля обязательны для заполнения</font>
<a 