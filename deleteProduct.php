<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['productId'];
$query ="DELETE FROM `products` WHERE id='$id'";
if (mysqli_query($con, $query)) {
    $result['message'] = "Product Deleted";
    echo json_encode($result);
} else {
    $result['message'] = "Error Occured";
    echo json_encode($result);
}

?> 