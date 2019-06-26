<div class="Content">
	<h2>My Profile</h2>
	<?php
	date_default_timezone_set("Asia/Dhaka");
	$Today=date('Y-m-d h:i:sa');
	echo "Time is ",$Today,'<br>','<br>';
	$Today=date_create($Today);
	$servername='localhost';
	$username='root';
	$password='';
	$dbname='blood_bank_website';

	$conn=new mysqli($servername,$username,$password,$dbname);

	if($conn->connect_error)
	{
		die("Connection Failed: ".$conn->connect_error);
	}
	$sql=$result='';
	$sql="SELECT F_name,L_name,Date_of_Birth,blood_group.b_group,address.Address,contacts.Mobile FROM donors,blood_group,address,contacts WHERE donors.Email=blood_group.Email AND address.Email=donors.Email AND contacts.Email=donors.Email";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row=$result->fetch_assoc())
		{
			echo 'Name - '.$row['F_name'].' '.$row['L_name'].'<br>'.'Blood Group - '.$row['b_group'].'<br>'.'Date of Birth: '.$row['Date_of_Birth'].'<br>'.'Address: '.$row['Address'].'<br>'.'Mobile no. - '.$row['Mobile'].'<br><br><br>';
		}
	}
	else
	{
	echo '0 result found.<br><br>';
	}

	?>
</div>