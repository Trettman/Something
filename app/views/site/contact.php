<?php

    use Helpers\Form;
    use Helpers\Session;
    use Core\Error;

        
    $rainCaptcha = new \Helpers\RainCaptcha();
    
?>

<div id="global_container">
    <h1 class="form_header">Contact</h1>
    <div class="form_wrapper">
        <?= Form::open(array("method" => "post")); ?>
        <div class="p">
            <?= Form::input(array("name" => "contact_name", "placeholder" => "Full name", "value" => $_POST["contact_name"])); ?>
            <?php if(isset($error["no_name"])){ ?>
                <div class="error">
                     <?= $error["no_name"]; ?>
                </div>
            <?php } ?>
        </div>
        <div class="p">
            <?= Form::input(array("name" => "contact_email", "placeholder" => "Email", "value" => $_POST["contact_email"])); ?>
            <?php if(isset($error["no_email"]) || isset($error["not_valid_email"])){ ?>
                <div class="error">
                     <?= $error["no_email"]; ?>
                     <?= $error["not_valid_email"]; ?>
                </div>
            <?php } ?>
        </div>
        <div class="p">
            <?= Form::input(array("name" => "contact_subject", "placeholder" => "Subject", "value" => $_POST["contact_subject"])); ?>
            <?php if(isset($error["no_subject"])){ ?>
                <div class="error">
                     <?= $error["no_subject"]; ?>
                </div>
            <?php } ?>
        </div>
        <div class="p">
            <?= Form::textBox(array("name" => "contact_comment", "placeholder" => "Comment")); ?>
            <?php if(isset($error["no_comment"])){ ?>
                <div class="error">
                     <?= $error["no_comment"]; ?>
                </div>
            <?php } ?>
        </div>
        <div class="p">
            <img id="captchaImage" src="<?php echo $rainCaptcha->getImage(); ?>" />
 
            <input name="captcha" type="text" />
             
            <button type="button" class='btn btn-danger' onclick="document.getElementById('captchaImage').src= 
            '<?php echo $rainCaptcha->getImage(); ?>&morerandom=' + Math.floor(Math.random() * 10000);">New captcha</button>
            <?php if(isset($error["captcha"])){ ?>
                <div class="error">
                     <?= $error["captcha"]; ?>
                </div>
            <?php } ?>
        </div>
        <div class="p">
            <?= Form::input(array("name" => "contact_button", "value" => "Send", "type" => "submit")); ?>
        </div>
        <?= Form::close(); ?>
        <span id="success_message"><?= Session::pull("message"); ?></span>
    </div>
</div>