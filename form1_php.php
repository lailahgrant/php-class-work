<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN”  “http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
<html  xmlns=”http://www.w3.org/1999/xhtml” xml:lang=”en” lang=”en”>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Lailah</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h1>Thank you</h1>
<p>Thank you for registering. Here is your information</p>

<?php

$favoriteWidgets="";
$newsletters="";

if(isset($_POST["favoriteWidgets"]))
{
foreach($_POST["favoriteWidgets"] as $widget)
{
$favoriteWidgets .=$widget . ",";
}
}

if(isset($_POST["newsletter"]))
{
foreach($_POST["newsletter"] as $newsletter)
{

$favoriteWidgets=preg_replace("/, $/", "", $favoriteWidgets);
$newsletters=preg_replace("/, $/", "", $newsletters);
}
}
?>

<dl>
	<dt>First name</dt><dd><?php echo $_POST['firstName']  ?></dd>
	<dt>Last name</dt><dd><?php echo $_POST['lastName']  ?></dd>	<dt>Password</dt><dd><?php echo $_POST['password1']  ?></dd>
	<dt>Retyped password</dt><dd><?php echo $_POST['password2']  ?></dd>
	<dt>Gender</dt><dd><?php echo $_POST['gender']  ?></dd>
	<dt>Favourite Widgets</dt><dd><?php echo $favoriteWidgets ?></dd>
	<dt>Do you want to receive our newsletter?</dt><dd><?php echo $newsletters ?></dd>
	<dt>Comments</dt><dd><?php echo $_POST['comments'] ?></dd>
</dl>

<script src="js/bootstrap.js"></script>
</body>
</html>