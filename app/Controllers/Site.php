<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

    class Site extends Controller {
    
        private $_model;
    
        /**
         * Call the parent construct
         */
        public function __construct(){
            parent::__construct();
    
            $this->language->load('Welcome');
            $this->_model = new \Models\Site();
        }
    
        /**
         * Define home page title and load template files
         */
        public function home(){
            $data['title'] = "Home";
    
            View::renderTemplate('header', $data);
            View::render('site/home', $data);
            View::renderTemplate('footer', $data);
        }
        
        public function about(){
            $data['title'] = "About";
    
            View::renderTemplate('header', $data);
            View::render('site/about', $data);
            View::renderTemplate('footer', $data);
        }
        
        public function contact(){
            $data['title'] = "Contact";
            
            if(isset($_POST["contact_button"])){
                
                $name = $_POST["contact_name"];
                $email = $_POST["contact_email"];
                $subject = $_POST["contact_subject"];
                $comment = $_POST["contact_comment"];
                                  
                if($name == ""){
                    $error["no_name"] = "Name is required";
                }
                
                if($email == ""){
                    $error["no_email"] = "Email is required";
                } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error["not_valid_email"] = "Not a valid email";
                }
                
                if($subject == ""){
                    $error["no_subject"] = "Subject is required";
                }
                
                if($comment == ""){
                    $error["no_comment"] = "Comment is required";
                }
                
                if(!$error){
                    $this->_model->sendContactForm($name, $email, $subject, $comment);
                    Session::set("message", "Your comment has been sent successfully! You'll be hearing from us shortly.");
                }                
            }
    
            View::renderTemplate('header', $data);
            View::render('site/contact', $data, $error);
            View::renderTemplate('footer', $data);
        }
        
        public function support(){
            $data['title'] = "Support";
    
            View::renderTemplate('header', $data);
            View::render('site/support', $data);
            View::renderTemplate('footer', $data);
        }
        
        public function create_entry(){
            $data['title'] = "Create Entry";
            
            View::renderTemplate('header', $data);
            
            $user_id = Session::get("user_id");
            $types = array();       //This array contains the types of liquor entered
            $amounts = array();     //This array contains the amounts of liquor entered
            //The two arrays have corresponding indexes. For example, $amounts[2] correspons with $types[2]
            
            if(isset($_POST["entry_button"])){
                foreach($_POST["type_of_liquor"] as $index => $type){
                    array_push($types, $type);
                    if($type == "" && !$error){
                        $error[] = "You need to enter all of the fields.";
                    }
                }
                foreach($_POST["amount_of_type"] as $index => $amount){
                    array_push($amounts, $amount);
                    if($amount == "" && !$error){ //To prevent it from adding the same error message twice
                        $error[] = "You need to enter all of the fields.";
                    }
                }
                
                if(!$error){
                    //Creates the entry
                    $entry_data = array("user_id" => $user_id);
                    $entry_id = $this->_model->create_entry($entry_data);
                    
                    //Inserts the post data into the input database which references to the entries database
                    $post_data = array();
                    for($i = 0; $i < count($types); $i++){ //It might as well have been count($amounts), they're the same length
                        $post_data = array("entry_id" => $entry_id,
                                           "type" => $types[$i],
                                           "amount" => $amounts[$i]
                                           );
                        $this->_model->insert_input($post_data);
                    }
                    // Pass in success data
                    
                    View::render('site/create_entry', $data);
                } else {
                    View::render('site/create_entry', $data, $error);
                }
            } else {
                View::render('site/create_entry', $data);
            }
            View::renderTemplate('footer', $data);
        }
    }
