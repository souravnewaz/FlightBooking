<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../css/forms.css">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>
<body>
<div class="wrapper">
        <section class="form login">
            <header>Signup</header>
            <form action="#" method="POST">
                <div class="error">Error message</div>

                <div class="field input">
                    <label>Username</label>
                    <input type="text" name= "name" placeholder="Your username">
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name= "email" placeholder="Your email">
                </div>
                <div class="field input">
                    <label>Phone</label>
                    <input type="text" name= "phone" placeholder="Your phone">
                </div>
                <div class="field input">
                    <label>Address</label>
                    <input type="text" name= "address" placeholder="Your address">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Your password">
                </div>
                <div class="field input">
                    <label>Confirm Password</label>
                    <input type="password" name="password2" placeholder="Password again">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Signup">
                </div>
                <div class="link">Already Registered? <a href="login.php">Login</a></div>
                
            </form>
            <?php require "../controller/signupController.php"; ?>
        </section>
    </div>
</body>
</html>