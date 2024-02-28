<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
 
<?php
// define variables and set to empty values
$email=$password="";
$emailErr=$passwordErr="";

$email = test_input($_POST["email"]);
$password = test_input($_POST["password"]);


if ($email!="farisashraf16@gmail.com")
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
  {
    $emailErr = "Invalid email format";
  }
  else
  {
    $emailErr = "Invalid Email";
  }
}

if ($password != "Faris2642002" ) 
{
  $passwordErr = "Invalid Password";
}

if (empty($emailErr) and empty($passwordErr))
{
  require('index.html');
}
else
{
  require('index.php');
}

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>






