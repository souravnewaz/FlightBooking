<?php 
include_once '../../Model/db.php';
$id = $_GET['id'];
deleteUsers($id);
header('location: ../../View/Admin/users.php');