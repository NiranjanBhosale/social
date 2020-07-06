<!-- included database connection file -->
<?php
    include ("db.php");
?>

<!-- user registration -->
<?php

    if(isset($_POST['user_signin']))
    {
        $fullname = $_POST['firstname']." ".$_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $confpass = $_POST['confpass'];
        $valid = $_POST['valid'];
        $_SESSION['status'] = "";
        $_SESSION['status_color'] = "";

        $select_user = "SELECT * FROM user"; 
        $result_user = mysqli_query($connection, $select_user);
        
            $count = mysqli_num_rows($result_user);
            if($count == 0  && $valid=="true")
            {
                $_SESSION['status'] = "Account created successfully";
                $_SESSION['status_color'] = 'green';
                $insert_user = "INSERT INTO user (fullname, username, password) VALUES ('$fullname', '$username', '$password')";
                $result_insert = mysqli_query($connection, $insert_user);
                if ($result_insert) 
                {
                 header("Location:index.php");   
                }
            }

            else if($count != 0)
            {
                $match_user = "SELECT * FROM user WHERE username = '$username'"; 
                $result_match = mysqli_query($connection, $match_user);
                if(mysqli_num_rows($result_match)>0)
                {
                    $_SESSION['status'] = "Username already exists";
                    $_SESSION['status_color'] = 'red';
                }
                else if(mysqli_num_rows($result_match) == 0 && $valid=="true")
                {
                    $_SESSION['status'] = "Account created successfully";
                    $_SESSION['status_color'] = 'green';
                    $insert_user = "INSERT INTO user (fullname, username, password) VALUES ('$fullname', '$username', '$password')";
                    $result_insert = mysqli_query($connection, $insert_user);
                    if ($result_insert) 
                    {
                     header("Location:index.php");   
                    }
                }
            }
            
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
                <center><h2 style="color:<?php echo $_SESSION['status_color'];?>;"><?php echo $_SESSION['status'];?></h2></center>
                <?php
            }
        ?>
        <div class="container">
        <form method="post" class="form-horizontal">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label>First Name:</label>
                <input name="firstname" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                <label>Last Name:</label>
                <input name="lastname" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label >Username:</label>
                <input name="username" type="text" id="user-name" class="form-control" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label >Password</label>
                <input name="pass" type="password" id="pass1" class="form-control" required> 
                </div>
                <div class="form-group col-md-6">
                <label >Confirm Password</label>
                <input name="confpass" type="password" id="pass2" class="form-control" required>
                <input type="hidden" name="valid" id="valid" value="false">
                </div>
            <button type="submit" name="user_signin" class="btn btn-outline-primary" onclick="validate()">Sign Up</button>
        </form>
        </div>
        <script src="validations.js"></script>
    </body>
</html>