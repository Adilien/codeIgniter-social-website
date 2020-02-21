<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>

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
            vertical-align: middle;
            float: right;
        }

        a:hover {
            color: white;
        }

        .follow-link {
            padding: 5px;
            border: 1px solid black;
            border-radius: 10px;
            float: right;
        }

        .post-form {
            text-align: center;
            margin-top: 50px;
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

    <form class="post-form" action=<?php echo site_url("Message/doPost") ?> method="post">
        <!-- Sends the data from the from to the doPost method via the post method in the Message controller -->
        Type your message here:
        <br />
        <br />
        <textarea name="message" width="150"></textarea>
        <br />
        <br />
        <input type="submit" value="Post Message">
    </form>