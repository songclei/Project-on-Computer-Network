<?php
	include_once("../../../lib/common.php");
	include_once("../../../lib/activity.php");
	session_start();

	$activity_id = intval($_GET['activity_id']);
	# whether to show the "back_to_info_change" button
	$from_info_change = intval($_GET['from_info_change']);
	$activity = getActivities(array("id" => $activity_id));
	$list = $activity['list'];
	$smarty3->assign('list', $list);
	$smarty3->assign('from_info_change', $from_info_change);

	if(!empty($_SESSION['username']))
	{
		$smarty3->assign('login', true);
		//$smarty3->assign('uid', $uid);
		$uid = $_SESSION['uid'];
		if (checkActivityAttendent($uid, $activity_id) === 1)
			{$smarty3->assign('attendence', true);}
		else{$smarty3->assign('attendence', false);}
	}
	else{$smarty3->assign('login', false);}

	$smarty3->display('../../html/viewActivityInfo.html');
?>
