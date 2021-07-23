<?php

include 'connect.php';
$result = [];
$query ="SELECT * FROM debts  ORDER BY id desc";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
	$userid = $rows['client_id'];
	$user = "SELECT * FROM clients WHERE id='$userid'";
	$usersql = mysqli_query($con, $user);
	$userRow = mysqli_fetch_array($usersql);
    if ($rows['price'] == 0) {
        continue;
    } else {
        $data = array('names' => $userRow['names'] ,'phone' => $userRow['phone_number'], 'debt' => $rows['price']);
        array_push($result, $data);
    }
    

}
 echo json_encode($result);
$con->close();
?>
