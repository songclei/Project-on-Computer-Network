<?php
	include_once("../lib/common.php");
	include_once("../lib/activity.php");
	session_start();

	$activity_id = intval($_GET['activity_id']);
	$smarty3->assign('activity_id', $activity_id);

	if (!empty($_SESSION['username'])) {
        $smarty3->assign('login', true);
        $smarty3->assign('username', $_SESSION['username']);
        $smarty3->assign('role', $_SESSION['role']);
    } else {
        $smarty3->assign('login', false);
    }

	$smarty3->display('./html/infoManager.html');
?>