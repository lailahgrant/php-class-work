<?php

require 'customers_conn.php';

if(!isset($_POST["tb_surname"])) { 
 echo "<form method='POST' action='customers_adddata.php'>"; 
 echo "<table><tr>"; 
 echo "<td>First Name</td>"; 
 echo "<td><input type='text' name='tb_firstname' size='25'></td>"; 
 echo "</tr><tr>"; 
 echo "<td>Surname</td>"; 
 echo "<td><input type='text' name='tb_surname' size='25'></td>"; 
 echo "</tr><tr>"; 
 echo "<td>Title</td>"; 
 echo "<td><input type='text' name='tb_title' size='25'></td>"; 
 echo "</tr><tr>"; 
 echo "<td>Address</td>"; 
 echo "<td><textarea rows='2' name='ta_address' cols='20'></textarea></td>"; 
 echo "</tr><tr>"; 
 echo "<td>Phone</td>"; 
 echo "<td><input type='text' name='tb_phone' size='25'></td>"; 
 echo "</tr><tr>"; 
 echo "<td>Email</td>"; 
 echo "<td><input type='text' name='tb_email' size='25'></td>"; 
 echo "</tr></table>"; 
 echo "<br>"; 
 echo "<input type='submit' value='Create Customer' name='button'>"; 
 echo "</form>";
}else 
{ # a surname was specified so create a new record and retrieve the data from the form 
$title = $_POST["tb_title"]; 
$firstname = $_POST["tb_firstname"]; 
$lastname = $_POST["tb_surname"]; 
$address = $_POST["ta_address"]; 
$phone = $_POST["tb_phone"]; 
$email = $_POST["tb_email"];
 # Now connect to the database 
try{ 
# a DB Handler to manage the database connection 
	if($dbh == null) 
	$dbh = new PDO($dsn, $user, $pass); 
# Now construct the query to create the new record with named placeholders 
$sql = "insert into customers "; 
$sql .= "(firstname, last_name, title, address, phone, email) "; 
$sql .= "values(:firstname,:lastname,:title,:address,:phone,:email)"; 
#echo $sql; 
# STH means "Statement Handle" 
$STH = $dbh->prepare($sql); 
$result = $STH->execute(array(':firstname'=>$firstname,':lastname'=>$lastname, ':title'=>$title,':address'=>$address,':phone'=>$phone,':email'=>$email)); 
$m = "Done! Inserted $result new row. To return to the "; 
$m .= "home screen click <a href='customers_adddata.php'>here.</a>"; 
#show_message($m);
echo "$m";

 # close the connection  
$dbh = null; 
} catch (PDOException $e){ 
	echo '<b>PDOException: </b>',$e->getMessage(); 
	die(); 
}
}
?>