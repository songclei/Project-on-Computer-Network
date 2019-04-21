<?php
    /**
     * 这个是只给管理员删除活动所用的API, 会删除activity中的表项，如果只想删除某个用户
     * 参与某个活动的记录，应该调用deleteRecord.php
     */
    include_once("../lib/common.php");
    include_once("../lib/activity.php");
    include_once("../lib/user_activity.php");
    session_start();

    $uid = $_SESSION['uid'];
    $role = intval($_SESSION['role']);
    $activity_id = $_GET['activity_id'];

    // 身份验证，只有超级管理员与该活动的管理员才能进行删除
    if (!($role === 1 || checkActivityManager($uid, $activity_id) === 1)) {
        header("Location: manageActivity.php");
        exit();
    } 
    $ret = deleteActivity($activity_id);
    if ($ret['status'] === 0) {
        header("Location: manageActivity.php");
        exit();
    }
    else {
        echo($ret['err_msg']);
        exit();
    }
?>