<?php

session_start()
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginPage</title>
</head>


<body>
    <div class="wrapper">
<form method="post" action="loging.php">
    <h1> GET STARTED!!! </h1>

    <div class="input-box">

        <input type="text" id="user_name" name="user_name" placeholder="user_name" value="">
        <i class="bx bxs-user"></i>
        <p style="color: pink; font-size: 0.8rem;"><?php echo isset($_SESSION['error_loging']['user_name'])?> 
    </div>


    <div class="input-box">
        <input type="password" id="password" name="password" placeholder="password" value="">
        <i class='bx bxs-lock-alt'></i> 
        <p style="color: pink; font-size: 0.8rem;"><?php echo isset($_SESSION['error_loging']['password'])?>
</div>


<div class='remember-forgot'>
    <label><input type="checkbox"/> remember me </label>
    <a href="#"> forgot password </a> <br>
        <br><button type="submit" class="btn">loging </button>
</div>


<div class="register-link">
    
        <p> YOU DON'T HAVE AN ACCOUNT? <a href="./signUp.php">signUp</a></p>
</div>
</div>
</body>

</form>
</html>



        







</body>
</html>