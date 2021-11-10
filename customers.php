<?php

require 'customers_conn.php';

echo "<html><body>";

$query = "select first_name, last_name from " .$tbname;
# MySQL with PDO_MYSQL  
$dbh = new PDO($dsn, $user, $pass);
# using the shortcut ->query() method here since there are no variable  # values in the select statement.  
$STH = $dbh->query($query);
# setting the fetch mode (array indexed by column name)  
$STH->setFetchMode(PDO::FETCH_ASSOC);   
 while($row = $STH->fetch()) 
 	{      echo $row['first_name'] . " " . $row['last_name'] . "<br />";  }

 ################## Do it again ########################## 
 $STH = $dbh->query($query);
# setting fetch mode (object with names by column name) 
 $STH->setFetchMode(PDO::FETCH_OBJ);
# showing the results 
 while($row = $STH->fetch()) { echo $row->first_name . " " . $row->last_name . "<br />"; } 
 echo "</body></html>";
?>