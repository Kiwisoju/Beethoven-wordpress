<?php

/**
* Template Name: Secure Student Area
**/

// If statement here checking whether the user has correct permissions, if so do the loop
if($current_user->roles[0] === 'student' || $current_user->roles[0] === 'administrator'){

    // Call to the header for the teacher    
    get_header('student');

    // Call for the loop for student's dashboard.
    ?>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12"><?php 
                            // Checking that there are posts
                            if ( have_posts() ) : 
                                // Start the loop.
                                while ( have_posts() ) : the_post();
                                    echo the_content();
                                    // End the loop.
                                endwhile;
                            // If no content, include the "No posts found" template.
                            else :
                                echo 'This page was not found';
                                echo is_single();
                            endif;
        		    ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    
    // Call to the footer for dashboard pages
    get_footer('dashboard');
    
}else{
    // Redirect to home page
    wp_redirect( home_url() );
    exit;
}