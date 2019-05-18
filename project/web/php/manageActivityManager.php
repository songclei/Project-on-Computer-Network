<?php
    include_once("../../lib/common.php");
    include_once("../../lib/activity.php");
    session_start();
    if (!empty($_SESSION['username'])) {
        $smarty3->assign('login', true);
        $smarty3->assign('username', $_SESSION['username']);
        $role = $_SESSION['role'];
        $uid = $_SESSION['uid'];
        $smarty3->assign('role', $role);
        if($role === 1){
            $activities = getActivities();
            $list = $activities['list'];
            $smarty3->assign('list', $list);
        }
        else{
            $activities = getActivitiesByUserId($uid);
            $list = $activities['list'];
            $smarty3->assign('list', $list);
        }
        $smarty3->display('../html/manageActivityManager.html');
    } else {
        $smarty3->assign('login', false);
        $smarty3->display('../html/login.html');
    }

?>
