<?php
//get data from form  

$name = $_POST['name'];
$Mobile= $_POST['contact'];
$email= $_POST['emailaddress'];
$Message= $_POST['message'];

$to = "nextinnovation1411@gmail.com";

$subject = "Mail From codeconia";
$txt ="Name = ". $name . "\r\n Mobile number = ". $Mobile. "\r\n Email = " . $email . "\r\n Message =" . $Message;

$headers = "From: shivamsuthae@nextin.info" . "\r\n" .
"CC: ";
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:thankyou.html");
?>









