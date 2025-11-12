<?php

    include("database.php")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    
    <div class="container">
        <div class="main-container">
            <form action="index.php" method="POST" >

                <h1>Login</h1>
                <div class="line" id="line1"></div>

                <div class="row-1">
                    <input type="email" name="email" placeholder="Email Address" id="email" required>

                </div>
                
                <div class="row-2">
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    
                </div>
                
            

                
                <div class="line" id="line2"></div>
            
                <input type="submit" name="register" value="Login" id="submit-button">
            </form>
            <p>OR</p>
            <button>
                <a href="index.php">Register</a>
            </button>
        </div>
    </div>

</body>
</html>


