<?php 

include("connect.php");
session_start();
if(!isset($_SESSION["user_login"])){
	$username = "";
	
}
else
{
	$username = $_SESSION["user_login"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Padlocker</title>
</head>

<body>
	<div class = "headerMenu">
    <div id ="wrapper">
    	<div class = "logo">
        	<img src = "padlock-xxl.png" />
            </div> <br />
        <div class = "search_box">
        <form action = "search.php" method = "GET" id = "search">
        	<input type = "text" name="question" placeholder = "Search..." />
        </form>
        </div>
        </div>
        </div>
        
<?php
        if(!$username){
        echo'<div id="menu">
        	<a href = "home.php" /> Home </a>
            <a href = "index.php" /> Sign Up </a>
            <a href = "index.php" /> Sign In </a>
            </div>';
		}
		else{
			echo'<div id="fnav">
				<a href="profile.php" /> Profile </a>
				<a href="account_settings.php" /> Account Settings </a>
				<a href="logout.php" /> Logout </a>
				</div>';
				
		}
		?>
         