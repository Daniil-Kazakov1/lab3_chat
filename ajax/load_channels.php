<?php
    require_once "../config/connect.php";
    $channels = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM channels ORDER BY id"));
    $user = $_POST['user'];
    $time = time()+3*60*60;
    if (isset($channels)) {
        foreach ($channels as $channel) {
            // 15 минут - время удаления
            if ($time - $channel[4] > 15*60){
                mysqli_query($connect, "DELETE FROM channels WHERE id = '$channel[0]'");
                mysqli_query($connect, "DELETE FROM messages WHERE channel_id = '$channel[0]'");
                mysqli_query($connect, "DELETE FROM permissions WHERE channel_id = '$channel[0]'");
            }
            else {
                $permission = mysqli_fetch_row(mysqli_query($connect,"SELECT COUNT(*) FROM permissions WHERE `user` = '$user' AND channel_id = '$channel[0]'"));
                if ($permission[0] == 1 || $channel[2] == 'public') echo "<button type='button' class='btn btn-secondary' id='$channel[0]' name='$channel[1]' onclick='open_channel(`$channel[0]`)'> $channel[1] </button>";
            }
        }
        echo "<button type='button' class='btn btn-secondary' id='add_channel' onclick='add_channel()'> + </button>";
    }
?>
