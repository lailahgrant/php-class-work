<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN”  “http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
<html  xmlns=”http://www.w3.org/1999/xhtml” xml:lang=”en” lang=”en”>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Lailah</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<style type="text/css">
		.error
		{
			background: #d33;
			color: white;
		}
	</style>

</head>
<body>

<div class="container">

<?php

if(isset($_POST['submitButton']))
{
processForm();
}
else
{
displayForm(array());
}

function validateField($fieldName, $missingFields)
{
if(in_array($fieldName, $missingFields))
{
echo 'class="error"';
}
}

function setValue($fieldName)
{
if(isset($_POST[$fieldName]))
{
echo $_POST[$fieldName];
}
}

function setChecked($fieldName,$fieldValue)
{
if(isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue)
{
echo 'checked="checked"';
}
}

function setSelected($fieldName, $fieldValue)
{
if(isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue)
{
echo 'selected="selected"';
} 
}

function processForm()
{
$requiredFields=array("firstName","lastName","password1","password2","gender");
$missingFields=array();

foreach($requiredFields as $requiredField)
{
if(!isset($_POST[$requiredField]) or !$_POST[$requiredField])
{
$missingFields[] = $requiredField;
}
}

if($missingFields)
{
displayForm($missingFields);
}
else
{
displayThanks();
}
}
function displayForm($missingFields)
{
?>

<h1>Membership Form</h1>

<?php if($missingFields) { ?>

<p class="error">There were some problems with the form you submitted. Please complete the fields highlighted below and click the Send details to resend the form.</p>

<?php } else { ?>
	<p>Thanks for choosing to join the Widget Club. To register, please fill in your details and click the send details. Fields markes with an asterisk (*) are required</p>

<?php } ?>

<form action="form2_php.php" method="post">

<label for="firstName"<?php validateField("firstName", $missingFields) ?> > First name *</label>
	<input type="text" name="firstName" value="<?php setValue("firstName") ?>">


<label for="lastName" <?php validateField("lastName",$missingFields) ?> >Last name *</label>
<input type="text" name="lastName" value="<?php setValue("lastName") ?>">

<label for=""></label>

</form>

</div>
<script src="js/bootstrap.js"></script>
</body>
</html>