<?php
global $wpdb;
$homepageSections =  $wpdb->get_row("SELECT `option_value` FROM `wp_options` WHERE `option_name`='homepage-sections'");
$slugs = explode( ',', $homepageSections->option_value);
/**
 * The custom template for the one-page style front page. Is loaded automatically due to template hierarchy.
*/

get_header();?>

    <!-- Main Content Area -->
    <div id="primary" class="content-area"><?php 
        
        //die(var_dump($args) );
        foreach($slugs as $slug){
                
            $my_query = new WP_Query( array( 'pagename' => $slug ) );
            
            // Checking that there are posts
            if ( $my_query->have_posts() ) : 
    			// Start the loop.
    			while ( $my_query->have_posts() ) : $my_query->the_post();
    			    echo '<div class="'.$slug.'-content row">';
                    echo the_content();
                    echo '</div>';
                    
    			// End the loop.
    			endwhile;
    		// If no content, include the "No posts found" template.
    		else :
    			echo 'Uh oh, nothing fooooooooooound.';
    			echo is_single();
    		endif;
        }
		?>    
<?php get_footer();?>

