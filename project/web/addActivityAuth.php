<?php
	include_once("../lib/common.php");
    include_once("../lib/activity.php");
    session_start();

    $param = $_POST;
    $param['uid'] = $_SESSION['uid'];
    $ret = addActivities($param);

    if ($ret['status'] === 0) {
        //print("succeed");
        header("Location: ./index.php");
        exit();
    }
    else {
        header("Location: ./addActivity.php");
        exit();
    }
?>