<!-- included database connection file -->
<?php
    include ("db.php");
?>

<?php
    if (isset($_POST['logout'])) 
    {
        unset($_SESSION['fn']);
        unset($_SESSION['un']);
        unset($_SESSION['pwd']);
        header("Location:index.php");
    }
?>
<?php
    if (isset($_POST['friends'])) 
    {
        header("Location:friends.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon-chat.ico" type="image/x-icon">
    <link rel="icon" href="favicon-chat.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Social Network</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="profile.php" class="nav-link" style="margin-right:50px;">Welcome, <?php echo htmlentities($_SESSION['fn']); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <form action="" method="post">
            <button class="btn btn-outline-info my-2 my-sm-0" name="friends" style="margin-right:50px;" type="submit">Friends</button>
        </form>
      </li>
    </ul>
    <button type="button" class="btn btn-outline-danger my-2 my-sm-0" style="margin-right:50px;" data-toggle="modal" data-target="#exampleModal">Logout</button>
  </div>
</nav>

<!--Logout Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Do you really want to logout?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="" method="post">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>