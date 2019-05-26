<?php
    include_once("../../lib/common.php");
    include_once("../../lib/activity.php");

    $param = empty($_GET) ? $_POST : $_GET;
    $activityname = $param['activityname'];
    if (checkActivitynameUsed($activityname))
        echo "已存在同名活动";
    else
        echo "";
?>