<?php

session_start();

?>

<?php

$connection = mysqli_connect('localhost','root','','social');

if($connection)
{
// echo "Connection successfull";
}
else
{
    echo "Error in connection";
}

?>