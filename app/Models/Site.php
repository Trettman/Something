<?php

    namespace models;

    use PDO;
    
    class Site extends \Core\Model {
        
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
        
        public function create_entry($data){
            return $this->db->insert("entries", $data); // The insert function return the last inserted id
        }
        
        public function insert_input($post_data){
            $this->db->insert("inputs", $post_data);
        }
    }