<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Admin Panel</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
<header> <a href="home.php" style="color: white; text-decoration: none;"><h1>Dhaka Airlines</h1></a> </header> 
<main class="content">
    
    <a href="home.php">Home</a>
    <a href="flights.php">Flights</a>
    <a href="bookings.php">Bookings</a>
    <a href="#">Users</a>
    <a href="../index.php">Logout</a>
    
    <h3>Our Registered Users</h3>
    <table>
    <?php include '../../Controller/Admin/userShow.php'; ?>
    </table>
    
</main>
</div>

    
    
</body>
</html>