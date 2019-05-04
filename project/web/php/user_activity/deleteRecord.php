<?php
    /**
     * 删除某个用户参与活动的记录
     */
    include_once("../../../lib/common.php");
    include_once("../../../lib/user_activity.php");
    session_start();

    $uid = intval($_SESSION['uid']);
    $user_id = intval($_GET['user_id']);
    $activity_id = intval($_GET['activity_id']);

    // 身份验证，get中获取的user_id应该与session中的一致
    if (empty($user_id) || $uid !== $user_id) {
        header("Location: ../../manageActivity.php");
        exit();
    }

    $ret = deleteRecordById($activity_id, $user_id);
    if ($ret['status'] === 0) {
        header("Location: ../../manageActivity.php");
        exit();
    } else {
        echo($ret['err_msg']);
        exit();
    }
?>
