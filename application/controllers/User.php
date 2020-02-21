<?php

defined('BASEPATH') or exit('No direct script access allowed'); //defined checks if a given name exists. BASEPATH contains path to the system folder.  exit() prints the set string and terminates execution

class User extends CI_Controller
{
    public function view($name = null) //takes a name as a parameter which is set as null initially
    {
        $this->load->model("Messages_model"); //loads the Messages_model
        $this->load->model("Users_model"); //loads the Users_model
        $messagesData = $this->Messages_model->getMessagesByPoster($name); //calls the getMessagesByPoster method from Messages_model and sends in the name taken
        $currentUser = $this->session->userdata('username'); // gets the current name of the user who is logged in 

        if ($name == null) {
            redirect(base_url() . "index.php/User/login"); //if name is null, redirect to login
        }

        $followData = $this->Users_model->isFollowing($this->session->userdata('username'), $name); //checks to see if the current user is following the user they are viewing messages off

        //if name is not null
        if ($currentUser == $name) {
            $messagesData = array("messagesResults" => $messagesData,); //if the logged in user has the same name as the name taken in, the data from the getMessagesByPoster method is taken and inserted in into an array
            $this->load->view('ViewMessages', $messagesData); //loads the ViewMessages view and sends the data
        } else if ($followData) {
            $messagesData = array("messagesResults" => $messagesData,); // if the method isFollowing returns true indicating that the current user follows the user name taken in, the data from the getMessagesByPoster method is taken and inserted in into an array
            $this->load->view('ViewMessages', $messagesData); //loads the ViewMessages view and sends the data
        } else if (!$followData) {
            $messagesData = array("messagesResults" => $messagesData, "notFollowing" => true, "currentUserMessages" => $name); //if these conditions are not true, the data from the getMessagesByPoster method is taken and inserted in into an array and notFollowing variable is set to true indicating that the user does not follow the user
            $this->load->view('ViewMessages', $messagesData); //loads the ViewMessages view and sends the data

        }
    }

    public function login()
    {
        $this->load->view('Login'); //loads the login view
    }

    public function doLogin()
    {
        $user = $this->input->post("username"); //saves the username from the form into $user
        $pass = sha1($this->input->post("password")); //gets the password sent in the from and hashes it before saving it in $pass

        $this->load->library('session'); //loads the session
        $this->load->model("Users_model"); //loads the Users_model

        $userData = $this->Users_model->checkLogin($user, $pass); //sends the $user and $pass to the checkLogin method in Users_model

        if ($userData) {
            $userData = array('username' => $user); //if the checkLogin method returns true, the username is inserted in an array and saved in $userData variable
            $this->session->set_userdata($userData); //sets the data of the user to the $userData which has the username 
            redirect(base_url() . "index.php/User/view/" . $user); //redirect to where all of that user messages are
        } else {
            $this->load->view('Login', array('error' => "Username and/or password Incorrect.")); // loads the login page and sends an array which has an error message indicating that Username and/or password is/are Incorrect
        }
    }

    public function logout()
    {
        $_SESSION["username"] = null; //sets the current session to null
        $this->load->library("session"); //loads the session
        $this->session->unset_userdata(array("username" => "")); //unset the user data from the session and sets the name of username to empty
        $this->session->sess_destroy(); //destroys the session
        redirect(base_url() . "index.php/User/login"); //redirects the user to the login page
    }

    public function follow($followed) //takes in the user who is followed
    {
        $this->load->model("Users_model"); // loads the Users_model
        $this->Users_model->follow($followed); // calls the follow method in Users_method to execute the follow command
        redirect(base_url() . "index.php/User/view/" . $followed); //redirects to all messages of the user who is followed
    }

    public function feed($name = null) //takes in the name of the user
    {
        if ($name == null) {
            redirect(base_url() . "index.php/User/login"); //if name is null, redirect to login page
        }

        $this->load->model("Messages_model"); //loads the Messages_model
        $messagesData = $this->Messages_model->getFollowedMessages($name); // calls the getFollowedMessages in Messages_model which gets all messages of the all the users the user follows
        $messagesData = array("messagesResults" => $messagesData); // inserts all data in an array
        $this->load->view('ViewMessages', $messagesData); // loads ViewMessages view and sends the data to it
    }
}
