<?php

defined('BASEPATH') or exit('No direct script access allowed'); //defined checks if a given name exists. BASEPATH contains path to the system folder.  exit() prints the set string and terminates execution

class Users_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database(); // the constructor loads the database
    }

    public function checkLogin($username, $pass) // takes in the username and hashed password which is sent via a form 
    {
        $sql = 'SELECT * FROM Users WHERE username = ? AND password = ?'; //selects all the users who have the username that is taken in
        $query = $this->db->query($sql, array($username, $pass)); // sends the username and password taken after inserting it in an array to the query and saves the query in the $query variable 

        if (count($query->result_array()) == 1) {
            return true; //if the result of the sql is 1, it returns true indicating that the user exists
        } else {
            return false; // if no matches are found, the checkLogin returns false indicating that the user does not exist
        }
    }

    public function isFollowing($follower, $followed) //takes in the name of the follower and the user they followed
    {
        $sql = 'SELECT * FROM User_Follows WHERE follower_username = ? AND followed_username = ?'; //selects all the users which the follower follows
        $query = $this->db->query($sql, array($follower, $followed)); // sends the follower name and followed user name taken after inserting it in an array to the query and saves the query in the $query variable 

        if (count($query->result_array()) == 1) {
            return true; //if the follower follows the person who is followed, it returns true indicating that the user is already following that user
        } else {
            return false; //if the follower does not follow the person who is followed, it returns false indicating that the user is not following that user
        }
    }

    public function follow($followed) //takes in the name of the user the user wants to follow
    {
        $sql = 'INSERT INTO User_Follows (follower_username, followed_username) 
        VALUES (?, ?)'; //inserts the name of the user and the person who the user followed into the table called User_Follows
        $currentUser = $this->session->userdata('username'); //the name of the current logged in user
        $this->db->query($sql, array($currentUser, $followed)); // sends the current user name and followed user name taken after inserting it in an array to the query 
    }
}
