<?php

require 'customers_conn.php';

try{
	if($dbh==null)
		$dbh=new pdo($dsn,$user,$pass);
	$sql='select first_name, last_name, phone from '.$tbname;
	$sth=$dbh->query($sql);
	$sth->setFetchMode(PDO::FETCH_OBJ);

	echo "<table  border='1'><tr>";
	echo "<td colspan='2'>These are the customers</td></tr>";

	while($row = $sth->fetch()){
		echo "<tr><td  title={$row->phone}>{$row->first_name}</td>"; 
		echo "<td>{$row->last_name}</td></tr>";
	}
	echo "</table>"; 
	+
	# close the connection  
	$dbh = null;
} catch (PDOException $e){ 
	echo '<b>PDOException: </b>',$e->getMessage(); die(); }


?>