<?php
session_start();
include 'connect.php';
$errors=array();
$data = json_decode(file_get_contents('php://input'), true);
$amount=$data['amount'];
$id=$data['id'];

if (empty($amount)) {
  array_push($errors, "Amount paid is required");
}


if (count($errors)==0) {

    $sql = "INSERT INTO `history`(`client_id`, `products`, `price`, `action`) VALUES ('$id','NaN','$amount', 'Paying Debt')";
        if (mysqli_query($con, $sql)) {
            $getClientdebt = "SELECT * FROM `debts` WHERE client_id='$id'";
            $clientDebt = mysqli_query($con, $getClientdebt);
            $rows = mysqli_fetch_array($clientDebt);
            
            $debtPrice = $rows['price'] - $amount;
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
        else{
            $result['message'] = "Error Occured Try again later";
            echo json_encode($result);
        }
    } 

else {
    echo json_encode($errors);
}
?>