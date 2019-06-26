<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>All Users</title>
	
</head>
<body>
	<?php
	    date_default_timezone_set("Asia/Dhaka");
		$title="All Users";
		$loc = "			(Location: allUsers/allUsers.php)";
		include ('Header.html');
		include ('NavigationColumn.html');
		include ('Contents.php');
	?>
<?php $Today=date('Y-m-d h:i:sa');
echo "Time is ",$Today,'<br>','<br>';
$Today=date_create($Today);
$newFile = fopen('../log.txt', 'a');
$time=$Today->format("d M, Y | h : i : sa");
$txt="\n";
$space=" | ";
fwrite($newFile, $time);
fwrite($newFile, $space);
fwrite($newFile, $title);
fwrite($newFile, $loc);
fwrite($newFile, $txt);
fclose($newFile);
?>
</body>
</html>