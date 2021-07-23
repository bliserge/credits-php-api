<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['productId'];
$result = [];
$query ="SELECT * FROM `products` WHERE id='$id'";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $data = array('id' => $rows['id'], 'names'=> $rows['product_name'], 'measure_type' => $rows['measure_type'], 'unity_price' => $rows['unity_price']);
	array_push($result, $data);

}
 echo json_encode($result);
?>
