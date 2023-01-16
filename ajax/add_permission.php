<?php
    require_once "../config/connect.php";

    $channel_id = $_POST['channel_id'];
    $user = $_POST['name'];
    $exist = mysqli_fetch_row(mysqli_query($connect,"SELECT COUNT(*) FROM users WHERE nickname = '$user'"));
    if ($exist[0] == 0){
        echo 0;
        return 0;
    }
    $exist = mysqli_fetch_row(mysqli_query($connect,"SELECT COUNT(*) FROM permissions WHERE `user` = '$user' AND channel_id = '$channel_id'"));
    if ($exist[0] == 1) {
        echo 0;
        return 0;
    }
    mysqli_query($connect,"INSERT INTO permissions (id, channel_id, `user`) values(NULL, '$channel_id', '$user')");
    echo 1;
?>
