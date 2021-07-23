<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$result = [];
$query ="SELECT * FROM `clients` WHERE id='$id'";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $data = array('id' => $rows['id'], 'names'=> $rows['names'], 'phone_number' => $rows['phone_number'], 'id_card' => $rows['id_number']);
	array_push($result, $data);

}
 echo json_encode($result);
?>
