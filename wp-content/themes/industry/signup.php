<?php

/**
 * Template Name: Signup Page
 **/

// Checking for error messages, if so saving to $messages array. Checking later if there are errors and displaying
// to the page..
// TODO Move this to the register_functions.php file.
if($_GET['empty_email']){
    $messages['empty_email'] = 'Email field is empty.';
}

if($_GET['first_name_error']){
    $messages['empty_first_name'] = 'First name field is empty.';
}

if($_GET['last_name_error']){
    $messages['empty_last_name'] = 'Last name field is empty.';
}

if($_GET['email_exists']){
    $messages['email_exists'] = 'This email is already being used.';
}


get_header('signup');
?>

<div id="primary" class="content-area">
    <div class='row'>
        <div id="image-container" class="col-xs-6">
            <img src="https://placehold.it/400x400"></img>
        </div>
        <div id="signup-form" name="signup-form" class="col-xs-6">
            <h1>Sign Up</h1>
            <div class="notification-box">
                <span class="notification-message">
                    
                </span>
            </div>
            <form id="signup-form" method="post" action="<?php echo 'https://' . $_SERVER['HTTP_HOST'] ?>/wp-login.php?action=register">
                <div class="form-group">
                    <input class="form-control required" id="firstName" type="text" name="first_name" placeholder="First Name"/>
                </div>
                <div class="form-group">
                    <input class="form-control required" id="lastName" type="text" name="last_name" placeholder="Last Name"/>
                </div>
                <div class="form-group">
                    <input class="form-control required email" id="email" type="email" name="user_login" placeholder="Email Address"/>
                </div>
                <div id="notifications">
                    
                </div><?php
                if($_GET['checkemail'] =='registered'):?>
                    <div id="success-notification">
                        <span>Registration complete. Please check your e-mail.</span>
                    </div><?php
                elseif($messages):?>
                    <div id="login_errors"><?php
                        foreach($messages as $message){
                            echo '<span>' . $message . '</span> <br>';
                        }
                        ?>
                    </div><?php
                elseif(!$_GET):?>
                <p>Registration confirmation will be e-mailed to you.</p><?php
                endif;?>
                
                <input class="btn btn-default" type="submit" value="Sign Up"/>
            </form>
        </div>
    </div>
    
<?php
get_footer();

?>