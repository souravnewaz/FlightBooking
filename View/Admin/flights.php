<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights | Admin Panel</title>
    <link rel="stylesheet" href="../../css/style.css">
    
</head>
<body>

<div class="container">
<header> <a href="home.php" style="color: white; text-decoration: none;"><h1>Dhaka Airlines</h1></a> </header> 
<main class="content">
    
    <a href="home.php">Home</a>
    <a href="flights.php">Flights</a>
    <a href="bookings.php">Bookings</a>
    <a href="users.php">Users</a>
    <a href="../index.php">Logout</a>
    
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        <br><br><input type="text" name="takeoff" placeholder="Takeoff"><br><br>
        <input type="text" name="landing" placeholder="Landing"><br><br>
        <input type="date" name="departure" id = "departure"><br><br>
        <input type="submit" name="submit" value="Add New Flight">
    </form>
    <?php  require '../../Controller/Admin/flightAdd.php';  ?>
    <h3>Our Flights</h3>
    <table>
    <?php  require '../../Controller/Admin/flightView.php';        ?>
    </table>
    
    
    
            
     
</main>
</div>
    
    
</body>
</html>