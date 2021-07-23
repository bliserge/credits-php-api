<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];


$query ="UPDATE `debts` SET price= 0 WHERE client_id='$id'";
mysqli_query($con,$query);
$result['message'] = "Debt deleted";
echo json_encode($result);
?>
