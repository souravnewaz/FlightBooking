<?php
include_once '../../Model/db.php';
$id = $_GET['id'];
rejectbooking($id);
header('location: ../../View/Admin/bookings.php');