<?php
    include_once("../lib/common.php");
    include_once("../lib/user_activity.php");
    session_start();
    if (!empty($_SESSION['username'])) {
        $smarty3->assign('login', true);
        $smarty3->assign('username', $_SESSION['username']);

        $uid = $_SESSION['uid'];
        $activities = getActivitiesByUserId($uid);
        $list = $activities['list'];

        $smarty3->assign('list', $list);
    } else {
        $smarty3->assign('login', false);
    }


    $smarty3->display('./html/manageActivity.html');
?>