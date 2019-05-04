<?php
    /**
     * 删除某个用户参与活动的记录
     */
    include_once("../../../lib/common.php");
    include_once("../../../lib/user_activity.php");
    session_start();

    $user_id = intval($_GET['user_id']);
    $activity_id = intval($_GET['activity_id']);

    $ret = deleteRecordById($activity_id, $user_id);
    if ($ret['status'] === 0) {
        header("Location: ../../attendentManager.php?activity_id=" . $activity_id);
        exit();
    } else {
        echo($ret['err_msg']);
        exit();
    }
?>