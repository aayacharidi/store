<?php
session_start();

require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
$ava_query = mysqli_query($conn,"
	select TIME_FORMAT( Mon_from , '%h:%i %p' ) Mon_from 
	, TIME_FORMAT( Mon_to , '%h:%i %p' ) Mon_to
	, TIME_FORMAT( Tue_from , '%h:%i %p' ) Tue_from
	, TIME_FORMAT( Tue_to , '%h:%i %p' ) Tue_to
	, TIME_FORMAT( Wed_from , '%h:%i %p' ) Wed_from
	, TIME_FORMAT( Wed_to , '%h:%i %p' ) Wed_to
	, TIME_FORMAT( Thur_from , '%h:%i %p' ) Thur_from
	, TIME_FORMAT( Thur_to , '%h:%i %p' ) Thur_to
	, TIME_FORMAT( Fri_from , '%h:%i %p' ) Fri_from
	, TIME_FORMAT( Fri_to , '%h:%i %p' ) Fri_to
	, TIME_FORMAT( Sat_from , '%h:%i %p' ) Sat_from
	, TIME_FORMAT( Sat_to , '%h:%i %p' ) Sat_to
	, TIME_FORMAT( Sun_from , '%h:%i %p' ) Sun_from
	, TIME_FORMAT( Sun_to , '%h:%i %p' ) Sun_to
	, renew_data , user_id from available where user_id = $user_id
	");

if($ava_query <> '')
	$ava = mysqli_fetch_array($ava_query);
else
	$ava = array_fill(0,17,'');
$mon_from=$_REQUEST['mon_from'] ;
if($mon_from != $ava[0]){
	if($mon_from != '')
		$monf_query = "update available set Mon_from = '$mon_from' where user_id = $user_id";
	else
		$monf_query = "update available set Mon_from = null where user_id = $user_id";	
	mysqli_query($conn,$monf_query);
}

$mon_to=$_REQUEST['mon_to'];
if($mon_to != $ava[1]){	
	if($mon_to != '')
		$mont_query = "update available set Mon_to = '$mon_to' where user_id = $user_id";
	else
		$mont_query = "update available set Mon_to = null where user_id = $user_id";
	mysqli_query($conn,$mont_query);
}

$tue_from=$_REQUEST['tue_from'];
if($tue_from != $ava[2]){
	if($tue_from != '')
		$tuef_query = "update available set Tue_from = '$tue_from' where user_id = $user_id";
	else
		$tuef_query = "update available set Tue_from = null where user_id = $user_id";
	mysqli_query($conn,$tuef_query);
}

$tue_to=$_REQUEST['tue_to'];
if($tue_to != $ava[3]){
	if($tue_to != '')
		$tuet_query = "update available set Tue_to = '$tue_to' where user_id = $user_id";
	else
		$tuet_query = "update available set Tue_to = null where user_id = $user_id";
	mysqli_query($conn,$tuet_query);

}

$wed_from=$_REQUEST['wed_from'];
if($wed_from != $ava[4]){
	if($wed_from != '')
		$wedf_query = "update available set Wed_from = '$wed_from' where user_id = $user_id";
	else	
		$wedf_query = "update available set Wed_from = null where user_id = $user_id";
	mysqli_query($conn,$wedf_query);
}
$wed_to=$_REQUEST['wed_to'];
if($wed_to != $ava[5]){
	if($wed_to != '')
	$wedt_query = "update available set Wed_to = '$wed_to' where user_id = $user_id";
	else
		$wedt_query = "update available set Wed_to = null where user_id = $user_id";
	mysqli_query($conn,$wedt_query);
}	

$thur_from=$_REQUEST['thur_from'];
if($thur_from != $ava[6]){
	if($thur_from != '')
		$thurf_query = "update available set Thur_from = '$thur_from' where user_id = $user_id";
	else
		$thurf_query = "update available set Thur_from = null where user_id = $user_id";
	mysqli_query($conn,$thurf_query);
}
$thur_to=$_REQUEST['thur_to'];
if($thur_to != $ava[7]){
	if($thur_to != '')
		$thurt_query = "update available set Thur_to = '$thur_to' where user_id = $user_id";
	else
		$thurt_query = "update available set Thur_to = null where user_id = $user_id";
	mysqli_query($conn,$thurt_query);
}	

$fri_from=$_REQUEST['fri_from'];
if($fri_from != $ava[8]){
	if($fri_from != '')
		$frif_query = "update available set Fri_from = '$fri_from' where user_id = $user_id";
	else
		$frif_query = "update available set Fri_from = null where user_id = $user_id";
	mysqli_query($conn,$frif_query);
}
$fri_to=$_REQUEST['fri_to'];
if($fri_to != $ava[9]){
	if($fri_to != '')
		$frit_query = "update available set Fri_to = '$fri_to' where user_id = $user_id";
	else
		$frit_query = "update available set Fri_to = null where user_id = $user_id";
	mysqli_query($conn,$frit_query);
}	

$sat_from=$_REQUEST['sat_from'];
if($sat_from != $ava[10]){
	if($sat_from != '')
		$satf_query = "update available set Sat_from = '$sat_from' where user_id = $user_id";
	else
		$satf_query = "update available set Sat_from = null where user_id = $user_id";
	mysqli_query($conn,$satf_query);
}
$sat_to=$_REQUEST['sat_to'];
if($sat_to != $ava[11]){
	if($sat_to != '')
		$satt_query = "update available set Sat_to = '$sat_to' where user_id = $user_id";	
	else
		$satt_query = "update available set Sat_to = null where user_id = $user_id";
	mysqli_query($conn,$satt_query);
}

$sun_from=$_REQUEST['sun_from'];
if($sun_from != $ava[12]){
	if($sun_from != '')
		$sunf_query = "update available set Sun_from = '$sun_from' where user_id = $user_id";
	else
		$sunf_query = "update available set Sun_from = null where user_id = $user_id";
	mysqli_query($conn,$sunf_query);
}
$sun_to=$_REQUEST['sun_to'];
if($sun_to != $ava[13]){
	if($sun_to != '')
		$sunt_query = "update available set Sun_to = '$sun_to' where user_id = $user_id";
	else
		$sunt_query = "update available set Sun_to = null where user_id = $user_id";
	mysqli_query($conn,$sunt_query);
}

mysqli_close($conn);
header("location: availability.php");

?>