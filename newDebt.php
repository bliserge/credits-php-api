<?php
session_start();
include 'connect.php';
$errors=array();
$data = json_decode(file_get_contents('php://input'), true);
$names=$data['names'];
$phone=$data['phone'];
$products=$data['products'];
$price=$data['price'];
$id_number=$data['id_number'];

if (empty($names)) {
  array_push($errors, "Client names  required");
}

if (empty($phone)) {
  array_push($errors, "client phone number is required");
}
if (empty($products)) {
    array_push($errors, "Products taken are required");
}
if (empty($price)) {
    array_push($errors, "Total price of products taken is required");
}
if (empty($id_number)) {
array_push($errors, "Client's ID Card number is required");
}

if (count($errors)==0) {
    $getClient = "SELECT * FROM `clients` WHERE id_number='$id_number' AND phone_number='$phone'";
    $client = mysqli_query($con, $getClient);
    $rows = mysqli_fetch_array($client);
    if (mysqli_num_rows($client) == 1) {
        $id = $rows['id'];

        $sql = "INSERT INTO `history`(`client_id`, `products`, `price`, `action`) VALUES ('$id','$products','$price', 'Taking Debt')";

        if (mysqli_query($con, $sql)) {
            $getClientdebt = "SELECT * FROM `debts` WHERE client_id='$id'";
            $clientDebt = mysqli_query($con, $getClientdebt);
            $rows = mysqli_fetch_array($clientDebt);

            if (mysqli_num_rows($clientDebt) == 1) {

                $debtPrice = $rows['price'] + $price;
                $debt = "UPDATE `debts` SET `price`= $debtPrice WHERE client_id='$id'";
                if (mysqli_query($con, $debt)) {
                    $result['message'] = "Debt updated recorded";
                    echo json_encode($result);
                }
                else{
                    $result['message'] = "debt got error";
                    echo json_encode($result);
                }
            }
            else {
                $sql = "INSERT INTO `debts`(`client_id`, `price`) VALUES ('$id', '$price')";

                if (mysqli_query($con, $sql)) {
                    $result['message'] = "Debt successfully recorded";
                    echo json_encode($result);
                }
                else{
                    $result['message'] = "Error Occured Try again later";
                    echo json_encode($result);
                }
            }
        }
        else{
            $result['message'] = "Error Occured Try again later";
            echo json_encode($result);
        }
    } else {
        $sql = "INSERT INTO `clients`(`names`, `phone_number`, `id_number`) VALUES ('$names','$phone','$id_number')";

        if (mysqli_query($con, $sql)) {
            $getClient = "SELECT * FROM `clients` WHERE id_number='$id_number' AND phone_number='$phone'";
            $client = mysqli_query($con, $getClient);
            $rows = mysqli_fetch_array($client);
            $id = $rows['id'];

            $sql = "INSERT INTO `history`(`client_id`, `products`, `price`, `action`) VALUES ('$id','$products','$price', 'Taking Debt')";

            if (mysqli_query($con, $sql)) {
                $sql = "INSERT INTO `debts`(`client_id`, `price`) VALUES ('$id', '$price')";

                if (mysqli_query($con, $sql)) {
                    $result['message'] = "Debt successfully recorded";
                    echo json_encode($result);
                }
                else{
                    $result['message'] = "Error Occured Try again later";
                    echo json_encode($result);
                }
            }
            else{
                $result['message'] = "Error Occured Try again later";
                echo json_encode($result);
            }
        }

        else{
            $result['message'] = "Error Occured Try again later";
            echo json_encode($result);
        }
    }
    
    
}

else {
    echo json_encode($errors);
}
?>