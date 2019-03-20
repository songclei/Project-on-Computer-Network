<?php
    include_once("../common.php");
    include_once("../user.php");

    $param = $_POST;
    $param = array(
        "username" => "test",
        "password" => "test"
    );
    $ret =  addUser($param);
    
    echo $ret['status'] . "\n";
    echo $ret['err_msg'];
    if ($ret['status'] === 0) {
        header("Location: ./index.php");
    }
    else {
        header("Location: ./register.php");
    }
?>