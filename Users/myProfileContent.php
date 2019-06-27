<?php
if(ISSET($_COOKIE['user']))
{
	$email = $_COOKIE['user'];
}
?>
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
	$sql="SELECT F_name,L_name,Date_of_Birth,blood_group.b_group,address.Address,contacts.Mobile FROM donors,blood_group,address,contacts WHERE donors.Email='$email' AND donors.Email=blood_group.Email AND address.Email=donors.Email AND contacts.Email=donors.Email";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result) > 0)
	{
		$row=$result->fetch_assoc();
		echo '<table>
				<tr>
					<td>Name: </td>
					<td>'.$row['F_name'].' '.$row['L_name'].'</td>
				</tr>
				<tr>
					<td>Blood Group: </td>
					<td>'.$row['b_group'].'</td>
				</tr>
				<tr>
					<td>Address: </td>
					<td>'.$row['Address'].'</td>
				</tr>
				<tr>
					<td>Mobile No.: </td>
					<td>'.$row['Mobile'].'</td>
				</tr>
			</table>';
	}
	else
	{
	echo '0 result found.<br><br>';
	}

	?>
</div>