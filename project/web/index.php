<?php
    include_once("../lib/common.php");
    include_once("../lib/activity.php");

    $activities = getActivities();
    $list = $activities['list'];
    $smarty3->assign('list', $list);
    $smarty3->display('./html/activityList.html');
?>
