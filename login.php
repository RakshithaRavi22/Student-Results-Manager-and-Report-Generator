<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <title>Index Page</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
    <div class="title">
        <span>Student Result Management</span>
    </div>

    <div class="main">
        <div class="login">
            <form action="" method="post" name="login">
                <fieldset>
                    <p>Admin Login</p>
                    <input type="text" name="userid" placeholder="User Name" autocomplete="off">
                    <input type="password" name="password" placeholder="Password" autocomplete="off">
                    <input type="submit" value="Login">
                </fieldset>
            </form>    
        </div>
        
        <div class="search">
            <form action="./student.php" method="get">
                <fieldset>
                    <!-- <legend class="heading">For Students</legend> -->
                    <p>Student Login</p>

                    <?php
                        include('init.php');

                        $class_result=mysqli_query($conn,"SELECT `name` FROM `class`");
                            echo '<select name="class">';
                            echo '<option selected disabled>Select Class</option>';
                        while($row = mysqli_fetch_array($class_result)){
                            $display=$row['name'];
                            echo '<option value="'.$display.'">'.$display.'</option>';
                        }
                        echo'</select>'
                    ?>

                    <input type="text" name="rn" placeholder="Roll No" autocomplete="off">
                    <input type="submit" value="Get Result">
                </fieldset>
            </form>
        </div>
                        
        <div class="login">
            <form action="" method="post"  >
            <fieldset>
                <p>Feedback</p>
                 <input type="text" name="rno" placeholder="Roll No" autocomplete="off">
                <input type="text" name="feed" placeholder="Feedback" autocomplete="off">
                <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </div>

</body>
</html>

<?php
    include("init.php");
    session_start();

    if (isset($_POST["userid"],$_POST["password"]))
    {
        $username=$_POST["userid"];
        $password=$_POST["password"];
        $sql = "SELECT userid FROM admin_login WHERE userid='$username' and password = '$password'";
        $result=mysqli_query($conn,$sql);

        // $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        
        if($count==1) {
            $_SESSION['login_user']=$username;
            header("Location: dashboard.php");
        }else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password")';
            echo '</script>';
        }
        
    }

?>

<?php
    include("init.php");

     if (isset($_POST['rno'],$_POST['feed']))
     {
        $rno=$_POST["rno"];
        $feedback=$_POST["feed"];
         
         if (empty($rno) or empty($feedback))
         {
            if(empty($rno))
                echo '<p class="error">Please enter roll no</p>';
            if(empty($feedback))
                echo '<p class="error">Please enter feedback </p>';
             exit();
         }
         
        $sql = "INSERT INTO `feedback` (`rno`,`feedback`) VALUES('$rno','$feedback')";
        $result=mysqli_query($conn,$sql);
         
          
        if (!$result)
        {
            echo '<script language="javascript">';
            echo 'alert("Invalid details")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Successful")';
            echo '</script>';
        }
        
    }
?>



