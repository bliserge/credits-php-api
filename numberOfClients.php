<?php

include 'connect.php';
$query ="SELECT COUNT(*) FROM `clients`";
$sql=mysqli_query($con,$query);
$number = mysqli_fetch_array($sql);
$result['clientsNumber'] = $number['COUNT(*)'];
echo json_encode($result);
?>
