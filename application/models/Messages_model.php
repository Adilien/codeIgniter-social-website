<?php

defined('BASEPATH') or exit('No direct script access allowed'); //defined checks if a given name exists. BASEPATH contains path to the system folder.  exit() prints the set string and terminates execution

class Messages_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database(); // the constructor loads the database
    }

    public function getMessagesByPoster($name) //takes in the name of the message poster
    {
        $sql = 'SELECT * FROM Messages WHERE user_username = ? ORDER BY posted_at ASC'; //selects all messages from the given user and orders them in ascending order
        $query = $this->db->query($sql, array($name)); // sends the user name taken after inserting it in an array to the query and saves the query in the $query variable 
        return $query->result_array(); //returns the query in a result array
    }

    public function searchMessages($string) //takes the string that needs to be searched
    {
        $sql = 'SELECT * FROM Messages WHERE text LIKE ? ORDER BY posted_at ASC'; //selected all messages which include the given string and orders them in ascending order
        $query = $this->db->query($sql, array("%" . $string . "%")); // sends the string taken after inserting it in an array to the query and saves the query in the $query variable 
        return $query->result_array(); //returns the query in a result array
    }

    public function insertMessage($poster, $string) //takes in the user name and message they posted
    {
        $postedAt = date('Y-m-d H:i:s'); //saves the date format in the variable $postedAt
        $sql = 'INSERT INTO Messages (user_username, text, posted_at) 
                VALUES (?, ?, ?)'; // Inserts the user name, message and time posted into the table called Messages
        $query = $this->db->query($sql, array($poster, $string, $postedAt)); // sends the user name, message and time posted taken after inserting it in an array to the query and saves the query in the $query variable 
    }

    public function getFollowedMessages($name) //takes in the name of the person who the user wants to see the messages off
    {
        $sql = 'SELECT user_username, Messages.text, Messages.posted_at FROM User_Follows, Messages WHERE follower_username = ? AND Messages.user_username = followed_username'; //selects all the users the user follows and gets their messages and usernames
        $query = $this->db->query($sql, array($name)); //sends the user name taken after inserting it in an array to the query and saves the query in the $query variable 
        return $query->result_array(); //returns the query in a result array
    }
}
