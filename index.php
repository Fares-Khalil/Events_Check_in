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
    if ($_SESSION["Login"]!= true)
    {
?>
        <h2>Please Log in</h2>
        <form method="post" action="login.php">  
        Password: <input type="password" name="password" value="<?php echo $password;?>">
        <span class="error"><?php echo $passwordErr;?></span>
        <br><br>
        
        <input type="submit">  
        </form>

        <?php
        // define variables and set to empty values
        $password="";
        $passwordErr="";


        $password = test_input($_POST["password"]);



        if ($password != "12345" ) 
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
    else
    {
        $compcon =  mysqli_connect("sql305.epizy.com","epiz_31595463","4qtQ0FvxKAyhR","epiz_31595463_dday");
        if (!$compcon) {
            echo mysqli_connect_error();
        }
        $first_name = $_GET['first'];
        $last_name = $_GET['last'];
        $sql = "select paid from attendees where first = '$first_name' and last = '$last_name'";
        $result = mysqli_query($compcon, $sql);
        $paying = mysqli_fetch_array($result);

        echo "First Name: ".$first_name;
        echo "<br>";
        echo "Last Name: ".$last_name;
        if ($paying['paid'] && $paying['paid']!= null)
        {
?>
    <div class = "result">
            <p>  You have paid, you can definetly take a mug! Enjoy the day, and be smart!! </p>
    </div>
<?php
        $update = "update attendees set paid = 0 where first = '$first_name' and last = '$last_name'";
        mysqli_query($compcon, $update);
    }
    elseif (!$paying['paid'] && $paying['paid']!= null)
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
    
    



