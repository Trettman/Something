<?php

    use Helpers\Form;
    use Helpers\Session;
    use Helpers\Url;
    use Core\Error;

    if(!Session::get("loggedin")){
         Url::redirect("/login");
    }
    
?>

<div id="global_container">
    <h1 class="form_header">Create entry</h1>
    <div id="entry_info">
        <p>
            Start of by entering what type of liquor you want people to bring to the right and then the amount to the left.
            When you want to add another row, simply click the "Add row" button. Continue writing and adding until you've entered
            everything you need. When you're done, just click the "Send" button!
        </p>
    </div>
    <?php if($error != null){ ?>
            <div id="entry_error_wrapper">
                <?= Error::display($error); ?>
            </div>  
    <?php } ?>
    <div class="form_wrapper">
        <?= Form::open(array("method" => "post")); ?>
        <div id="input_field_container">
            <div class="p">
                <?= Form::input(array("class" => "type", "name" => "type_of_liquor[]", "placeholder" => "Type of liquor")); ?>
                <?= Form::input(array("class" => "amount", "name" => "amount_of_type[]", "placeholder" => "Amount", "type" => "number")); ?>
                <br clear="all">
            </div>
        </div>
        <div class="p">
            <?= Form::input(array("id" => "add_input_button", "value" => "Add row", "type" => "button")); ?>
            <br clear="all">
        </div>
        <div class="p">
            <?= Form::input(array("name" => "entry_button", "value" => "Send", "type" => "submit")); ?>
        </div>
        <?= Form::close(); ?>
    </div>
</div>