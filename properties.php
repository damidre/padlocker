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

mysql_select_db($database_padlocker, $padlocker);
$query_Recordset1 = "SELECT * FROM property";
$Recordset1 = mysql_query($query_Recordset1, $padlocker) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
include("header.php");

?>


<?



$print = mysql_query("SELECT * FROM property") or
	die (mysql_error());
	
while($row = mysql_fetch_array($result)){
	echo $row['id']." " . $row['ref']. " " . $row['address'] . " " .$row['city']
		. " " .$row['state'] . " " .$row['zipcode'];
	
}

?>
<table border="1">
  <tr>
    <td>id</td>
    <td>ref</td>
    <td>address</td>
    <td>city</td>
    <td>state</td>
    <td>zipcode</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['ref']; ?></td>
      <td><?php echo $row_Recordset1['address']; ?></td>
      <td><?php echo $row_Recordset1['city']; ?></td>
      <td><?php echo $row_Recordset1['state']; ?></td>
      <td><?php echo $row_Recordset1['zipcode']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?php
mysql_free_result($Recordset1);
?>
