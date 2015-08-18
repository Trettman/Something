<?php

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;
use Helpers\Form;
use Helpers\Session;
use Core\Error;

//initialise hooks
$hooks = Hooks::get();
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<?php
	//hook for plugging in meta tags
	$hooks->run('meta');
	?>
    <link rel="stylesheet/less" href="<?= Url::templatePath() ?>less/main.less?version=13">
    <link rel="shortcut icon" href="<?= Url::templatePath() ?>assets/tab_symbol.ico">
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js"></script>
	<script src="<?= Url::templatePath() ?>js/jquery-2.1.4.min.js"></script>
	<title><?php echo $data['title'] . ' - ' . SITETITLE; //SITETITLE defined in app/Core/Config.php ?></title>

</head>
<body>
	<script>
		//If the user load the page for the first time in a session, then the page will fade in
		if(document.referrer == null || document.referrer.indexOf(window.location.hostname) < 0){
			$("body").addClass("fade_in_home");
		}
	</script>
    <div id="stickyalias"></div>
        <header>
            <div id="top_container">
                <h1>Something really cool and inspiring...</h1>
                <div id="profile_options">
                    <ul>
                        
                        <?php if(!Session::get("loggedin")){ ?> <!-- If the user is not logged in then show the login and register options -->
                        
                            <li>
                                <a href="#" id="header_login">Log in</a>
                                <div id="login_dropdown">
                                    <h2>Log in</h2>
                                    <div id="login">
                                        <?= Form::open(array("method" => "post", "id" => "login_form", "action" => "login")); ?>
                                            <label for="email">Email</label>
                                            <?= Form::input(array("name" => "login_email", "id" => "email", "placeholder" => "Email")); ?>
                                            <label for="password">Password</label>
                                            <?= Form::input(array("name" => "login_password", "id" => "password", "placeholder" => "Password", "type" => "password")); ?>
                                            <?= Form::input(array("name" => "login_button", "id" => "login_button", "value" => "Login", "type" => "submit")); ?>
                                            <label id="checkbox_label" for="remember_checkbox">Remember me</label>
                                            <?= Form::input(array("name" => "remember_me", "id" => "remember_checkbox", "type" => "checkbox")); ?>
                                        <?= Form::close(); ?>
                                    </div>
                                    <div id="extra_login_options">
                                        <a href="/signup">Don't have an account? Sign up!</a>
                                        <a href="/reset_password">Forgot your password?</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="/register" id="header_signup">Sign up</a>
                            </li>
                            
                        <?php } else { ?> <!-- if the user is not logged in the show the my profile and logout options -->
                    
							<li>
								<a href="/profile" id="header_my_profile">My profile</a>
							</li>
							<li>
								<a href="/logout" id="header_logout">Log out</a>
							</li>
                        
                        <?php } ?>
                    </ul>
                </div>
                <div id="social_links_container">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/"><img src="<?= Url::templatePath() ?>assets/facebook_icon.png?version=2"></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/"><img src="<?= Url::templatePath() ?>assets/twitter_icon.png?version=2"></a>
                        </li>
                        <li>
                            <a href="https://www.pinterest.com/"><img src="<?= Url::templatePath() ?>assets/pinterest_icon.png?version=2"></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/"><img src="<?= Url::templatePath() ?>assets/google+_icon.png?version=2"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <nav id="main_nav">
                <div id="name_container">
                    <!-- <h1>Something</h1> Maybe I should use a nice picture instead, but I suck at designing -->
                    <a href="/"><img src="<?= Url::templatePath() ?>assets/logo_symbol.png?version=2"></a>
                </div>
                <div id="mobile_menu_link_wrapper">
                    <a href="#" id="show_mobile_menu">Menu</a>
                </div>
                <ul id="menu">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/about">About</a>
                    </li>
                    <li>
                        <a href="/contact">Contact</a>
                    </li>
                    <li>
                        <a href="/support">Support</a>
                    </li>
                    <li id="create_entry">
                        <a href="#">Create entry</a>
                    </li>
                </ul>
            </nav>
        </header>    

<?php /*
//hook for running code after body tag
$hooks->run('afterBody');
*/ ?>
