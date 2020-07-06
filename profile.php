<!-- Included header file -->
<?php
    include ("header.php");
?>
<?php
    if (isset($_POST['submit_post'])) 
    {
        $post = $_POST['post'];
        $id = $_SESSION['id'];
        $post_message = "";
        $post_color = ""; 
        if (strlen($post)>10) 
        {
            $insert_post = "INSERT INTO posts(posts, id) VALUES ('$post', '$id')";
            $result_post = mysqli_query($connection, $insert_post);
            $post_message = "Message posted successfully";
            $post_color = 'green';
        }
        elseif (strlen($post)<10) 
        {
            $post_message = "Message too short";
            $post_color = 'red';
        }
    }
?>
<div style="height:50px;"></div>
<?php
    if(isset($post_message))
    {
        ?>
        <center><h4 style="color:<?php echo $post_color;?>;"><?php echo $post_message; ?></h4></center>
        <?php
    }
?>
<div class="container row">
    <div class="col-lg-6 col-md-6">
        <form action="" method="post">
            <textarea name="post" id="" style="margin-left:20px; border-radius:5px;" cols="50" rows="7"></textarea><br>
            <button class="btn btn-outline-success" style="margin-left:20px; width:100px;" name="submit_post" type="submit">Post</button>
        </form>
    </div>
    <div class="col-lg-6 col-md-6">
                <?php
                    $reqid = $_SESSION['id'];
                    $friend_req1 = "SELECT username, posts FROM user JOIN friends ON user.id = friends.sender_id AND $reqid = friends.acceptor_id OR $reqid = friends.sender_id AND user.id = friends.acceptor_id  AND friends.status = '1' JOIN posts ON posts.id = friends.sender_id AND $reqid = friends.acceptor_id OR $reqid = friends.sender_id AND posts.id = friends.acceptor_id  WHERE friends.status = '1' ORDER BY posts.post_id DESC";
                    $result_req1 = mysqli_query($connection, $friend_req1);

                    while ($row_req1 = mysqli_fetch_assoc($result_req1))
                    {
                ?>
                    <h5>Update from <?php echo htmlentities($row_req1['username']); ?></h5>
                    <p class="text-justify"><?php echo htmlentities($row_req1['posts']); ?></p>
                    <?php
                }
                ?>
            
    </div>
</div>
<!-- Included footer file -->
<?php
    include ("footer.php");
?>
