<?php

    use Helpers\Form;
    use Core\Error;

?>

<div <div id="global_container">
    <h1 id="login_header">Log in</h1>
    <div id="login_error_wrapper">
        <?= Error::display($error); ?>
    </div>
    <div id="login_wrapper">
        <?= Form::open(array("method" => "post", "action" => "login")); ?>
            <?= Form::input(array("name" => "login_email", "placeholder" => "Email")); ?>
            <?= Form::input(array("name" => "login_password", "placeholder" => "Password", "type" => "password")); ?>
            <div id="checkbox_container">
                <label id="checkbox_label" for="remember_checkbox">Remember me</label>
                <?= Form::input(array("name" => "remember_me", "type" => "checkbox")); ?>
            </div>
            <?= Form::input(array("name" => "login_button", "value" => "Login", "type" => "submit")); ?>
        <?= Form::close(); ?>
        <a href="/reset_password">Forgot your password?</a>
    </div>
</div>