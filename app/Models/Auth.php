<?php

    namespace models;

    use PDO;
    
    class Auth extends \Core\Model {
        
        /**
         * Gets password hash from database
         * @param string $email the email specified by the user during log in
         *
         */
        public function getHash($email){
            $data = $this->db->select("SELECT password FROM users WHERE email = :email",
                                      array(":email" => $email)
                                      );
            return $data[0]->password;
        }
        
        /**
         * Gets user id from database
         * @param string $email the email specified by the user during log in
         *
         */
        public function getID($email){
            $data = $this->db->select("SELECT id FROM users WHERE email = :email",
                                      array(":email" => $email));
            return $data[0]->id;
        }
        
        /**
         * Checks if the account which attempts to login is active
         * @param string $email the email specified by the user during log in
         *
         */
        public function isActive($email){
            $data = $this->db->select("SELECT active FROM users WHERE email = :email",
                                       array(":email" => $email));
            if($data[0]->active == 1){
                return true;
            }
            return false;
        }
        
        /**
         * Inserts user into the database
         * @param array $data data entered by user during registration: name, email, password
         *
         */
        public function insert_user($data){
            //Inserts the data array into the users table
            $this->db->insert("users", $data);
        }

        /**
         * Returns true if an email already exists in the users table
         * @param string $email the email specified by the user during registration
         *
         */
        public function exists($email){
            $rows = $this->db->select("SELECT * FROM users WHERE email = :email",
                              array(":email" => $email),
                              PDO::FETCH_NUM
                              );
            if($rows[0] > 0){
                return true;
            }
            return false;
        }
        
        /**
         * Sends verification email to the user after registration
         * @param string $email the email specified by the user during registration
         * @param string $name the name specified by the user during registration
         *
         */
        public function sendVerificationEmail($email, $name){
            
            $secret = "35onoi2=-7#%g03kl";
            
            $hash = password_hash($email . $secret, PASSWORD_DEFAULT);
            
            $mail = new \Helpers\PhpMailer\Mail();
            $mail->setFrom("noreply@something.com", "Something");
            $mail->addAddress($email);
            $mail->subject("Something Verification Email");
            $mail->body("
                        <!DOCTYPE html>
                        <html>
                            <body>
                                Hello $name,
                                <br>
                                <br>
                                You're almost done with your Something account registration. The only thing you need to do now is to activate your account by clicking the link below.
                                <br>
                                <a href='http://www.something.sellerstam.mebokund.com/activate?email=$email&code=$hash'>http://www.something.sellerstam.mebokund.com/activate?email=$email&code=$hash</a>
                            </body>
                        </html>
                        ");
            $mail->send();
        }
        
        /**
         * Activates account
         * @param string $email the account's email
         *
         */
        public function activate_account($email){
            $data = array("active" => 1);
            $where = array("email" => $email);
            $this->db->update("users", $data, $where);
        }
    }
