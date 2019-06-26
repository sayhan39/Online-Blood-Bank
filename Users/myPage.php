<?php
$cookie_value=$cookie_name='';
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$cookie_value=$_POST['email'];
	$cookie_name='user';
}
if(!empty($cookie_value))
{
	setcookie($cookie_name,$cookie_value,time()+(86400*30));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include ('Header.html');
	include ('NavigationColumn.html');
	include ('homeContent.html');
	?>

</body>
</html>