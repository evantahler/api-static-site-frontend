<!doctype html>
<html>
<?php
require_once("LoadEnv.php");
$PageData = array(
	"Title" => "Page Title",
	"Description" => "Page Description",
	"Author" => "Page Author"
);
require_once("partials/head.php");
?>

<body>
	<div id="container">
	<?php require_once("partials/header.php"); ?>
	<div id="main" role="main">
		Hello, and welcome to the internet!
	</div>
	<?php require_once("partials/footer.php"); ?>
	</div> <!-- eo #container -->
<?php require_once("partials/google_analytics.php"); ?>
</body>

</html>