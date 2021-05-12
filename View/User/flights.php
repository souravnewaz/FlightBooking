<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights | User</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
<header> <a href="home.php" style="color: white; text-decoration: none;"><h1>Dhaka Airlines</h1></a> </header> 
<main class="content">
    
    <a href="home.php">Home</a>
    <a href="flights.php">Flights</a>
    <a href="bookings.php">Bookings</a>
    <a href="profile.php">Profile</a>
    <a href="../../logout.php">Logout</a>
    
    
    <table>
        <?php  include '../../Controller/User/flightView.php'; ?>
    </table>
    
        
</main>
</div>
<?php
    //session_start();
   // $name= $_SESSION['name'];
   //$_SESSION['name']= htmlentities( $_POST['name']);
    //$n = $_SESSION['name'];
?>

  
    
    
</body>
</html>