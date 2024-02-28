<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
<?php
    session_start();

    if(isset($_POST['login']))
        {
        // define variables and set to empty values
        $password="";
        $passwordErr="";


        $password = test_input($_POST["password"]);



        if ($password != "12345" ) //Update with your password
        {
        $passwordErr = "Invalid Password";
        }

        if (empty($passwordErr))
        {
        $_SESSION["Login"] = true;
        }
        else
        {
        $_SESSION["Login"] = false;
        }
        }
?>
<?php
    if (!$_SESSION["Login"])
    {
?>
        <h2>Please Log in</h2>
        <form method="post" action="">  
        Password: <input type="password" name="password" value="<?php echo $password;?>">
        <span class="error"><?php echo $passwordErr;?></span>
        <br><br>
        
        <input type="submit" name="login" value="login">  
        </form>

        <?php
        
    }
    else
    {
        $compcon =  mysqli_connect("sql309.infinityfree.com","if0_36062971","DDAY2024","if0_36062971_dday"); //The format is mysqli_connect("hostname","username","password","database");
        if (!$compcon) {
            echo mysqli_connect_error();
        }
        $first_name = $_GET['first'];
        $last_name = $_GET['last'];
        $sql = "select checked_in from attendees where first = '$first_name' and last = '$last_name'"; //The table has 3 coloumns: first, last and checked_in
        $result = mysqli_query($compcon, $sql);
        $paying = mysqli_fetch_array($result);
        echo "First Name: ".$first_name;
        echo "<br>";
        echo "Last Name: ".$last_name;
        if ($paying['checked_in'] == 0 && $paying['checked_in']!= null) //Update based on the convention you use for the table
        {
        {
?>
    <div class = "result">
            <p>  You have paid, you can definetly take a mug! Enjoy the day, and be smart!! </p>
    </div>
<?php
        $update = "update attendees set checked_in = 1 where first = '$first_name' and last = '$last_name'";
        mysqli_query($compcon, $update);
    }
    elseif ($paying['checked_in'] && $paying['checked_in']!= null)
    {
?>
    <div class = "result">
            <p>  Sorry, you have already taken the mug. Please check with one of the society members.</p>
    </div>
<?php
    }
    else
    {
?>
    <div class = "result">
            <p>  Sorry, we haven't received your payment. Please check with one of the society members.</p>
    </div>
<?php
    }
}
function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
    
    



