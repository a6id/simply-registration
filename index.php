<?php
    include("backend/database.php");

    $message = ""; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
        $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name  = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $email      = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password   = $_POST["password"];
        $password2  = $_POST["password2"];
        $address    = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
        $postcode   = filter_input(INPUT_POST, "postcode", FILTER_SANITIZE_SPECIAL_CHARS);
        $gender     = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
        $tel        = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);

        
        if ($password !== $password2) {
            $message = "<div class='error'>Passwords do not match. Please try again.</div>";
        }
        elseif (strlen($tel ) !== 11){
            $message = "<div class='error'>Phone Number is Incorrect. Please try again.</div>";
        } 
        else {
            
            $hash = password_hash($password, PASSWORD_DEFAULT);

            
            $sql = "INSERT INTO users (first_name, last_name, email, password, address, postcode, tel, gender)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssssss", $first_name, $last_name, $email, $hash, $address, $postcode, $tel, $gender);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "<div class='success'>You are now registered successfully!</div>";
                    header("Location: login.php");
                } 
                else {
                    $message = "<div class='error' Could not register. Please try again later.</div>";
                }
                mysqli_stmt_close($stmt);
            } 
            else {
                $message = "<div class='error'>Database error: unable to prepare statement.</div>";
            }
        }

        mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
    
    <div class="container">
        <div class="main-container">

            
            <?php if (!empty($message)) echo $message; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1>Register</h1>
                <div class="line" id="line1"></div>

                <div class="row-1">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Second Name" required>
                </div>

                <div class="row-5">
                    <input type="email" name="email" placeholder="Email Address" id="email" required>
                </div>

                <div class="row-2">
                    <input type="password" name="password" placeholder="Password"  required>
                    <input type="password" name="password2" placeholder="Retype Password" required>
                </div>

                <div class="row-3">
                    <input type="text" name="address" placeholder="Street Address" required>
                    <input type="text" name="postcode" placeholder="Postcode" required>
                </div>

                <div class="row-4">
                    <select name="gender" id="gender" required>
                        <option value="" disabled selected hidden>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Unidentified">Unidentified</option>
                    </select>
                    <input type="tel" name="tel" placeholder="Phone Number" required>
                </div>

                <div class="line" id="line2"></div>
                <input type="submit" name="register" value="Register" id="submit-button">
            </form>

            <p>OR</p>
            <button><a href="login.php">Login</a></button>

        </div>
    </div>

</body>
</html>
