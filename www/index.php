<?php 
require_once("_LoadEnv.php");
$Page = new Page();

$Page->set("title","DAVE Fontend Test");
$Page->set("body","Welcome to the Internet! <br /> <a href=\"page2.php\">checkout page 2</a>");

$Page->render();
?>