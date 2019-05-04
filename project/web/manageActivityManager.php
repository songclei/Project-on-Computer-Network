<?php
    include_once("../lib/common.php");
    include_once("../lib/activity.php");
    session_start();
    if (!empty($_SESSION['username'])) {
        $smarty3->assign('login', true);
        $smarty3->assign('username', $_SESSION['username']);
        $smarty3->assign('role', $_SESSION['role']);
    } else {
        $smarty3->assign('login', false);
    }

    $activities = getActivities();
    $list = $activities['list'];
    $smarty3->assign('list', $list);
    $smarty3->display('./html/manageActivityManager.html');
?>
