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
      <p id="error" class="error">Signup failed!</p>
      <form>
        <input id="nameInput" type="text" class="input-box" placeholder="Your Full Name">
        <p id="nameError" class="form-error">Please enter your full name</p>

        <input id="idInput" type="number" class="input-box" placeholder="Your NSU ID">
        <p id="idError" class="form-error">Please enter a valid NSU ID</p>

        <input id="emailInput" type="email" class="input-box" placeholder="Your NSU Email">
        <p id="emailError" class="form-error">Please enter a valid NSU email</p>

        <input id="nidInput" type="number" class="input-box" placeholder="Your NID">
        <input id="bidInput" type="number" class="input-box" placeholder="Your Birth Certificate ID">
        <p id="nidBidError" class="form-error">You have to provide your NID or Your Birth Certificate</p>

        <input id="passwordInput" type="Password" class="input-box" placeholder="Your Password">
        <p id="passwordError" class="form-error">Password length must be minimum 8 character and should contain atleast one character and one number</p>

        <input id="confirmPasswordInput" type="password" class="input-box" placeholder="Confirm Your Password">
        <p id="confirmPasswordError" class="form-error">Password doesn't match</p>

        <div>        
          <label for="gender">Gender:</label>
          <select name="gender" id="gender">
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
          </select>
          <label for="dept">Department:</label>
          <select name="dept" id="dept">          
          </select>
        </div>
        <div>
          <label for="usertype">You are a:</label>
          <select name="usertype" id="usertype">
            <option value="student">Student</option>
            <option value="faculty-member">Faculty-member</option>
          </select>
        </div>
        <button id="signUpButton" type="button" class="signup-btn"> Sign up</button>
        <hr>

        <p>Already have an account?<a href="index.php">Login!</a></p>
      </form>
    </div>

    <script src="./JS/signup.js"></script>

  </body>

</html>