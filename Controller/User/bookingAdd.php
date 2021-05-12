<?php
include_once '../../Model/db.php';
header('location: ../../View/User/flights.php');
$fid = $_GET['fid'];
bookingAdd($fid,'Economy');

