<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

    class Site extends Controller {
    
        /**
         * Call the parent construct
         */
        public function __construct(){
            parent::__construct();
    
            $this->language->load('Welcome');
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
    
            View::renderTemplate('header', $data);
            View::render('site/contact', $data);
            View::renderTemplate('footer', $data);
        }
        
        public function support(){
            $data['title'] = "Support";
    
            View::renderTemplate('header', $data);
            View::render('site/support', $data);
            View::renderTemplate('footer', $data);
        }
    }
