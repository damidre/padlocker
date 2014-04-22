<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_padlocker = "localhost";
$database_padlocker = "padlocker";
$username_padlocker = "root";
$password_padlocker = "password";
$padlocker = mysql_pconnect($hostname_padlocker, $username_padlocker, $password_padlocker) or trigger_error(mysql_error(),E_USER_ERROR); 
?>