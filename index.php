<!-- included database connection file -->
<?php
    include ("db.php");
?>

<!-- user login -->
<?php
    if(isset($_POST['login']))
    {
        $username = $_POST['user'];
        $pass = $_POST['pass'];
        if(empty($username))
        {
            echo "<script>alert('Please enter the username');</script>";
        }
        else if(empty($pass))
        {
            echo "<script>alert('Please enter the password');</script>";
        }
        else
        {
            $login_user = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
            $result_login =  mysqli_query($connection, $login_user);
            if ($result_login) 
            {
                $count = mysqli_num_rows($result_login);
                if ($count == 1) 
                {
                    while ($row_login = mysqli_fetch_assoc($result_login)) 
                    {
                        $id = $row_login['id'];
                        $fn = $row_login['fullname'];
                        $un = $row_login['username'];
                        $pwd = $row_login['password'];
                    }
                    $_SESSION['id'] = $id;
                    $_SESSION['fn'] = $fn;
                    $_SESSION['un'] = $un;
                    $_SESSION['pwd'] = $pwd;
                    header("location:profile.php");
                }
                else
                {
                    echo "<script>alert('Invalid Username or Password');</script>";   
                }
            }
        }
    }
?>

<!-- redirect to user register page-->
<?php

    if(isset($_POST['signup']))
    {
        header("Location:signup.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Social Network</title>
        <link rel="shortcut icon" href="favicon-chat.ico" type="image/x-icon">
        <link rel="icon" href="favicon-chat.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
    <div style="height:60px;"></div>
        <?php
            if(isset($_SESSION['status']) && isset($_SESSION['status_color']))
            {
                ?>
                <center><h2 style="color:<?php echo $_SESSION['status_color'];?>;"><?php echo $_SESSION['status'];?> !</h2></center>
                <?php
                unset($_SESSION['status']);
                unset($_SESSION['status_color']);
            }
        ?>
        <div class="container">
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-2">Username:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" name="user" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Password:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="password" name="pass" id="pass">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-2">
                        <input class="btn btn-outline-primary" type="submit" name="login"  value="Log In">
                        <input class="btn btn-outline-secondary" type="submit" name="signup" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>