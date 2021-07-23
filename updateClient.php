<?php

include 'connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$names = $data['names'];
$phone = $data['phone'];
$id_number = $data['id_number'];


$query ="UPDATE `clients` SET `names`='$names', `phone_number`='$phone', `id_number`='$id_number' WHERE id='$id'";
if (mysqli_query($con, $query)) {
    $result['message'] = "Client have been updated successfully";
    echo json_encode($result);
} else {
    $result['message'] = "Error Occured";
    echo json_encode($result);
}

?>
