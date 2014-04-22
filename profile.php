<?php require_once('Connections/padlocker.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO property (address, city, `state`, zipcode, bedrooms) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zipcode'], "int"),
                       GetSQLValueString($_POST['bedroom'], "int"));

  mysql_select_db($database_padlocker, $padlocker);
  $Result1 = mysql_query($insertSQL, $padlocker) or die(mysql_error());

  $insertGoTo = "properties.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_padlocker, $padlocker);
$query_Recordset1 = "SELECT * FROM property";
$Recordset1 = mysql_query($query_Recordset1, $padlocker) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php include("header.php"); ?>

<?php
if(isset($_GET['u'])){
	$username = mysql_real_escape_string($_GET['u']);
	if(ctype_alnum($username)){
		//check that username is alphanumeric<br />

		$check = mysql_query("SELECT uname, fname FROM user WHERE uname = '$username'");
		//check that user exists
		
		if(mysql_num_rows($check)==1){
			$get = mysql_fetch_assoc($check);
			$username = $get['uname'];
			$firstname = $get['fname'];
		}
		else{
			echo "<h2> User doesn't exist </h2>";
			exit();
		}
	}
}
?>

<h2> Username: <?php echo  "$username"; ?> </h2>

<div class= "postForm">
	<h3> List a Property: </h3>
	<form action="<?php echo $editFormAction; ?>" name="form" method = "POST">
    <input type = "text" name="address" size="25"
        placeholder = "Address" /><br /><br />
<input type = "text" name="city" size="25"
        placeholder = "City" /><br /><br />
<input type = "text" name="state" size="25"
        placeholder = "State" /><br /><br />
<input type = "number" name="zipcode" size="25"
        placeholder = "Zipcode" /><br /><br />
<input type = "number" name="bedroom" size="25"
    	placeholder = "Number of Bedrooms" /><br /><br />
    <input type = "submit" name="list" value = "Post"/><br /><br />
    <input type="hidden" name="MM_insert" value="form" />
    </form>
</div>

<div class = "userProperties">
<h3> My Listed Properties: </h3>
<?

$myid = mysql_query(SELECT 


?>

</div>
<br />

<div id ="listed">
<a href = "properties.php"> View All Listed Properites </a>
</div>
<?php
mysql_free_result($Recordset1);
?>
