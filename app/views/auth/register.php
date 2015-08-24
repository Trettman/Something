<?php

    use Helpers\Form;
    use Helpers\Session;
    use Core\Error;
    
    $rainCaptcha = new \Helpers\RainCaptcha();

?>

<div <div id="global_container">
    <h1 class="form_header">Register</h1>
    <div class="form_wrapper">
        <?= Form::open(array("method" => "post")); ?>
            <div class="p">
                <?= Form::input(array("name" => "register_name", "placeholder" => "Full name", "value" => $_POST["register_name"])); ?>
                <?php if(isset($error["no_name"])){ ?>
                    <div class="error">
                        <?= $error["no_name"]; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="p">
                <?= Form::input(array("name" => "register_email", "placeholder" => "Email", "value" => $_POST["register_email"])); ?>
                <?php if(isset($error["no_email"]) || isset($error["not_valid_email"]) || isset($error["email_exists"])){ ?>
                    <div class="error">
                        <?= $error["no_email"]; ?>
                        <?= $error["not_valid_email"]; ?>
                        <?= $error["email_exists"]; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="p">
                <?= Form::input(array("name" => "register_password", "placeholder" => "Password", "type" => "password")); ?>
                <?php if(isset($error["no_password"]) || isset($error["password_short"]) || isset($error["no_uppercase"]) || isset($error["no_password_match"])){ ?>
                    <div class="error">
                        <?= $error["no_password"]; ?>
                        <?= $error["password_short"]; ?>
                        <?= $error["no_uppercase"]; ?>
                        <?= $error["no_password_match"]; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="p">
                <?= Form::input(array("name" => "confirm_password", "placeholder" => "Confirm password", "type" => "password")); ?>
            </div>
            <div class="p">
                <img id="captchaImage" src="<?php echo $rainCaptcha->getImage(); ?>" />
     
                <input type="text" name="captcha">
                 
                <button type="button" onclick="document.getElementById('captchaImage').src= 
                '<?php echo $rainCaptcha->getImage(); ?>&morerandom=' + Math.floor(Math.random() * 10000);">New captcha</button>
                <?php if(isset($error["captcha"])){ ?>
                    <div class="error">
                         <?= $error["captcha"]; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="p">
                <?= Form::input(array("name" => "register_button", "value" => "Register", "type" => "submit")); ?>
            </div>
        <?= Form::close(); ?>
        <span id="success_message"><?= Session::pull("message"); ?></span>
    </div>
</div>