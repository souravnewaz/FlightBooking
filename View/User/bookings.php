<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
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
    <h3>My Bookings</h3>
    <table>
        <?php  require '../../Controller/User/bookingView.php'; ?>
    </table>
    
</main>
</div>

    
</body>
</html>