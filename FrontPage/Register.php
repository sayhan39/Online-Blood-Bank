<!DOCTYPE html>
<html>
<head>
	<title>Donor Registration</title>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
		<?php
		$servername="localhost";
		$username="root";
		$password="";
		$dbname="blood_bank_website";

		$conn=new mysqli($servername,$username,$password,$dbname);
		#Check Connection ->
		if ($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}


		$title = 'Donor Registration';
		$loc = '	(Location: /FrontPage/Register.php)';
	    date_default_timezone_set("Asia/Dhaka");
		require ('functions.php');
		$name = $fname = $lname = $mail = $gender = $bgroup = $address = $city = $mobile = $comment = $pass = $birth = "";
		$nameErr = $mailErr = $genderErr = $bgroupErr = $addressErr = $cityErr = $passErr = $birthErr = $mobileErr = "";
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if(empty($_POST["fname"]) or empty($_POST['lname']))
			{
				$nameErr = "Name is required";
			}
			else
			{
				$fname=check_input($_POST['fname']);
				$lname=check_input($_POST['lname']);
				$name=check_input($_POST['fname']).' '.check_input($_POST['lname']);
				if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  					$nameErr = "Only letters and white space allowed"; 
				}
			}
			if(empty($_POST["mail"]))
			{
				$mailErr = "Mail is required";
			}
			else
			{
				$mail=check_input($_POST['mail']);
    			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      				$mailErr = "Invalid email format"; 
    			}
			}
			if(empty($_POST['gender']))
			{
				$genderErr = "Gender is required";
			}
			else
			{
				if($_POST['gender']=='Male')
				{
				$gender='Male';
				}
				else if($_POST['gender']=='Female')
				{
					$gender='Female';
				}
				else
				{
					$gender='Other';
				}

			}
			if(empty($_POST['birth']))
			{
				$birthErr = "Date of Birth is required";
			}
			else
			{
				$birth=$_POST['birth'];
			}
			if(empty($_POST['password']))
			{
				$passErr = 'Password is required';
			}
			else
			{
				$pass=$_POST['password'];
			}
			if(empty($_POST['address']))
			{
				$addressErr = "Address is required";
			}
			else
			{
				$address=check_input($_POST['address']);
			}
			$comment=check_input($_POST['comment']);
			$city=check_input($_POST['city']);
			$mobile=check_input($_POST['mobile']);
			$bgroup=check_input($_POST['bgroup']);
		}

		$sql = $conn->prepare("INSERT into Donors (F_name,L_name,Email,Date_of_Birth,Gender,PASSWORD) VALUES (?,?,?,?,?,?);");
		$sql1 = $conn->prepare("INSERT into address (Email,Address,City) VALUES (?,?,?);");
		$sql2 = $conn->prepare("INSERT INTO contacts VALUES (?,?);");
		$sql3 = $conn->prepare("INSERT into blood_group (Email,b_group) VALUES (?,?);");

		$sql->bind_param("sssbss",$fname, $lname, $mail, $birth, $gender, $pass);
		$sql1->bind_param("sss",$mail,$address,$city);
		$sql2->bind_param("ss",$mail,$mobile);
		$sql3->bind_param("ss",$mail,$bgroup);
		if($sql->execute()===true && $sql1->execute()===true && $sql2->execute()===true && $sql3->execute()===true)
		{
			$notice = "Data inserted successfully.<br>";
		}
		else
		{
			$notice = "Error:<br>" . $conn->error;
		}

		$conn->close();
	?>
		<div class="formHeader">Personal Info</div>
	<form class="reg" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><div class='top'>
		
		<span class="regtext">First Name:</span><span class="error">* <?php echo"  ", $nameErr?></span><br>
			<input class="regin" type="text" name="fname"><br><br>
		<span class="regtext">Last Name:</span><span class="error">* <?php echo"  ", $nameErr?></span><br>
				<input class="regin" type="text" name="lname"><br><br>
		
		<span class="regtext">Email:</span><span class="error">* <?php echo"  ", $mailErr?></span><br><input class="regin" type="text" name="mail"><br><br>
		<span class="regtext">Password:</span><span class="error">* <?php echo"  ", $passErr?></span><br><input class="regin" type="password" name="password"><br><br>

		<span class="regtext">Date of Birth:</span><br><input class="regin" type="Date" name="birth"><br><br>
		<span class="regtext">Gender:</span><span class="error">* <?php echo " ", $genderErr?></span><br>
				<input class="regin" type="radio" name="gender" value="Male">Male<br>
				<input class="regin" type="radio" name="gender" value="Female">Female<br>
				<input class="regin" type="radio" name="gender" value="Other">Other
				<br><br>
		<span class="regtext">Blood Group:</span><select class="regin" name="bgroup">
			<option value="A+">A+</option>
			<option value="A-">A-</option>
			<option value="B+">B+</option>
			<option value="B-">B-</option>
			<option value="O+">O+</option>
			<option value="O-">O-</option>
			<option value="AB+">AB+</option>
		</select><br><br>
		<span class="regtext">Address:</span><span class="error">* <?php echo " ", $addressErr?></span><br>
		<textarea class="regin" name="address" rows="8" cols="30"></textarea><br><br>
		<span class="regtext">City:</span><span class="error">* <?php echo " ", $cityErr?></span><br>
			<input class="regin" type="text" name="city"><br><br>
		<span class="regtext">Mobile:</span><span class="error">* <?php echo " ", $mobileErr?></span><br>
			<input class="regin" type="text" name="mobile"><br><br>
		<span class="regtext">Comment:</span><br>
		<textarea class="regin" name="comment" rows="8" cols="30"></textarea><br><br>
		<input type="submit" name="submit"></div>
</form>
<div class='login'><a class="login" href="Login.php">I am already registered!</a></div><br><br>
<?php
$Today=date('Y-m-d h:i:sa');
echo "Time is ",$Today,'<br>','<br>';
$Today=date_create($Today);
$birth=date_create($birth);
$diff=date_diff($Today,$birth);
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