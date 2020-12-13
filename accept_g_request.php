<?php
session_start();
require("basic\mysqli_conn.php");
require("basic\loginTest.php");
$message_id = $_REQUEST['message_id'];
$req_query = "select sender_id,game_id,sender_id from message where message_id = $message_id";
$req = mysqli_query($conn, $req_query) or die ('Error updating database req: '.mysqli_error($conn));
$req= mysqli_fetch_array($req);
$guest_id = $req[0];
$game_id = $req[1];
$sender_id=$req[2];
$type = "notification";
$msg = "The Team has accepted your request for the game";

$req_status = "accept";
$request_query ="update message set status ='$req_status' where message_id = $message_id";
$game_query = "update game set team_guest_id = $guest_id where game_id = $game_id";
$send_query="insert into message (sender_id,receiver_id,type,message,date,status) value(0,$sender_id,'$type','$msg',now(),'new')";

mysqli_query($conn,$request_query) or die ('Error updating database request: '.mysqli_error($conn));
mysqli_query($conn,$game_query) or die ('Error updating database game: '.mysqli_error($conn));
mysqli_query($conn,$send_query) or die ('Error updating database send: '.mysqli_error($conn));
mysqli_close($conn);
header("Location: game_request.php");

?>