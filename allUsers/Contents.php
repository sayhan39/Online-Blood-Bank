<!DOCTYPE html>
<html>
<head>
	<title>Blood Bank Query</title>
	<link rel="stylesheet" type="text/css" href="queryStyle.css">
	<style>
table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
	</style>
</head>
<body>
	<?php
	$servername='localhost';
	$dbname='blood_bank_website';
	$username='root';
	$password='';
	$conn=new mysqli($servername,$username,$password,$dbname);
  	?>
	<div class="queryContent">
	<?php
	$sql = $result = '';
		$sql="SELECT F_name,L_name,blood_group.b_group,address.Address,contacts.Mobile,address.City FROM donors,blood_group,address,contacts WHERE donors.Email=blood_group.Email AND address.Email=donors.Email AND contacts.Email=donors.Email";
		$result=$conn->query($sql);
		if(mysqli_num_rows($result) > 0)
		{
			echo '<table>
					<tr>
						<th>Name</th>
						<th>Blood Group</th>
						<th>City</th>
						<th>Address</th>
						<th>Contact No.</th>
					</tr>';
			while($row=$result->fetch_assoc())
			{
				$name = $row['F_name'].' '.$row['L_name'];
				$b_group = $row['b_group'];
				$city = $row['City'];
				$address = $row['Address'];
				$mobile = $row['Mobile'];
				echo '<tr>
						<td>'.$name.'</td>
						<td>'.$b_group.'</td>
						<td>'.$city.'</td>
						<td>'.$address.'</td>
						<td>'.$mobile.'</td>
					</tr>';
			}
			echo '</table>';
		}
		else
		{
		echo '0 result found.<br><br>';
		}
	?>
<?php
$title='Blood Bank Query';
$loc='	(Location: /Availability/query.php)';
$Today=date('Y-m-d h:i:sa');
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