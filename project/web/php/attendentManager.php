<?php
	include_once("../../lib/common.php");
	include_once("../../lib/user_activity.php");
	session_start();

	$activity_id = intval($_GET['activity_id']);
	#$activity_id = intval(1);
	
	$users = getUserIdByActivities($activity_id);
	$other_users = getOtherUserIdByActivities($activity_id);
	$list = $users['list'];
	$other_list = $other_users['list'];
	$smarty3->assign('list', $list);
	$smarty3->assign('other_list', $other_list);
	$smarty3->assign('activity_id', $activity_id);

	if(!empty($_SESSION['username']))
	{
		$smarty3->assign('login', true);
		$smarty3->assign('username', $_SESSION['username']);
        $smarty3->assign('role', $_SESSION['role']);
	}
	else{$smarty3->assign('login', false);}

	$smarty3->display('../html/attendentManager.html');
?>
