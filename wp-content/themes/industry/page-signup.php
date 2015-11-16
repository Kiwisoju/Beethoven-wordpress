<?php
get_header('signup');

?>

<div id="primary" class="content-area">
    <div class='row'>
        <div id="image-container" class="col-xs-6">
            <img src="https://placehold.it/400x400"></img>
        </div>
        <div id="signup-form" class="col-xs-6">
            <h1>Sign Up</h1>
            <form id="signup-form">
                <button id="teacher" type="button" class="btn btn-default account-btn">Teacher</button>
                <button id="student" type="button" class="btn btn-default account-btn">Student</button>
                <div class="form-group">
                    <input class="form-control" id="firstName" type="text" name="signup[firstName]" placeholder="First Name"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="lastName" type="text" name="signup[lastName]" placeholder="Last Name"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="email" type="email" name="signup[email]" placeholder="Email Address"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="pass" type="password" name="signup[password]" placeholder="Password"/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="passwordAgain" type="password" name="signup[passwordAgain]" placeholder="Password Again"/>
                </div>
                <input type="hidden" id="account" name="signup[account]"/>
                <input class="btn btn-default" type="submit" value="Sign Up"/>
            </form>
        </div>
    </div>
    
<?php

get_footer();

?>