<?php
include("header.php"); ?>

<?
if($username){
	
}

else{
	die ("You must be logged in to view this page");
}
?>

<?php

	//pasword variables
	$old_password = @$_POST['oldpassword'];
	$new_password = @$_POST['newpassword'];
	$new_password2 = @$_POST['newpassword2'];

	$send = @$_POST['send'];
	
	if($send){
		$password_query = mysql_query("SELECT * FROM user WHERE uname = '$username'");
		while ($row = mysql_fetch_assoc($password_query)){
			$db_password = $row['pword'];
			
			$old_password_md5 = md5($old_password);
			
			if($old_password_md5 == $db_password){
				//continue
				//advanced feature - password encryption
				
			if($new_password == $new_password2){
				$new_password_md5 = md5($new_password);
				$password_update = ("UPDATE user SET pword = '$new_password_md5' WHERE uname='$username'");
				echo "Password changed successfully.";
			}
				else{
					echo "New password must match both fields";
					}
			
			}
			else{
				echo "The old password is incorrect.";
			}
		}
	}
	else{
		echo "No input yet.";
	}
	

?>


<h2>Edit Account Settings: </h2>
<hr>
<p><b>Change Your Password</b></p><br>
<form method = "POST" >
Old Password: <input type ="text" name = "oldpassword"/><br/>
New Password: <input type ="text" name = "newpassword" /><br/>
Repeat New Password: <input type ="text" name = "newpassword2"/><br>
<input type = "submit" name = "send" value ="Change"/>
</form>



