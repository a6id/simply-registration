<?php

    include("database.php")

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
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" >

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
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password2" placeholder="Retype Password">
                </div>
                
                <div class="row-3">
                    <input type="text" name="address" placeholder="Street Address" required>
                    <input type="text" name="postcode" placeholder="Postcode" required>           
                </div>

                <div class="row-4">
                    <select name="gender" id="gender" value="Gender"  required>
                        <option value="gender" disabled selected hidden>Gender</option>
                        <option value="Male">Male</option>
                        <option value="female">Female</option>
                        <option value="unidentified">Unidentified</option>
                    </select>
                    <input type="tel" name="tel" placeholder="Phone Number"  required>
                </div>
                <div class="line" id="line2"></div>
            
                <input type="submit" name="register" value="Register" id="submit-button">
            </form>
            <p>OR</p>
            <button>
                <a href="login.php">Login</a>
            </button>
        </div>
    </div>

</body>
</html>

<?php
    
    $password = $_POST["password"];
    $password2 = $_POST["password2"];


    if($password != $password2){
        echo"error";
        
    }
    else{
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
            $postcode = filter_input(INPUT_POST, "postcode", FILTER_SANITIZE_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
            $tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (first_name, last_name, email, password, address, postcode, tel, gender) 
                                        VALUES ('$first_name', '$last_name', '$email', '$hash', '$address','$postcode', '$tel' , '$gender' )";
                                        mysqli_query($conn, $sql);
                                        echo"you are now registered";
        }
    }


    mysqli_close($conn);
?>
