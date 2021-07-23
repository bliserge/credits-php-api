<?php
session_start();
include 'connect.php';
$username="";
$password="";
$errors=array();
$data = json_decode(file_get_contents('php://input'), true);
$username=$data['username'];
$password=$data['password'];

if (empty($username)) {
  array_push($errors, "Username is required");
}

if (empty($password)) {
  array_push($errors, "Password is required");
}


if (count($errors)==0) {
  $query ="SELECT * FROM admin WHERE names='$username' OR phone_number='$username' AND password='$password'";
  $result=mysqli_query($con,$query);
  $row=mysqli_fetch_array($result);
  if (mysqli_num_rows($result)==1) {
     $data = array('statusCode' => 200, 'message' => 'you are logged in');
     echo json_encode($data);
   }
  else{
    array_push($errors, "Username or Password Is Incorrect");
  }
}
?>