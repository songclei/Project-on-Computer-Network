<?php
include(__DIR__ . "/libs/Smarty.class.php");
define('SMARTY_ROOT', __DIR__ . '/tpls');
$smarty3 = new Smarty();
$smarty3->template_dir = SMARTY_ROOT."/templates/";
$smarty3->compile_dir = SMARTY_ROOT."/templates_c/";
$smarty3->config_dir = SMARTY_ROOT."/configs/";
$smarty3->cache_dir = SMARTY_ROOT."/cache/";
$smarty3->caching=false;
$smarty3->cache_lifetime=60*60*24;
$smarty3->left_delimiter = '{%';
$smarty3->right_delimiter = '%}';
$smarty3->force_compile = true;
?>
