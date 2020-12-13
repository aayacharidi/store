<?php
session_start();
require("basic\mysqli_conn.php");
require("basic\loginTest.php");
$message_id = $_REQUEST['message_id'];
$req_status = "block";
$request_query ="update message set status ='$req_status' where message_id = $message_id";

mysqli_query($conn, $request_query) or die ('Error updating database request: '.mysqli_error($conn));
mysqli_close($conn);
header("Location: team_request.php");

?>