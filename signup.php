<html>

  <head>
    <title>NSUVMS | Signup </title>
    <link rel="stylesheet" href="./CSS/signup.css">
  </head>


  <body>

    <div class="sign-up-form">
      
      <h2 align="center">NSU Vaccine Management System</h2>
      <p align="center">Fill up the form to create account</p>
      <hr>
      <p class="error">Signup failed!</p>
      <form>
        <input type="text" class="input-box" placeholder="Your Full Name">
        <p class="form-error">Please enter your full name</p>

        <input type="number" class="input-box" placeholder="Your NSU ID">
        <p class="form-error">Please enter a valid NSU ID</p>

        <input type="email" class="input-box" placeholder="Your NSU Email">
        <p class="form-error">Please enter a valid NSU email</p>

        <input type="Password" class="input-box" placeholder="Your Password">
        <p class="form-error">Password length must be minimum 12 character and should contain atleast one character and one number</p>

        <input type="password" class="input-box" placeholder="Confirm Your Password">
        <p class="form-error">Password doesn't match</p>

        <button type="button" class="signup-btn"> Sign up</button>
        <hr>

        <p>Already have an account?<a href="index.php">Login!</a></p>
      </form>
    </div>
  </body>



</html>