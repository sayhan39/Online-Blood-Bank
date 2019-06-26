<?php
	$servername="localhost";
	$username="root";
	$password="";
	$dbname="blood_bank_website";


	#Connect to Database ->
	$conn = new mysqli($servername,$username,$password,$dbname);

	#Check Connection ->
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		echo "Connected Successfully".'<br>';
	}

	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$email=$_POST['mail'];
	$birth=$_POST['birth'];
	$gender=$_POST['gender'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$mobile=$_POST['mobile'];
	$bgroup=$_POST['bgroup'];

	echo 'gender is: '.$gender.'<br>';

	$sql = "INSERT into Donors (F_name,L_name,Email,Date_of_Birth,Gender) VALUES ($firstname,$lastname,'sayhanraieed@gmail.com',$birth,'Male');";
	/*$sql .= "INSERT into address (Email,Address,City) VALUES ($mail,$address,$city);";*/
	$sql2 = "INSERT INTO contacts VALUES ('sayhanraieed@gmail.com',$mobile);";
	$sql1 = "INSERT into blood_group (Email,b_group) VALUES ($mail,$bgroup);";

	if($conn->query($sql)===true)
	{
		echo "Data inserted successfully.<br>";
	}
	else
	{
		echo "Error:<br>" . $conn->error;
	}

	$conn->close();
?>