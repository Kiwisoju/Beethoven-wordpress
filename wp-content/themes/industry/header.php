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
    <!-- Actual Header - Rewrite the copy and set the background image in css -->
    <div class="row" id="header">
        <div class="large-3 columns">
            <h1>Name of Product</h1>
            <h2></h2>
            <p>Steamline your student's workflow with this web application. Manage lessons, homework and exercises for your students and see their progress with this easy online solution</p>
            <button>Sign Up to Get Started</button>
            <button>Explore our Features</button>
    </div>
    <!-- Fixed navigation in CSS,  Grab the wordpress nav later -->
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">Home</a></h1>
          <h1><a href="#">About Us</a></h1>
          <h1><a href="#">Logo</a></h1>
          <h1><a href="#">Contact</a></h1>
          <h1><a href="#">Support</a></h1>
          <h1><a href="#">Login</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>
    
    </nav>
    <div class="large-9 columns">
        <ul>
            <li>Home</li>
            <li>About Us</li>
            <li>Logo</li>
            <li>Contact</li>
            <li>Support</li>
            <li>Login</li>
        </ul>
    </div>