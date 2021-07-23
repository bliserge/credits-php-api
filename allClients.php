<?php

include 'connect.php';
$result = [];
$query ="SELECT * FROM `clients` ";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $data = array('id' => $rows['id'], 'names'=> $rows['names'], 'phone_number' => $rows['phone_number'], 'id_card' => $rows['id_number']);
	array_push($result, $data);

}
 echo json_encode($result);
?>
