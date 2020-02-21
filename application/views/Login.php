<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>

  <style>
    @import url("https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap");

    html {
      font-family: "Lexend Deca", sans-serif;
      height: 100%;
    }

    body {
      background: radial-gradient(circle, rgb(174, 197, 207), rgb(118, 135, 166));
    }

    a {
      text-decoration: none;
      color: black;
    }

    .logged_in_status {
      margin-right: 15%;
      float: right;
    }

    a:hover {
      color: white;
    }

    .login-form {
      text-align: center;
      margin-top: 50px;
    }

    .error {
      background-color: rgb(255, 71, 76);
      text-align: center;
      line-height: 25px;
    }

    .logo-container {
      width: 100px;
      height: 100px;
      margin-left: 45%;
    }

    .search-link {
      margin-left: 20%;
      margin-top: 11px;
      float: left;
    }
  </style>
</head>

<body>
  <div class="logo-container">
    <img src="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/images/talk2MeLogo.png" alt="talk2me" style="height: 100px; width: 100px;">
  </div>

  <br />

  <p class="logged_in_status">Not logged in. <a href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/user/login">
      Login
    </a>
  </p>
  <br />

  <?php
  if (isset($error)) {
    echo "<p class='error'>" . ($error) . "</p>"; //If the username and/or password is incorrect, an error is printed
  }
  ?>

  <form class="login-form" action=<?php echo site_url("user/dologin") ?> method="post">
    <!-- Sends the data from the from to the doLogin method via the post method in the User controller -->
    Username:
    <br />
    <input type="text" name="username" value="">
    <br />

    Password:
    <br />
    <input type="password" name="password" value="">
    <br />
    <br />

    <input type="submit" value="Login">
  </form>
</body>

</html>