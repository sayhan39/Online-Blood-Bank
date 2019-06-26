<!DOCTYPE html>
<html>
<head>
	<title>Blood Bank Query</title>
	<link rel="stylesheet" type="text/css" href="queryStyle.css">
</head>
<body>
	<?php
	include ('Header.html');
	include ('NavigationColumn.html');

	$servername='localhost';
	$dbname='blood_bank_website';
	$username='root';
	$password='';
	$conn=new mysqli($servername,$username,$password,$dbname);
  	?>
	<form class="searchForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<span class='formtext'>City:</span><select class='formin' name="city">
			<option value="Barishal">Barishal</option>	
			<option value="Chottogram">Chottogram</option>
			<option value="Dhaka">Dhaka</option>
			<option value="Khulna">Khulna</option>
			<option value="Maymansingh">Maymansingh</option>
			<option value="Rajshahi">Rajshahi</option>
			<option value="Rangpur">Rangpur</option>
			<option value="Sylhet">Sylhet</option>
		</select><br><br>
		<span class="formtext">Blood Group:</span><select class="formin" name="bgroup">
			<option value="*">Any</option>
			<option value="A+">A+</option>
			<option value="A-">A-</option>
			<option value="B+">B+</option>
			<option value="B-">B-</option>
			<option value="O+">O+</option>
			<option value="O-">O-</option>
			<option value="AB+">AB+</option>
		</select><br><br>
	<input type="submit" name="submit">

	</form>
	<div class="queryContent">
	<?php
	$sql = $result = '';
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		include 'queryContent.php';
	}
	?>
	</div>
<div class="time">
<?php
$title='Blood Bank Query';
$loc='	(Location: /Availability/query.php)';
date_default_timezone_set("Asia/Dhaka");
$Today=date('Y-m-d h:i:sa');
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
</div>

</body>
</html>