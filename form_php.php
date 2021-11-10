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
<h1>Thank You</h1>
<p>Thank you for registering. Here is the information you  submitted</p>

<dl>
	<dt>First name</dt><dd><?php echo $_POST['firstName'] ?></dd>
	<dt>Last name</dt><dd><?php echo $_POST['lastName'] ?></dd>
	<dt>Password</dt><dd><?php echo $_POST['password1'] ?></dd>
	<dt>Retyped password</dt><dd><?php echo $_POST['password2'] ?></dd>
	<dt>Gender</dt><dd><?php if(isset($_POST['gender'])) echo $_POST['gender'] ?></dd>
	<!-- or use.. <dt>Gender</dt><dd><?php/*  echo $_POST['gender'] */?></dd>-->
	<dt>Favorite Widget</dt><dd><?php echo $_POST['favoriteWidget'] ?></dd>
	<dt>Favorite Widget</dt><dd><?php echo $_POST['favoriteWidget'] ?></dd>
	<dt>Do you want to receive our newsletter ?</dt><dd><?php echo $_POST['newsletter'] ?></dd>
	<dt>Comments</dt><dd><?php echo $_POST['comments'] ?></dd>
</dl>

</div>

<script src="js/bootstrap.js"></script>
</body>
</html>