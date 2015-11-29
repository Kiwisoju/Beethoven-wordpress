<?php
global $wpdb;
$homepageSections =  $wpdb->get_row("SELECT `option_value` FROM `wp_options` WHERE `option_name`='homepage-sections'");
$slugs = explode( ',', $homepageSections->option_value);
/**
 * The custom template for the one-page style front page. Is loaded automatically due to template hierarchy.
*/

get_header();?>

    <!-- Main Content Area -->
    <div id="primary" class="container"><?php 
        
        //die(var_dump($args) );
        foreach($slugs as $slug){
                
            $my_query = new WP_Query( array( 'pagename' => $slug ) );
            
            // Checking that there are posts
            if ( $my_query->have_posts() ) : 
    			// Start the loop.
    			while ( $my_query->have_posts() ) : $my_query->the_post();
    			    echo '<div id="'.$slug.'" class="'.$slug.'-content row content-row">';
                    echo the_content();
                    echo '</div>';
                    
    			// End the loop.
    			endwhile;
    		// If no content, include the "No posts found" template.
            else :
                echo 'This page was not found';
                echo is_single();
            endif;
        }
        
		get_footer('front-page'); ?>

