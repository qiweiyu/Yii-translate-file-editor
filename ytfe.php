<?php
$source = dirname(__FILE__)."/"."test.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yii translate file editor</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
</head>
<body>
<style type="text/css">
html, body {
	padding:0px;
	margin:0px;
	background:#EEE;
}
table {
	width:480px;
	margin:20px auto;
	border:1px solid #AAA;
	text-align:left;
}
table input {
	width:220px;
}
p {
	width:480px;
	margin:0px auto;
	text-align:center;
}
p input {
	width:220px;
}
</style>
<?php
$mod = $_POST['mod'];
if($mod == "submit") {
	$str = "<?php
return array(".PHP_EOL;
	$key = $_POST['key'];
	$value = $_POST['value'];
	$arr = array();
	foreach($key as $k=>$v) {
		if($v) {
			$arr[$v] = $value[$k];
		}
	}
	ksort(&$arr);
	foreach($arr as $k=>$v) {
		$str = $str."\t'{$k}' => '{$v}',".PHP_EOL;
	}
	$str = $str.");";
	file_put_contents($source, $str);
}
$str = file_get_contents($source);
$tempArr = explode(PHP_EOL, $str);
$arr = array();
foreach($tempArr as $k => $v) {
	$v = explode("' => '", $v);
	if(count($v) > 1) {
		$arr[str_replace("\t'", "", $v[0])] = str_replace("',", "", $v[1]);
	}
}
?>
	<form action="" method="post">
	<table>
	<tr><th class="key">key</th><th>value</th></tr>
	<?php
	foreach($arr as $k => $v) {
		echo "<tr><td class=\"key\"><input type='text' name='key[]' value='$k' /></td><td><input type='text' name='value[]' value='$v' /></td></tr>";
	}
	?>
	</table>
	<input type="hidden" name="mod" value="submit" />
	<p><input type="button" onClick="addTr();" value="Add new key-value" /><input type="submit" /></p>
	</form>
<script type="text/javascript">
function addTr() {
	var table = document.getElementsByTagName('table').item(0);
	var key = prompt("Please input key:");
	var value = prompt("Please input value:");
	var row = table.insertRow(1);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	cell1.className = "key";
	cell1.innerHTML = "<input type='text' name='key[]' value='"+key+"' />";
	cell2.innerHTML = "<input type='text' name='value[]' value='"+value+"' />";
}
</script>
</body>
</html>
