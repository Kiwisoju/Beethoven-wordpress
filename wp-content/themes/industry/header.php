<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title(); ?></title>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- wp_head() START -->
    <?php wp_head();?>
    <!-- wp_head() FINISH -->
</head>


<body>
        <!-- Navigation -->
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <a class ="navbar-brand" href="#">Home</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        
                        <?php 
                        /* First args defines the menu
                           Second arg removes wrapping Ul element */
                            $args = array(
                                'menu' => 'Primary navigation',
                                'items_wrap' => '%3$s');
                            
                            wp_nav_menu($args);
                        ?>
                            
                      
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>    
            </div>
        </nav>
    <!-- Header - Rewrite the copy and set the background image in css -->
    <div id="header">
        <div id="mask" class="row">
            <div id="header-text" class="col-xs-6 col-xs-offset-6">
                <h1>Name of Product</h1>
                <h2>Online Music Classroom</h2>
                <p>Steamline your student's workflow with this web application. Manage lessons, homework and exercises for your students and see their progress with this easy online solution</p>
                <button type="button" class="btn btn-default">Sign Up to Get Started</button>
                <button type="button" class="btn btn-default">Explore our Features</button>
            </div>
        </div>
    </div>