<?php

include 'connect.php';
$result = [];
$query ="SELECT * FROM history  ORDER BY id desc";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
	$userid = $rows['client_id'];
	$user = "SELECT names FROM clients WHERE id='$userid'";
	$usersql = mysqli_query($con, $user);
	$userRow = mysqli_fetch_array($usersql);
	$data = array('names' => $userRow['names'] ,'products' => $rows['products'], 'amount' => $rows
['price'], 'date' => $rows['created_at'], 'action' => $rows['action']);
	array_push($result, $data);

}
 echo json_encode($result);
$con->close();
?>
