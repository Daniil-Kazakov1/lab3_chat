<?php
    require_once "../config/connect.php";
    $user = $_POST['user'];
    $channel = $_POST['channel'];

    mysqli_query($connect, "DELETE FROM permissions WHERE channel_id = '$channel' AND `user` = '$user'");
?>
