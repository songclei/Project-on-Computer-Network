<?php
	include_once("../../../lib/common.php");
	include_once("../../../lib/activity.php");
	$activity_id = intval($_GET['activity_id']);
	$activity = getActivities($activity_id);
	$list = $activity['list'];
	$smarty3->assign('list', $list);
	$smarty3->display('../../html/viewActivityInfo.html');
?>