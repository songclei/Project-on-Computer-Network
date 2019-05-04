<?php
    /**
     * 取消用户在活动中的管理员权限
     */
    include_once("../../../lib/common.php");
    include_once("../../../lib/user_activity.php");
    session_start();

    $user_id = intval($_GET['user_id']);
    $activity_id = intval($_GET['activity_id']);

    // 检查user是否已经是activity的管理员
    if (empty($user_id) || checkActivityManager($user_id, $activity_id) === 0) {
        header("Location: ../attendentManager.php?activity_id=". $activity_id);
        exit();
    }

    $ret = cancelActivityManager($activity_id, $user_id);
    if ($ret['status'] === 0) {
        header("Location: ../attendentManager.php?activity_id=" . $activity_id);
        exit();
    } else {
        echo($ret['err_msg']);
        exit();
    }
?>
