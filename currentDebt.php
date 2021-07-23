<?php

include 'connect.php';
$result = [];
$debt = 0;
$query ="SELECT * FROM debts ";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
    $debt += $rows['price'];
}
$result['debt'] = $debt;
echo json_encode($result);
$con->close();
?>
 