<?php

include 'connect.php';
$result = [];
$debt = 0;
$query ="SELECT * FROM history ";
$sql=mysqli_query($con,$query);
while ($rows=mysqli_fetch_array($sql))  {
	if ($rows['action'] == "Paying Debt") {
        continue;
    } else {
        $debt += $rows['price'];
    }
}
$result['debt'] = $debt;
echo json_encode($result);
$con->close();
?>
 