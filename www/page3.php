<?php 
require_once("_LoadEnv.php");
$Page = new Page();

$Page->set("title","DAVE Fontend Test");

$BODY = "";
$BODY .= "Now on this page, I make use of an API to render in some dynamic data <br><br>";

$PostArray = array( 
	"Action" => "A_DUMMY_ACTION", 
	"OutputType" => "PHP"
);
$APIRequest = new APIRequest($API_URL, $PostArray, $IP);
$APIDATA = $APIRequest->DoRequest();
if ($APIDATA != false)
{
	$APIResponse = "Your request came from ".$APIDATA['IP']." and took ".$APIDATA['ComputationTime']." seconds.";
}
else
{
	$APIResponse = 'Something is wrong with your URL or DAVE API configuration';
}

$BODY .= "<strong>API Response from ".$API_URL.":</strong> ".$APIResponse;
$BODY .= "<br>of course, you can also access the API in JS";

$Page->set("body",$BODY);
$Page->render();
?>
