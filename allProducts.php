<?php

include 'connect.php';
$result = [];
$query ="SELECT * FROM `products`";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $data = array('id' => $rows['id'], 'names'=> $rows['product_name'], 'measure_type' => $rows['measure_type'], 'unity_price' => $rows['unity_price']);
	array_push($result, $data);

}
echo json_encode($result);
?>
