<?php
include_once '../../Model/db.php';
$id = $_GET['id'];
approvebooking($id);
header('location: ../../View/Admin/bookings.php');