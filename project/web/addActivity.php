<?php
	include_once("../lib/common.php");
	session_start();
    if (!empty($_SESSION['username'])) {
        $smarty3->assign('login', true);
        $smarty3->assign('username', $_SESSION['username']);
    } else {
        $smarty3->assign('login', false);
    }
	$smarty3->display("./html/addActivity.html");
?>