<?php
include_once '../../Model/db.php';
$id = $_GET['id'];
header('location: ../../View/Admin/flights.php');
deleteFlight($id);

?>