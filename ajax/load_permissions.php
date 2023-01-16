<?php
    require_once "../config/connect.php";

    $channel_id = $_POST['channel_id'];
    $user = $_POST['user'];
    $channel = mysqli_fetch_row(mysqli_query($connect, "SELECT * FROM channels WHERE id = '$channel_id'"));
    $permissions = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM permissions WHERE channel_id = '$channel_id' AND `user` != '$channel[3]'"));

    if ($channel[2] == 'private') {
        echo "<button type='button' id='$user' class='btn btn-danger' disabled> $channel[3] </button>";
        if ($user == $channel[3]) {
            $disabled = "";
        } else {
            $disabled = "disabled";
        }
        foreach ($permissions as $permission) {
            echo "<button type='button' $disabled onclick='delete_permission(`$permission[2]`)' id='$permission[2]' class='btn btn-danger'> $permission[2] </button>";
        }
        if ($user == $channel[3]){
            echo "<button type='button' id='add_permission' class='btn btn-success' onclick='add_permission()'>+</button>";
        }
    }
?>
