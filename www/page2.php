<?php 
require_once("_LoadEnv.php");
$Page = new Page();

$Page->set("title","DAVE Fontend Test");
$Page->set("header","<h2>I overwrote the default header in the page code</h2>");

$BODY = "";
$BODY .= "I am an another example of a page <br>";
$BODY .= "I do other interesting things with my rendering <br>";
$BODY .= "<br><br>You should check my code out...<br><br>";

$Page->set("body",$BODY);
$Page->render();
?>
