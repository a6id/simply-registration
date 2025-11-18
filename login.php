<?php



include("backend/database.php");
session_start();

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
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            header("Location: dashboard.php");
            
            exit;
        } else {
            $message = "<div class='error'>Incorrect email or password. Please try again.</div>";
        }
    } else {
        $message = "<div class='error'>Incorrect email or password. Please try again.</div>";
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
            <?php if (!empty($message)) echo $message; ?>
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


