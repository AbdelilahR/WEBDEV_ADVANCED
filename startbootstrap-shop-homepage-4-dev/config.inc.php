<?php
/*
$servername = "dt5.ehb.be";
$username = "WDA034";
$password = "Test123";
$dbname = "WDA034";
*/
$db_username        = 'WDA034'; //MySql database username
$db_password        = 'Test123'; //MySql dataabse password
$db_name            = 'WDA034'; //MySql database name
$db_host            = 'dt5.ehb.be'; //MySql hostname or IP

$currency			= '&#8377; '; //currency symbol
$shipping_cost		= 1.50; //shipping cost
$taxes				= array( //List your Taxes percent here.
							'VAT' => 12, 
							'Service Tax' => 5,
							'Other Tax' => 10
							);

$mysqli_conn = new mysqli($db_host, $db_username, $db_password,$db_name); //connect to MySql
if ($mysqli_conn->connect_error) {//Output any connection error
    die('Error : ('. $mysqli_conn->connect_errno .') '. $mysqli_conn->connect_error);
}