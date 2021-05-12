<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Admin Panel</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php
    session_start(); 
    if (isset($_SESSION['name'])){
        $name= $_SESSION['name'];
    }  

?> 
<div class="container">
<header> <a href="home.php" style="color: white; text-decoration: none;"><h1>Dhaka Airlines</h1></a> </header> 
<main class="content">
<h1>Welcome <?php echo $name ?></h1>


    <a href="home.php">Home</a>
    <a href="flights.php">Flights</a>
    <a href="bookings.php">Bookings</a>
    <a href="users.php">Users</a>
    <a href="../index.php">Logout</a>
    
    <?php require '../../Controller/Admin/statistics.php'; ?>
    
</main>
</div>
</body>

</html>