<?php
    date_default_timezone_set("Europe/London");
    $time = date("H:i"); 

    include("backend/database.php");
    session_start();

    if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    
    <div class="main-container">
        <!-- <div class="container-2">
            <div class="empty">
                
            </div>
        </div> -->
        <div class="container">
            <div class="row-1">
                <div class="welcome">
                    <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9 1h1v1H9zm0 1v1H8v2H7v3H2V7h1V5h1V4h1V3h2V2zm4 0h1v2h1v2h1v2H8V6h1V4h1V2h1V1h2zm1-1h1v1h-1zm8 6v1h-5V5h-1V3h-1V2h2v1h2v1h1v1h1v2zm-5 3v4h-1v1H8v-1H7v-4h1V9h8v1zM1 9h6v1H6v4h1v1H1zm22 0v6h-6v-1h1v-4h-1V9zm-1 7v1h-1v2h-1v1h-1v1h-2v1h-2v-1h1v-2h1v-3zM9 22h1v1H9zm0-1v1H7v-1H5v-1H4v-1H3v-2H2v-1h5v3h1v2zm5 1h1v1h-1zm0 0h-1v1h-2v-1h-1v-2H9v-2H8v-2h8v2h-1v2h-1z"/>
                        </svg>

                        Hello <span>
                            <?php echo $_SESSION['first_name']; ?>
                            </span>, Welcome Back
                    </h2>
                </div>
                <div class="date">
                    <?php echo date("M d"); ?>
                </div>
                <div id="time">
                    <?php date_default_timezone_set("Europe/London");?>
                </div>
            </div>
            <div class="row-2">

            </div>
            <div class="row-3">

            </div>
        </div>
        
    </div>
<script src="app.js"></script>
</body>

</html>

