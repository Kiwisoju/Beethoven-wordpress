<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );

include_once('rollbar.php');
Rollbar::init(array('access_token' => 'df78d3555a1f4f72a423631a7d7534dd'));
Rollbar::report_message("SYSTEM: Cron Initialised", 'info');
