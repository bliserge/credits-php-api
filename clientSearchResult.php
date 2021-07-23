<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$searchKey = $data['searchKey'];
$result = [];
$query ="SELECT * FROM `clients` WHERE names like '%$searchKey%' OR phone_number LIKE '%$searchKey%'";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $data = array('names'=> $rows['names'], 'phone_number' => $rows['phone_number'], 'id_card' => $rows['id_number']);
	array_push($result, $data);

}
 echo json_encode($result);
?>
