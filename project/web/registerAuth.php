<?php
    include_once("../lib/common.php");
    include_once("../lib/user.php");

    $param = $_POST;
    $ret = addUser($param);
    
    if ($ret['status'] === 0) {
        header("Location: ./index.php");
        exit();
    }
    else {
        header("Location: ./register.php");
        exit();
    }
?>
