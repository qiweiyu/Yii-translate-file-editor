<?php
$source = dirname(__FILE__)."/"."1.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yii translate file editor</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
</head>
<body>
<?php
$mod = $_POST['mod'];
if($mod == "submit") {
	$str = "<?php
return array(
	";
}
else {
	$str = file_get_contents($source);
}
?>
</body>
</html>
