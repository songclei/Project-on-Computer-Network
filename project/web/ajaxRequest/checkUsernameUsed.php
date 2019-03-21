<?php
    include_once("../../common.php");
    include_once("../../user.php");

    $param = empty($_GET) ? $_POST : $_GET;
    $username = $param['username'];
    if (checkUsernameUsed($username)) 
        echo "用户名已被使用";
    else 
        echo "";
?>
