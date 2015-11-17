<?php

/**
 * Template Name: Signup Page
 **/
 
get_header('signup');
?>

<div id="primary" class="content-area">
    <div class='row'>
        <div id="image-container" class="col-xs-6">
            <img src="https://placehold.it/400x400"></img>
        </div>
        <div id="signup-form" class="col-xs-6">
            <h1>Sign Up</h1>
            <form id="signup-form" method="post" action="<?php echo 'https://' . $_SERVER['HTTP_HOST'] ?>/wp-login.php?action=register">
                <div class="form-group">
                    <input class="form-control" id="firstName" type="text" name="first_name" placeholder="First Name"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="lastName" type="text" name="last_name" placeholder="Last Name"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="email" type="email" name="user_login" placeholder="Email Address"/>
                </div><?php
                if($_GET['checkemail'] =='registered'):?>
                    <p>Registration complete. Please check your e-mail.</p><?php
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