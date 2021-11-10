<?php

require 'customers_conn.php';

try{
# a DB Handler to manage the database connection 
	if($dbh == null) 
		$dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e)
{ echo '<b>PDOException: </b>',$e->getMessage(); die(); 
} 
# Now check the action parameter from the URL to see what we need to do 
$action = empty($_GET['action']) ? "" : $_GET['action']; 
if ($action == "") {
 # No action specified so show the home page 
 try{ 
 	$sql = "select id, first_name, last_name from ".$tbname; 
 # sth means "Statement Handle" 
 $sth = $dbh->query($sql); 
 # setting the fetch mode 
  #$sth->setFetchMode(); 
   echo "<form method='post' action='customers_edit.php?action=show_record'>";
    echo "<table border=1>"; 
    # Create the table top row 
    echo "<tr><th>Name</th><th>Select</th></tr>"; 
    while ($row = $sth -> fetch(PDO::FETCH_ASSOC)) { 
    echo "<tr><td>{$row["first_name"]} {$row["last_name"]}</td>";
     echo "<td>"; 
     echo "<input type='radio' value='{$row["id"]}' name='id2edit'>"; 
     echo "</td></tr>"; 
 } 
     echo "</table>"; 
     echo "<br>"; 
     echo "<input type='submit' value='Edit selected customer' name='button'>"; 
     echo "</form>"; 
     # close the connection 
          $dbh = null; 
 } catch (PDOException $e){ echo '<b>PDOException: </b>',$e->getMessage(); die(); }
}else if ($action == "show_record") {  
# Display the customer record form. Populate it with the details of 
# the customer whose id is passed in the id2edit radio button.  Get the contents of the id2edit form variable 
$id2edit = empty($_POST["id2edit"]) ? "" : $_POST["id2edit"]; 
if ($id2edit == "") { $m = "No customer selected! To return to the home "; 
$m .= "screen click <a href='editcust.php'>here.</a>"; show_message($m); 
} else { 
try{ 
# Now get the customer's details as we'll need them to populate the form 
$sql = "select * from customers where id = :id2edit"; 
# sth means "Statement Handle" 
$sth = $DBH->prepare($sql); $sth->execute(array(':id2edit' => $id2edit)); 
# setting the fetch mode, don't need a while loop as there's only 1 row 
$row = $sth->fetch(PDO::FETCH_ASSOC);
echo "<form method='POST' action='customers_edit.php?action=store_record'>"; 
echo "<table>"; 
echo "<tr><td>First Name</td>"; 
echo "<td><input value='{$row["first_name"]}' type='text' "; 
echo "name='tb_firstname' size='25'></td>"; 
echo "</tr>"; 
echo "<tr><td>Surname</td>"; 
echo "<td><input value='{$row["last_name"]}' type='text' "; 
echo "name='tb_surname' size='25'></td>"; 
echo "</tr>"; 
echo "<tr><td>Title</td>"; 
echo "<td><input value='{$row["title"]}' type='text' "; 
echo "name='tb_title' size='25'></td>"; 
echo "</tr>"; 
echo "<tr><td>Address</td>"; 
echo "<td><textarea rows='2' name='ta_address' cols='20'>{$row["address"]}</textarea></td>"; 
echo "</tr>"; 
echo "<tr><td>Phone</td>";
 echo "<td><input value='{$row["phone"]}' type='text' "; 
echo "name='tb_phone' size='25'></td>"; 
echo "</tr>"; 
echo "<tr><td>Email</td>"; 
echo "<td><input value='{$row["email"]}' type='text' "; 
echo "name='tb_email' size='25'></td>"; 
echo "</tr>"; 
echo "</table>"; 
echo "<br>"; 
echo "<input type='submit' value='Save' name='button'>"; 
# Pass the id along to the next routine in a hidden field 
echo "<input type='hidden' name='id2edit' value='{$id2edit}'>"; 
echo "</form>"; 
# close the connection  
$DBH = null; 
} catch (PDOException $e){
 echo '<b>PDOException: </b>',$e->getMessage(); die(); 
}
} 
}else if ($action == "store_record") { 
# Retrieve the data from the form and update customer record 
	$id2edit = $_POST["id2edit"]; 
# Get the id from the hidden field 
$firstname = $_POST["tb_firstname"]; 
$surname = $_POST["tb_surname"]; 
$title = $_POST["tb_title"]; 
$address = $_POST["ta_address"]; 
$phone = $_POST["tb_phone"]; 
$email = $_POST["tb_email"];
# Now we can update the customer's data. 
try{ 
	$sql = "update customers set first_name=?, last_name=?, title=?, address=?, phone=?, email=? where id = $id2edit"; 
#echo $sql; 
# sth means "Statement Handle" 
$sth = $DBH->prepare($sql); 
$result = $sth->execute(array($firstname, $surname, $title, $address, $phone, $email));
$m = "Thank you! Edit of $result row complete. To return to the home "; $m .= "screen click <a href='editcust.php'>here.</a>"; show_message($m); 
# close the connection  
$DBH = null;
} catch (PDOException $e){ echo '<b>PDOException: </b>',$e->getMessage(); die(); 
} }

?>