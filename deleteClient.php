<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$history = "DELETE FROM `history` WHERE client_id='$id'";
$debts = "DELETE FROM `debts` WHERE client_id='$id'";
$client ="DELETE FROM `clients` WHERE id='$id'";
mysqli_query($con, $history);
mysqli_query($con, $client);
mysqli_query($con, $debts);

$result = "Clients deleted    $id";
echo json_encode($result);


?> 