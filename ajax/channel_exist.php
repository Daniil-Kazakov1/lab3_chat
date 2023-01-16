<?php
    require_once "../config/connect.php";
    $channel = $_POST['channel'];
    $user = $_POST['user'];
    $exist = mysqli_fetch_row(mysqli_query($connect,"SELECT COUNT(*) FROM channels WHERE id = '$channel'"));
    $permission = mysqli_fetch_row(mysqli_query($connect,"SELECT COUNT(*) FROM permissions WHERE `user` = '$user' AND channel_id = '$channel'"));
    $type = mysqli_fetch_row(mysqli_query($connect, "SELECT `type` FROM channels WHERE id = '$channel'"));
    if ($exist[0] == 1 && ($permission == 1 || $type[0] == 'public')){
        echo 1;
    }
    else{
        echo 0;
    }
?>
