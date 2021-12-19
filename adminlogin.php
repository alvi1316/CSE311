<html>

  <head>
    <title>NSUVMS | Admin Login</title>
    <link rel="stylesheet" href="./CSS/index.css">
  </head>

  <body>
    <div class="sign-in-form">
      <h2 align="center">NSU Vaccine Management System<h2>
      <hr>
      <p id="error" class="error">Wrong id or password!</p>
      <form id="signInForm">
        <input onblur="validateId()" id="idInput" name="id" type="number" class="input-box" placeholder="Your ID">
        <p id="idError" class="form-error">Please enter a ID</p>
        <input onblur="validatePassword()" id="passwordInput" name="password" type="Password" class="input-box" placeholder="Your Password">
        <p id="passwordError" class="form-error">Please enter a password</p>
        <button type="submit" class="signin-btn">Sign in</button>
      </form>
      <hr>
    </div>

    <script src="./JS/adminlogin.js"></script>
  </body>
</html>