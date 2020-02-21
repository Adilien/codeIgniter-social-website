<?php

defined('BASEPATH') or exit('No direct script access allowed'); //defined checks if a given name exists. BASEPATH contains path to the system folder.  exit() prints the set string and terminates execution

class Search extends CI_Controller
{
    public function index()
    {
        $this->load->view('Search'); //loads the Search view 
    }

    public function dosearch()
    {
        $this->load->model("Messages_model"); //loads the Messages_model 
        $data = $this->Messages_model->searchMessages($_GET["search"]); //executes the searchMessages method inside the Messages_model and sends in the search string by getting it via the GET method
        $data = array("messagesResults" => $data); //saves the results from the searchMessages method and inserts it into an array
        $this->load->view('ViewMessages', $data); //loads the ViewMessages view and sends the data to the view
    }
}
