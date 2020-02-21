<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Talk2Me</title>
  <style>
    @import url("https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      font-family: "Lexend Deca", sans-serif;
      height: 100%;
    }

    body {
      background: radial-gradient(circle, rgb(174, 197, 207), rgb(118, 135, 166));
    }

    header {
      height: 10%;
      padding: 5vh 5vh;
      box-shadow: 0 3px 5px rgb(57, 63, 72, 0.3);
    }

    a {
      text-decoration: none;
      color: black;
    }

    .header-nav {
      height: 30vh;
      text-align: left;
      vertical-align: middle;
    }

    .logged_in_status {
      float: right;
    }

    a:hover {
      color: white;
    }

    table.center {
      margin-top: 2%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    .content {
      padding: 1%;
      vertical-align: middle;
      border: 1px solid black;
      width: 20vw;
    }

    .posted_text {
      width: 80%;
    }

    .follow-link {
      margin-top: 50px;
      transform: translateX(7.5em);
      float: right;
      padding: 5px;
      border: 1px solid black;
      border-radius: 10px;
    }

    .logo-container {
      width: 100px;
      height: 100px;
      margin-left: 45%;
    }
  </style>
</head>

<body>
  <header>
    <nav>
      <div class="logo-container">
        <img src="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/images/talk2MeLogo.png" alt="talk2me" style="height: 100px; width: 100px;">
      </div>

      <p class="logged_in_status">Logged in as: <?php $user = $this->session->userdata('username'); //Gets the name of the current user who is logged in
                                                echo $user ?>
        <!-- Prints the current user who is logged in -->
      </p>

      <?php
      if (isset($notFollowing)) { ?>
        <a class="follow-link" href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/user/follow/<?php echo $currentUserMessages ?>">
          <!-- if the user is not following the user they are viewing messages off, the follow button is shown -->
          Follow
        </a>
      <?php } ?>


      <a href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/User/view/<?php echo $this->session->username ?>">
        <!-- Gets the name of the current user who is logged in and prints the current user who is logged in -->
        My Messages
      </a>
      <br />

      <a href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/Search">
        Search </a>
      <br />

      <a href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/Message">
        Post a message
      </a>
      <br />

      <a href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/User/feed/<?php echo $this->session->username ?>">
        <!-- Gets the name of the current user who is logged in and prints the current user who is logged in -->
        Followed Messages
      </a>
      <br />

      <a href="http://raptor.kent.ac.uk/proj/co539c/microblog/aaj22/index.php/user/logout">
        Logout
      </a>

    </nav>
  </header>

  <table class="center">
    <tr>
    </tr>

    <?php foreach ($messagesResults as $row) { ?>
      <!-- Loops through all the messages from each user -->
      <tr>
        <td class="content"> <a href="<?php echo base_url() . 'index.php/user/view/' ?><?php echo $row['user_username']; ?>">
            <!-- Clicking this link will take the user to a page where they can see all messages from the User who they clicked on -->
            <?php echo $row['user_username']; ?></a> <!-- Prints the user name -->
          <br />
          <?php echo $row['posted_at']; ?>
          <!-- Prints the time the message was posted -->
        </td>
        <td class="content posted_text">
          <?php echo $row['text']; ?>
          <!-- Prints the message from the user -->
        </td>
      </tr>
    <?php } ?>
  </table>

</html>