<?php

require 'customers_conn.php';

try{
	if($dbh==null)
		$dbh=new pdo($dsn,$user,$pass);
	$query='select * from '.$tbname;
	$sth=$dbh->query($query);

	$total=$sth->rowCount();

	if($total == 0){
		echo "Sorry, no matches found !!";
	}else{
		echo "total number of customers is ".$total;
	}

	#close connection
	$dbh=null;
}catch(PDOException $e){
	echo '<b>PDOException: </b>',$e->getMessage(); die();

}

?>