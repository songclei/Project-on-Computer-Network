<?php
    include_once("../common.php");
    include_once("../activity.php");

    $activities = getActivities();
    $list = $activities['list'];
    $smarty3->assign('list', $list);
    $smarty3->display(WEB_ROOT . '/html/activityList.html');
?>