<?php

    use Helpers\Form;
    use Core\Error;

?>

<div <div id="global_container">
    <h1 class="form_header">Log in</h1>
    <?php if($error != null){ ?>
        <div id="login_error_wrapper">
            <?= Error::display($error); ?>
        </div>
    <?php } ?>
    <div class="form_wrapper">
        <?= Form::open(array("method" => "post", "action" => "login")); ?>
            <div class="p">
                <?= Form::input(array("name" => "login_email", "placeholder" => "Email")); ?>
            </div>
            <div class="p">
                <?= Form::input(array("name" => "login_password", "placeholder" => "Password", "type" => "password")); ?>
            </div>
            <div class="p">
                <div id="checkbox_container">
                    <label id="checkbox_label" for="remember_checkbox">Remember me</label>
                    <?= Form::input(array("name" => "remember_me", "type" => "checkbox")); ?>
                </div>
            </div>
            <div class="p">
                <?= Form::input(array("name" => "login_button", "value" => "Login", "type" => "submit")); ?>
            </div>
        <?= Form::close(); ?>
        <a href="/reset_password">Forgot your password?</a>
    </div>
</div>