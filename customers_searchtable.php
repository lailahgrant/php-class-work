<?php

require 'customers_conn.php';

# Check whether the searchtype radio button has been set  If not set, display the search form. 

if(!isset($_POST["searchtype"])){
	echo "<form method='POST' action='customers_searchtable.php'>";
	echo "Search for firstname<br>";
	echo "<input type='search' name='searchtext' placeholder='search' autosave='saved-searches'>";
	echo "<br><br>";
	echo "Full search";
	echo "<input type='radio' name='searchtype' checked value='FULL'>";
	echo "Partial  search";
	echo "<input type='radio' name='searchtype' checked value='PARTIAL'>";
	echo "<br><br>";
	echo "<input type='submit' value='search' name='search'>";
	echo "</form>";
}else{
	 # Searchtype was set, so retrieve form data and do the search
	$searchtext=$_POST['searchtext'];
	$searchtype=$_POST['searchtype'];
	$searchtext_san =sanitize_form_text($searchtext); #prevents SQLinjection

	#connect db
	try{
	if($dbh==null)
		$dbh=new pdo($dsn,$user,$pass);
	$sql='select first_name, last_name from '.$tbname. 'where first_name';

	if($searchtype=='FULL'){
		$sql .= " = :searchtext_san";
	$sth=$dbh->prepare($sql);
	$sth->execute(array(':searchtext_san' => $searchtext_san));	
	}
	if($Searchtype=='PARTIAL'){
		$sql .="LIKE :searchtext_san";
		$sth=$dbh->prepare($sql);
		$sth->execute(array(':searchtext_san' => '%'.$searchtext_san.'%'));
	}
	$sth=setFetchMode(PDO::FETCH_ASSOC);
	$total=$sth->rowCount();
	if($total==0){
		echo "Sorry, no matches found";
	}
	if($total>0){
		while($row=$sth->fetch()){
			echo "{$row['first_name']} {$row['last_name']}<br>";
		}
	}
	$dbh=null;
}catch (PDOException $e){ echo '<b>PDOException: </b>',$e->getMessage(); die(); }

}
?>
