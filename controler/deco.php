<?php
session_destroy();
$test = shell_exec('/code_fini/Creer/deploy_projet');
echo $test;
include('./view/index.html');

?>