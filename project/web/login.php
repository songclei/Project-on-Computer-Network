<?php
    define('ROOT_DIR', trim(__DIR__, 'web'));
    include(ROOT_DIR . "./smarty3/main.php");
    $smarty3->display("./html/login.html");
?>