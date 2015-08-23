<?php
    namespace controllers;
    
    use Helpers\Session;
    use Helpers\Password;
    use Helpers\Url;
    use Core\View;

    class Auth extends \Core\Controller {
        
        private $_model;
        
        public function __construct(){
            $this->_model = new \Models\Auth();
        }
        
        public function login(){

            $data["title"] = "Login";
            
            if(!isset($_POST["login_button"])){
                $error[] = "You need to log in to continue.";
                View::renderTemplate("header", $data);
                View::render("auth/login", $data, $error);
                View::renderTemplate("footer", $data);
            }
        
            if(isset($_POST["login_button"])){
                
                //The login variables
                $email = $_POST["login_email"];
                $password = $_POST["login_password"];
                $remember_me = $_POST["remember_me"];
                
                //Validtation
                if($email == ""){
                    $error[] = "You need to enter your email.";
                } else if($this->_model->exists($email) && !$this->_model->isActive($email)){
                    $error[] = "This account has not been activeted yet.";
                } else if(!Password::verify($password, $this->_model->getHash($email))){
                    $error[] = "Email or password is incorrect.";                    
                }

                View::renderTemplate("header", $data);
                View::render("auth/login", $data, $error);
                View::renderTemplate("footer", $data);
                
                //If validation has passed then log in
                if(!$error){
                    
                    Session::set("loggedin", true);
                    Session::set("user_id", $this->_model->getID($email));
                    Url::redirect("http://something.sellerstam.mebokund.com/", true); //For some reason it doesn't work if the url is blank...
                }
            }
        }
        
        public function logout(){
            
            Session::destroy(); /* Clear all sessions set for this project */
            Url::redirect("http://something.sellerstam.mebokund.com/", true); /* Goes back to the home page */
            
        }
        
        public function register(){
            
            $data["title"] = "Register";
            
            if(isset($_POST["register_button"])){
                
                $name = $_POST["register_name"];
                $email = $_POST["register_email"];
                $password1 = $_POST["register_password"];
                $password2 = $_POST["confirm_password"];
                
                //Validation (this will be expanded)
                if($name == ""){
                    $error["no_name"] = "Name is required";
                }
                
                if($email == ""){
                    $error["no_email"] = "Email is required";
                } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error["not_valid_email"] = "Not a valid email";
                } else if($this->_model->exists($email)){
                    $error["email_exists"] = "This email is already registered";
                }
                
                if($password1 == ""){
                    $error["no_password"] = "Password is required";
                } else if(strlen($password1) < 8){
                    $error["password_short"] = "Password must be atleast 9 characters";
                } else if(ctype_lower($password1)){
                    $error["no_uppercase"] = "Password must contain atleast one upper case letter";
                } else if($password1 != $password2){
                    $error["no_password_match"] = "Passwords do not match";
                }
            
                //If no errors were detected then we'll carry on and register the user
                if(!$error){
                    
                    $postdata = array(
                        "name" => $name,
                        "email" => $email,
                        "password" => Password::make($password1)
                    );
                    $this->_model->insert_user($postdata);
                    
                    $this->_model->sendVerificationEmail($email, $name);
                    
                    Session::set("message", "A verification email has been sent to the entered email address.");
                }
            }
            
            View::renderTemplate("header", $data);
            View::render("auth/register", $data, $error);
            View::renderTemplate("footer", $data);
        }
        
        public function activate_account(){
            
            $secret = "35onoi2=-7#%g03kl";
            
            $email = $_GET["email"];
            $code = $_GET["code"];
            
            View::renderTemplate("header", $data);
            if(password_verify($email . $secret, $code)){
                $this->_model->activate_account($email);
                View::render("auth/activation_success");
            } else {
                View::render("error/activation_error");
            }
            View::renderTemplate("footer", $data);
        }
    }