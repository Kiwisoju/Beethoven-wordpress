<?php

/**
* Template Name: Secure Teacher Area
**/

// If statement here checking whether the user has correct permissions, if so do the loop
if($current_user->roles[0] === 'teacher' || $current_user->roles[0] === 'administrator'){

    // Call to the header for the teacher    
    get_header('teacher');
    
    // Call for the loop for teacher's dashboard.
    // Doin' the loop biish! Similar way to the front-page where it takes 
    // the wp_options array and loads in the 'modules'
    echo 'Hey there teacher!';
    
    // Call to the footer for the teacher
    get_footer('teacher');

    
    
}else{
    // Otherwise they don't have permissions to be here.
    // Need to display a message somewhere..
    //wp_redirect( home_url() );
    //exit;
}


