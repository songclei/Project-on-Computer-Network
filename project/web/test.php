<?php
    include_once("../user.php");

    $username = $_GET[user];
    $ret = checkUsernameUsed($username);
    if ($ret) {
        echo "Username {$username} is used";
    } else {
        echo "Username {$username} is not used";
    }

?>
