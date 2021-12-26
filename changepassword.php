<?php

    session_start();
            
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }

?>


<html>

    <head>
        <title>NSUVMS | Change Password</title>
        <link rel="stylesheet" href="./CSS/changepassword.css"> 
    </head>

    <body>
        <ul>
            <li class="right-li"><a id="logout">Logout</a></li>     
            <li class="right-li"><a href="profile.php">Home</a></li>       
        </ul>

        <input type="hidden" id="userType" value="<?php print($_SESSION['userType']);?>">
        <div class="changepassword-form">
            <p>Update Password</p>
            <p id="error" class="error">Password change failed!</p>
            <hr>
            <p id="error" class="error">Signup failed!</p>
            <form>
                <input id="oldPassword" type="password" class="input-box" placeholder="Enter your old password">
                <p id="oldPasswordError" class="form-error">Please enter your your old password</p>

                <input id="newPassword" type="password" class="input-box" placeholder="Enter your new password">
                <p id="newPasswordError" class="form-error">Password length must be 8-10 character and should contain atleast one character and one number</p>

                <button id="updatePasswordButton" type="button" class="signup-btn">Update Password</button>
            </form>
        </div>
        
        <script src="./JS/changepassword.js"></script>
        
    </body>
</html>