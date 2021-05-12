<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/forms.css">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Login</header>
            <form action="#" method="POST">
                <div class="error">Error message</div>

                <div class="field input">
                    <label>Username</label>
                    <input type="text" name= "name" placeholder="Your username">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Your password">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Login">
                </div>
                <div class="link">New here? <a href="index.php">Sign up</a></div>
            </form>
            <?php require "../controller/loginController.php"; ?>
        </section>
    </div>
    
</body>
</html>