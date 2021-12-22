<html>

  <head>
    <title>NSUVMS | Login</title>
    <link rel="stylesheet" href="./CSS/index.css">
  </head>

  <body>
    <div class="sign-in-form">

      <h2 align="center">NSU Vaccine Management System</h2>
      <hr>
      <p id="error" class="error">Wrong id or password!</p>
      <form>
        <input onblur="validateId()" id="idInput" name="id" type="text" class="input-box" placeholder="Your NSU ID">
        <p id="idError" class="form-error">Please enter a valid NSU ID</p>
        <input onblur="validatePassword()" id="passwordInput" name="password" type="Password" class="input-box" placeholder="Your Password">
        <p id="passwordError" class="form-error">Please enter a password</p>

        <div>
          <label for="usertype">You are a:</label>
          <select name="usertype" id="usertype">
            <option value="student">Student</option>
            <option value="faculty-member">Faculty-member</option>
          </select>
        </div>

        <button id="signIn" type="button" class="signin-btn">Sign in</button>
      </form>
      <hr>
      <p><a href="forgotpassword.php">Forgot Password?</a></p>
      <p>Don't have an account?<a href="signup.php">Signup!</a></p>
    </div>

    <script src="./JS/index.js"></script>
    
  </body>

</html>