<?php

defined('BASEPATH') or exit('No direct script access allowed'); //defined checks if a given name exists. BASEPATH contains path to the system folder.  exit() prints the set string and terminates execution

class Message extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('username')) {
            $this->load->view('Post'); //if the current user is logged in, load the view with the name Post 
        } else {
            redirect(base_url() . "index.php/User/login/"); //if user not logged in, the user is redirected to the login page
        }
    }

    public function doPost()
    {
        if ($this->session->userdata('username')) { // checks to see if the current user is logged in 

            $currentUser = $this->session->username; // saved the name of user who is logged in inside the $currentUser variable
            $message = $this->input->post("message"); //saves the posted message in $message variable

            $this->load->model("Messages_model"); //loads the Messages_model
            $this->Messages_model->insertMessage($currentUser, $message); //executes the insertMessage function inside the Messages_model and passes the name of the current logged in user and the message they posted in the parameters

            redirect(base_url() . "index.php/User/view/" . $this->session->username); //redirects user to the view with all of their messages
        } else {
            redirect(base_url() . "index.php/User/login/"); // if current user not logged in, redirect them to login page
        }
    }
}
