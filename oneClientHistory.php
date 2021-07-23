<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$result = [];
$query ="SELECT * FROM history WHERE client_id='$id' ORDER BY id desc";
$sql=mysqli_query($con,$query);
$user = "SELECT names FROM clients WHERE id='$id'";
$usersql = mysqli_query($con, $user);
$userRow = mysqli_fetch_array($usersql);
while ($rows=mysqli_fetch_array($sql))  {
	$data = array('names' => $userRow['names'] ,'products' => $rows['products'], 'amount' => $rows
['price'], 'date' => $rows['created_at'], 'action' => $rows['action']);
	array_push($result, $data);

}
 echo json_encode($result);
$con->close();
?>
