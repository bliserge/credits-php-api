<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$searchKey = $data['searchKey'];
$result = [];
$query ="SELECT * FROM `products` WHERE product_name like '%$searchKey%'";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $data = array('productName'=> $rows['product_name'],  'unityPrice' => $rows['unity_price']);
	array_push($result, $data);

}
 echo json_encode($result);
?>
