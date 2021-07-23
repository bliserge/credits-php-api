<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$product_name = $data['productName'];
$measure_type = $data['measureType'];
$unit_price = $data['unitPrice'];

$query = "INSERT INTO `products`(`product_name`, `measure_type`, `unity_price`) VALUES ('$product_name', '$measure_type', '$unit_price')";
if (mysqli_query($con, $query)) {
    $result['message'] = "Product saved";
    echo json_encode($result);
} else {
    $result['message'] = "Error Occured";
    echo json_encode($result);
}


?>