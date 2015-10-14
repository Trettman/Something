<?php

    namespace models;

    use PDO;
    
    class Site extends \Core\Model {
        
        /**
         * Sends en email to mr.otto.1@hotmail.com with the user input
         * @param string $name the name specified by the user
         * @param string $email the email specified by the user
         * @param string $subject the subject specified by the user
         * @param string $comment the main text spcified by the user
         *
         */
        public function sendContactForm($name, $email, $subject, $comment){
            
            $mail = new \Helpers\PhpMailer\Mail();
            $mail->setFrom($email);
            $mail->addAddress("mr.otto.1@hotmail.com"); //This is my personal email address
            $mail->subject("Comment on Something site");
            $mail->body("
                        <!DOCTYPE html>
                        <html>
                            <body>
                                New comment on Something
                                <br>
                                <br>
                                $subject
                                <br>
                                <br>
                                " . nl2br($comment) . "
                            </body>
                        </html>
                        ");
            $mail->send();   
        }
        
        /**
         * Creates an entry in the database
         * @param array @data the user's id
         *
         */
        public function create_entry($data){
            return $this->db->insert("entries", $data); // The insert function return the last inserted id
        }
        
        /**
         * Inserts the user's input into the database. This references to the entry created with the above method
         * @param array @post_data all the data inputed by the user and user's id. This includes amount and type specified by the user
         *
         */
        public function insert_input($post_data){
            $this->db->insert("inputs", $post_data);
        }
    }
