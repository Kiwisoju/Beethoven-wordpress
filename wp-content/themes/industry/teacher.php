<?php

/**
* Template Name: Secure Teacher Area
**/

// If statement here checking whether the user has correct permissions, if so do the loop
if($current_user->roles[0] === 'teacher' || $current_user->roles[0] === 'administrator'){

    // Call to the header for the teacher    
    get_header('teacher');

    // Call for the loop for teacher's dashboard.
    // Similar way to the front-page where it takes 
    // the wp_options array and loads in the 'modules'
    ?>
        <!-- Main Content Area -->
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
                            echo 'Uh oh, nothing fooooooooooound.';
                            echo is_single();
                        endif;
    		    ?></div>
            </div>
        </div>
    </div>
    <?php
    
    // Call to the footer for the teacher
    get_footer('teacher');

    
    
}else{
    // Otherwise they don't have permissions to be here.
    // Need to display a message somewhere..
    wp_redirect( home_url() );
    exit;
}



    //     <!-- Page Content -->
    //     <div id="page-content-wrapper">
    //         <div class="container-fluid xyz">
    //             <div class="row">
    //                 <div class="col-lg-12">
    //                     <h1>Simple Sidebar With Bootstrap 3 by <a href="http://seegatesite.com/create-simple-cool-sidebar-menu-with-bootstrap-3/" >Seegatesite.com</a></h1>
    //                     <p>This sidebar is adopted from start bootstrap simple sidebar startboostrap.com, which I modified slightly to be more cool. For tutorials and how to create it , you can read from my site here <a href="http://seegatesite.com/create-simple-cool-sidebar-menu-with-bootstrap-3/">create cool simple sidebar menu with boostrap 3</a></p>
    //                 </div>
    //             </div>
    //         </div>
    //     </div>
    //     <!-- /#page-content-wrapper -->

    // </div>