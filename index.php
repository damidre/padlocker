<?php include ("header.php"); ?>
<?php 
$reg = @$_POST['reg'];

$fn = ""; //first name
$ln = ""; //last name
$un = ""; //username
$em = ""; //email
$em2= ""; //verified email
$pswd = ""; //password
$pswd2 = ""; //verified password
$d = ""; //sign up date

$u_check = ""; //check if username exists

//registration form - assign variables equal to field names
$fn = strip_tags(@$_POST['fname']); //@ prevent undeclared variable errors
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['uname']);
$em = strip_tags(@$_POST['email']);
$em2 = strip_tags(@$_POST['email2']);
$pswd = strip_tags(@$_POST['pw']);
$pswd2 = strip_tags(@$_POST['pw2']);
$d = date("Y-m-d"); //equals to date function, gets date from server

if($reg){
	if($em==$em2){
		//Check existence of user
		$u_check = mysql_query("SELECT uname FROM user WHERE uname = '$un' "); 
		//Count the number of rows where the username = $un
		$check = mysql_num_rows($u_check);
		if($check == 0){
			//Check that all fields are filled
			if($fn && $ln && $un && $em && $em2 && $pswd && $pswd2){
				//check matching passwords
				if($pswd==$pswd2){
					//check the length of the username
					if(strlen($un)>25||strlen($fn)>25||strlen($ln)>25){
						echo "The max length is 25 characters";
					}
					else
					{
						//check the length of password
						if(strlen($pswd)>30||strlen($pswd)<5){
							echo "Password must be more than 5 and less than 30 characters";
						}
					else
					{
						//encrypt password using md before sending to sql
						$pswd = md5($pswd);
						$pswd2 = md5($pswd2);
						$query = mysql_query("INSERT INTO user VALUES ('','$fn','$ln','$em','$un','$pswd','$d','0')");
						die("<h2> Welcome to Padlock </h2> Login to your account to begin!");
					}
					}
				}
				else {
				echo "Your passwords don't match!";
				}
			}
			else{
				echo "Please fill in all of the fields";
			}
		}
		else{
			echo "Username already taken!";
		}
	}
	else{
		echo "Your e-mail doesn't match!";
	}
}

//Login code
if(isset($_POST["user_login"]) && isset($_POST["password_login"])){
	$user_login = preg_replace('#[^A-Za-z0-9]#i','',$_POST["user_login"]);
	//filter everything but numbers and letters
	$password_login = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password_login"]);
	
	$password_login_md5 = md5($password_login);
	//password encryption
	
$sql = mysql_query("SELECT id FROM user WHERE uname= '$user_login' AND pword= '$password_login_md5' LIMIT 1");
//Select a row where username and password match one in the database

//Check for their existence
	$userCount = mysql_num_rows($sql);
	if($userCount == 1) {
		while($row = mysql_fetch_array($sql)){
			$id = $row["id"];
		}
		$_SESSION["user_login"] = $user_login;
		header("location: home.php");
		exit();
	}
	else{
		echo "That information is incorrect";
		exit();
	}
}
	
?>


<div style = "width: 800px; margin: 0px auto 0px auto;">
<table>
	<tr>
    	<td width = "60%" valign="top">
           	<h2> Padlocker: Snag a Pad </h2>
            <h2> Already a Member? Sign in!</h2>
            <form action = "index.php" method = "POST">
            	<input type = "text" name="user_login" size="25"
               		placeholder = "Username" /><br /><br />
            	<input type = "password" name="password_login" size="25"
               		placeholder = "Password" /><br /><br />
            <input type = "submit" name ="login" Value = "Login!" />
            
            
            </form>
            
        </td>
        <td width="20%" valign="top">
        <h2> Sign Up Below! </h2>
        	<form action = "index.php" method = "POST">
            <input type = "text" name="fname" size="25"
            	placeholder = "First Name" /><br /><br />
            <input type = "text" name="lname" size="25"
               	placeholder = "Last Name" /><br /><br />
            <input type = "text" name="email" size="25"
               	placeholder = "E-mail" /><br /><br />
            <input type = "text" name="email2" size="25"
              	placeholder = "Re-enter Email" /><br /><br/>
            <input type = "text" name="uname" size="25"
               	placeholder = "Username" /><br /><br />
            <input type = "password" name="pw" size="25"
               	placeholder = "Password" /><br /><br />
            <input type = "password" name="pw2" size="25"
               	placeholder = "Re-enter Password" /><br /><br />
            <input type = "submit" name ="reg" Value = "Register" />
			</form>
         </td>
    </tr>
</table>

</body>

</html>
