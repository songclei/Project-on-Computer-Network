<?php
	include_once("../../../lib/common.php");
    include_once("../../../lib/activity.php");
    session_start();

    $param = $_POST;
    $activity_id = $param['activity_id'];
    $ret = changeActivityInfo($param);

    if ($ret['status'] === 0) {
        header("Location: ./viewActivity.php?activity_id=". $activity_id . "&from_info_change=1");
        exit();
    }
    else {
        header("Location: ../infoManager.php?activity_id=". $activity_id);
        exit();
    }
?>