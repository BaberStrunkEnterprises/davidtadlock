<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$name = isset($_POST['name'])?htmlspecialchars($_POST['name'], ENT_QUOTES):null;
$email = isset($_POST['email'])?$_POST['email']:null;
$phone = isset($_POST['phone'])?htmlspecialchars($_POST['phone'], ENT_QUOTES):null;
$subject = isset($_POST['subject'])?htmlspecialchars($_POST['subject'], ENT_QUOTES):null;
$message = isset($_POST['message'])?htmlspecialchars($_POST['message'],ENT_QUOTES):null;

if(empty($name)) {
	echo 100; // name required
	return;
}
if(empty($email)) {
	echo 101; // email required
	return;
}
if(empty($subject)) {
	echo 102; // subject required
	return;
}
if(empty($message)) {
	echo 103; // message required
	return;
}

if(!preg_match('/\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/', $email)) {
	echo 104; // invalid email address
	return;
}

if(!empty($phone) && !preg_match('/^[\\(]{0,1}([0-9]){3}[\\)]{0,1}[ ]?([^0-1]){1}([0-9]){2}[ ]?[-]?[ ]?([0-9]){4}[ ]*((x){0,1}([0-9]){1,5}){0,1}$/',$phone)) {
	echo 105; // invalid phone number
	return;
}

$message .= "\n\n$name ($email) \n $phone";

//$check = true;
$check = mail('tadlockdavid@yahoo.com', '[Website] '.$subject , $message, "From: ".$email );

if($check) {
	echo 200; // email sent
}
else {
	echo 106; // email not sent
}
return;
