<?php

include 'connect.php';
$query ="SELECT COUNT(*) FROM `debts` WHERE price > 0";
$sql=mysqli_query($con,$query);
$number = mysqli_fetch_array($sql);
$result['clientsWithDebts'] = $number['COUNT(*)'];
echo json_encode($result);
?>
