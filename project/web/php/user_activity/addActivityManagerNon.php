<?php
    /**
     * 为没参加活动的人直接添加管理员权限
     */
    include_once("../../../lib/common.php");
    include_once("../../../lib/user_activity.php");
    session_start();

    $user_id = intval($_GET['user_id']);
    $activity_id = intval($_GET['activity_id']);

    $ret = addActivityManagerNon($activity_id, $user_id);
    if ($ret['status'] === 0) {
        header("Location: ../../attendentManager.php?activity_id=". $activity_id);
        exit();
    } else {
        echo($ret['err_msg']);
        exit();
    }
?>