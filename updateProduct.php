<?php 
include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$result = [];
$productId = $data['productId'];
$productName = $data['productName'];
$measureType = $data['measureType'];
$unitPrice = $data['unitPrice'];

$query = "UPDATE `products` SET product_name='$productName', measure_type='$measureType', unity_price='$unitPrice' WHERE id=$productId";
if (mysqli_query($con, $query)) {
    $result['message'] = "Product updated";
    echo json_encode($result);
}
else {
    $result['message'] = "Error Occured";
    echo json_encode($result);
}
?>