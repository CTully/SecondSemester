<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>LAMP 2 Final - Contact Manager</title>

  <link rel="stylesheet" href="<?php print base_url(); ?>foundation-4.0.4/css/normalize.css" />
  
  <link rel="stylesheet" href="<?php print base_url(); ?>foundation-4.0.4/css/foundation.css" />

  <link rel="stylesheet" href="<?php print base_url(); ?>css/custom.css" />  

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD15zC_1_EVGBpNqzjXsKJU6cD_TGul15g&sensor=false"></script>

  <script src="<?php print base_url(); ?>foundation-4.0.4/js/vendor/custom.modernizr.js"></script>

</head>
<body>
	<div id="main" class="row">
		<div class="large-12 columns">
		<header id="header">
			<h1>Contact Manager</h1>
		</header>
		<nav class="top-bar">
    <ul class="title-area">
    <li class="name">
      <h1><a>
        <?php if($this->session->userdata('username') ){  
        print 'Logged in as ' . $this->session->userdata('username'); 
      } else{
        print 'Contact Manager';
      } ?>
      </a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>
			<section class="top-bar-section">
				<ul class="left">
          <li class="divider"></li>
            <?php if($this->session->userdata('username')): ?>              
        			<li class="has-dropdown"><a>People</a>
        				<ul class="dropdown">
        					<li><a href="<?php print base_url(); ?>index.php/people">View All</a></li>
                  <li><a href="<?php print base_url(); ?>index.php/people/create">Add New</a></li>
        				</ul>
        			</li>
        				<li class="divider"></li>
        				<li class="has-dropdown"><a>Companies</a>
        					<ul class="dropdown">
        						<li><a href="<?php print base_url(); ?>index.php/companies">View All</a></li>
                    <li><a href="<?php print base_url(); ?>index.php/companies/create">Add New</a></li>
        					</ul>
        				<li class="divider"></li>
        			</li>
            <?php endif; ?>
				</ul>

				<ul class="right">
					<li class="has-dropdown"><a>Account</a>
      					<ul class="dropdown">
                  <?php if($this->session->userdata('username') ){ ?>
                    <li><a href="<?php print base_url(); ?>index.php/users/view">View Profile</a></li>
        						<li><a href="<?php print base_url(); ?>index.php/users/edit">Edit Profile</a></li>
                    <li><a href="<?php print base_url(); ?>index.php/users/changepic">Change Profile Picture</a></li>
                    <li><a href="<?php print base_url(); ?>index.php/users/logout">Logout</a></li>              
                    <li><a href="<?php print base_url(); ?>index.php/users/confirm">Delete</a></li>
                  <?php } else { ?>                  
                  <li><a href="<?php print base_url(); ?>">Login</a></li>
                  <li><a href="<?php print base_url(); ?>index.php/users/register">Register</a></li>
                  <?php } ?>
      					</ul>
      				</li>
				</ul>
			</section>
		</nav>
		<section id="content">