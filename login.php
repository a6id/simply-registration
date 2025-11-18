<?php


include("backend/database.php");
$message = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
 
    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
 
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
 
        
        if (password_verify($password, $user['password'])) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }
 
    $stmt->close();
    mysqli_close($conn);
}

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
            <form action="login.php" method="POST" >

                <h1>Login</h1>
                <div class="line" id="line1"></div>

                <div class="row-1">
                    <input type="email" name="email" placeholder="Email Address" id="email" required>

                </div>
                
                <div class="row-2">
                    <input type="password" name="password" placeholder="Password" id="password" required>
                </div>
                
            

                
                <div class="line" id="line2"></div>
            
                <input type="submit" name="login" value="Login" id="submit-button">
            </form>
            <p>OR</p>
            <button>
                <a href="index.php">
                    Register
                </a>
            </button>
        </div>
    </div>

</body>
</html>


