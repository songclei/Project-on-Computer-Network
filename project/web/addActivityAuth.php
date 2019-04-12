<?php
	include_once("../common.php");
    include_once("../activity.php");

    $param = $_POST;
    $ret = addActivities($param);

    if ($ret['status'] === 0) {
        print("succeed");
        header("Location: ./index.php");
        exit();
    }
    else {
        print("fail");
        header("Location: ./addActivity.php");
        exit();
    }
?>