<?php
    include ("header.php");
?>


<!-- Send a friend request -->
<?php

    if (isset($_POST['add_friend'])) 
    {
        $acceptor_id = $_POST['user_id'];
        $sender_id = $_SESSION['id'];
        $request_message = "";
        $request_color = "";

        $select_friend = "SELECT * FROM friends WHERE sender_id = '$sender_id' AND acceptor_id = '$acceptor_id'";
        $result_friend = mysqli_query($connection, $select_friend);

        $select_friend1 = "SELECT * FROM friends WHERE sender_id = '$acceptor_id' AND acceptor_id = '$sender_id'";
        $result_friend1 = mysqli_query($connection, $select_friend1);
        
        $count = mysqli_num_rows($result_friend);
        $count1 = mysqli_num_rows($result_friend1);
        if ($count == 1) 
        {
            $request_message = "Request already sent or friend request accepted";
            $request_color = 'red';
        }
        else if ($count1 == 1) 
        {
            $request_message = "Already a friend or accept the request from this user";
            $request_color = 'red';
        }
        else 
        {
            $insert_friend = "INSERT INTO friends(sender_id, acceptor_id, status) VALUES ('$sender_id', '$acceptor_id', 'NULL')";
            $result_insert = mysqli_query($connection, $insert_friend);
            $request_message = "Request sent sucessfully";
            $request_color = 'green';
        }
    }

?>

<!-- Accept a friend request -->
<?php

    if(isset($_POST['accept']))
    {
        $acceptor_id1 = $_SESSION['id'];
        $sender_id1 = $_POST['usid'];
        $accept_req = "UPDATE friends SET status = 1 WHERE acceptor_id = '$acceptor_id1'  AND sender_id='$sender_id1'";
        $result_accept = mysqli_query($connection, $accept_req);
    }
    elseif (isset($_POST['decline'])) 
    {
        $acceptor_id2 = $_SESSION['id'];
        $sender_id2 = $_POST['usid'];
        $accept_req1 = "UPDATE friends SET status = 0 WHERE acceptor_id = '$acceptor_id2' AND sender_id='$sender_id2'";
        $result_accept1 = mysqli_query($connection, $accept_req1);
    }

?>
<?php
            if (isset($request_message)) 
            {
                ?><center><h5 style="color:<?php echo $request_color;?>;"><?php echo $request_message;?> !!</h5></center><?php
            }
        ?>
<center>
<div class="container row">
    <div class="col-lg-4 col-md-4 col-sm-4">
        
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Friend Requests</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $req_id = $_SESSION['id'];
                    $friend_req = "SELECT id, username FROM user JOIN friends ON user.id = friends.sender_id AND $req_id = friends.acceptor_id AND friends.status = 'NULL' ";
                    $result_req = mysqli_query($connection, $friend_req);

                    while ($row_req = mysqli_fetch_assoc($result_req)) 
                    {
                ?>
                <tr>
                    <td>
                    <?php echo htmlentities($row_req['username']) ?>
                    </td>
                    <td>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="usid" value="<?php echo $row_req['id']?>">
                        <button type="submit" style="margin-left:15px;" name="accept" class="btn btn-primary">Yes</button>
                        <button type="submit" style="margin-left:15px;" name="decline" class="btn btn-danger">No</button>
                    </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Friends</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $reqid = $_SESSION['id'];
                    $friend_req1 = "SELECT username FROM user JOIN friends ON user.id = friends.sender_id AND $reqid = friends.acceptor_id OR $reqid = friends.sender_id AND user.id = friends.acceptor_id  WHERE friends.status = '1' ";
                    $result_req1 = mysqli_query($connection, $friend_req1);

                    while ($row_req1 = mysqli_fetch_assoc($result_req1)) 
                    {
                ?>
                <tr>
                    <td><?php echo htmlentities($row_req1['username']); ?></td>
                </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div  class="col-lg-4 col-md-4 col-sm-4">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Users</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $disp_user = "SELECT * FROM user";
                    $res_disp = mysqli_query($connection, $disp_user);
                    while ($row_disp = mysqli_fetch_assoc($res_disp)) 
                    {
                ?>
                <tr>
                    <!-- Skips the current logged in user -->
                    <?php
                        if ($_SESSION['id'] == $row_disp['id']) 
                        {
                            continue;
                        }
                        else
                        {
                    ?>
                        <td>
                            <?php echo htmlentities($row_disp['username']); ?>
                        </td>
                        <td>
                        <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo $row_disp['id'] ?>">
                        <button type="submit" style="margin-left:15px;" name="add_friend" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                        </form>
                        </td>
                </tr>
                <?php
                        }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</center>






<?php
    include ("footer.php");
?>