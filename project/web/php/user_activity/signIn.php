<?php
    /**
     * 为活动的参加者添加管理员权限
     */
    include_once("../../../lib/common.php");
    include_once("../../../lib/user_activity.php");
    session_start();

    $user_id = intval($_GET['user_id']);
    $activity_id = intval($_GET['activity_id']);

    // 检查user是否是activity的参加者
    if (empty($user_id) || checkActivityAttendent($user_id, $activity_id) === 0) {
        echo('user'+$user_id+' is not a participant of activity'+$activity_id);
        exit();
    }

    //检测user是否已经签到过了
    if (check_sign_in($activity_id, $user_id) === 1)
    {
        #$msg = 'user'+$user_id+' has already signed in activity'+$activity_id;
        $msg = '您已签到，请勿重复签到';
        $smarty3->assign('msg', $msg);
        $smarty3->display("../../html/successfulSignin.html");
        exit();
    }

    //执行签到操作
    $ret = add_sign_in($activity_id, $user_id);
    if ($ret['status'] === 0) {
        $msg = '您已成功签到';
        $smarty3->assign('msg', $msg);
        $smarty3->display("../../html/successfulSignin.html");
    } else {
        echo($ret['err_msg']);
        exit();
    }
?>
