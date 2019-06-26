<?php

		$city=$_POST['city'];
		$b_group=$_POST['bgroup'];
		if(is_null($city))
		{
			$city='*';
		}
		echo '<br>blood group: '.$b_group.'<br><br>';
		$sql="SELECT F_name,L_name,blood_group.b_group,address.Address,contacts.Mobile FROM donors,blood_group,address,contacts WHERE donors.Email=blood_group.Email AND address.Email=donors.Email AND contacts.Email=donors.Email AND blood_group.b_group='$b_group' AND address.City='$city'";
		$result=$conn->query($sql);
		if(mysqli_num_rows($result) > 0)
		{
			while($row=$result->fetch_assoc())
			{
				echo 'Name - '.$row['F_name'].' '.$row['L_name'].'<br>'.'Blood Group - '.$row['b_group'].'<br>'.'Address: '.$row['Address'].'<br>'.'Mobile no. - '.$row['Mobile'].'<br><br>';
			}
		}
		// else
		// {
		// echo '0 result found.<br><br>';
		// }
?>