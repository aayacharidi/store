<?php
session_start();
require("basic\mysqli_conn.php");
require("basic\loginTest.php");
$message_id = $_REQUEST['message_id'];
$request=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM message where message_id = $message_id"));

$mess_id = $request['message_id'];
$sender_id = $request['sender_id'];
$receiver_id = $request['receiver_id'];
$req_status = "accept";
$mess_status = "cancel";
$type = "notification";
$msg = "The Team has accepted your request";
$user_query ="update user set team_id = $receiver_id where user_id = $sender_id";
$team_query ="update team set players_number = players_number+1 where team_id = $receiver_id";
$request_query ="update message set status ='$req_status' where message_id = $mess_id";
$message_query ="update message set status ='$mess_status' where sender_id = $sender_id and status = 'new' and type = 'join team request'";
$send_query="insert into message (sender_id,receiver_id,type,message,date,status) value(0,$sender_id,'$type','$msg',now(),'new')";

mysqli_query($conn, $user_query) or die ('Error updating database user: '.mysqli_error($conn));
mysqli_query($conn, $team_query) or die ('Error updating database team: '.mysqli_error($conn));
mysqli_query($conn, $request_query) or die ('Error updating database request: '.mysqli_error($conn));
mysqli_query($conn, $send_query) or die ('Error updating database send: '.mysqli_error($conn));
mysqli_query($conn, $message_query) or die ('Error updating database message: '.mysqli_error($conn));
mysqli_close($conn);
header("Location: team_request.php");

?>