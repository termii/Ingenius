<?php 
if (isset($storyid)) {
if (count($stories)>0):
foreach($stories as $sto):
$pagetitle = $sto['post_subject'];
$desc = $sto['post_text'];
$image = $sto['post_image'];
endforeach;
endif; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (isset($desc)) { 
        $desc = str_replace('"', '', $desc);
        $desc = strip_tags(substr($desc,0,157).'...');
    }
    ?>
    <title><?php if (isset($pagetitle)) { echo $pagetitle." - "; } echo $this->option_model->get_value('appname'); ?></title>
    <?php if (isset($category) != "") { ?>
    <meta name="description" content="<?php echo $this->stories_model->get_category_desc($category); ?>">
    <?php } else { ?>
    <meta name="description" content="<?php if (isset($desc)) { echo $desc; } else { echo $this->option_model->get_value('appdescription'); } ?>">
    <?php } ?> 

    <meta name="keywords" content="Ingenius, Nigeria, Ingeniuity, Community, Social, Blogging, Discussions">
		<link rel="Shortcut Icon" type="image/ico" href="<?php echo base_url(); ?>/images/favicon.ico">
    <meta name="author" content="Litwit Investment Capital">
    <link rel="alternate" type="application/rss+xml" href="<?php echo base_url(); ?>feed/" />

    <meta property="og:title" content="<?php if (isset($pagetitle)) { echo $pagetitle." - "; } echo $this->option_model->get_value('appname'); ?>" />
    <meta property="og:description" content="<?php if (isset($desc)) { echo $desc; } else { echo $this->option_model->get_value('appdescription'); } ?>" />
    <meta property="og:image" content="<?php echo base_url() ?>images/<?php if (isset($image)) { echo $image; } ?>" />

    <?php if ($this->option_model->get_value('appfavicon')) { ?>    
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>images/<?php echo $this->option_model->get_value('appfavicon'); ?>"/>
    <?php } ?>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">    

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet">
    <!-- Swiper Slider -->
    <link href="<?php echo base_url(); ?>css/swiper.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css"/>
    <link href="<?php echo base_url(); ?>css/slick-theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/social-likes_classic.css" rel="stylesheet"> 
    <link href="<?php echo base_url(); ?>css/balloon.min.css" rel="stylesheet"> 

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">        
    <link href="//fonts.googleapis.com/css?family=Karla:400,700,900" rel="stylesheet" type="text/css"  media="all"  />            
    <link href='https://fonts.googleapis.com/css?family=Muli:400,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300italic,400italic,600italic,700italic,800italic' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- jQuery -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>        
    <style>
    body { color: <?php echo $this->option_model->get_value('appcolorbodytext'); ?>; }
    a { color: #888888; }
    .catf, .cat { color:#FFF; background-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; }
    #sidebar .catf, #sidebar .cat { background:none; font-size:13px; color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?> !important; }
    .navbar-custom .navbar-brand { background-color: <?php echo $this->option_model->get_value('appcolortitlescolor'); ?>; color:#FFFFFF; }
    .menu li a:hover, .menu li a.activ { color: <?php echo $this->option_model->get_value('appcolortitlescolor'); ?>; border-bottom: 2px solid <?php echo $this->option_model->get_value('appcolortitlescolor'); ?>; }
    header { box-shadow: 0px 2px 4px rgba(0,0,0,0.1); background-color: <?php echo $this->option_model->get_value('appcolorbgheader'); ?>; }
    h2.areatitle, #gridselect a.activ { color: <?php echo $this->option_model->get_value('appcolortitlescolor'); ?>; }
    .stories h2 a, .storiesrecent h2 a, .topauthors h2 a, .storiesyesterday h2 a { color: <?php echo $this->option_model->get_value('appcolornewstitles'); ?>; }
    .stories h2 a:hover, .storiesrecent h2 a:hover, .topauthors h2 a:hover, .storiesyesterday h2 a:hover { color:<?php echo $this->option_model->get_value('appcolortitlescolor'); ?>; }
    footer { background-color:<?php echo $this->option_model->get_value('appcolorbgfooter'); ?>; } 
    footer h4 { color:<?php echo $this->option_model->get_value('appcolorfootertitles'); ?>; }
    footer p { color:<?php echo $this->option_model->get_value('appcolorfootertext'); ?>; }
    footer a { color:<?php echo $this->option_model->get_value('appcolorfooterlinks'); ?>; }
    .button-green { background:<?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; color:<?php echo $this->option_model->get_value('appcolorbuttonstext'); ?>; border: 2px solid <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; }
    .button-green:hover { background: <?php echo $this->option_model->get_value('appcolorbuttonsbghov'); ?>; color:<?php echo $this->option_model->get_value('appcolorbuttonstexth'); ?>; border-color:<?php echo $this->option_model->get_value('appcolorbuttonsbghov'); ?>; }
    .button-grey { background:#f8f8f8; }
    .button-grey:hover { background:#CCC; }
    .navbar-custom .nav li a:hover.button { background: <?php echo $this->option_model->get_value('appcolorbuttonsbghov'); ?>; color:<?php echo $this->option_model->get_value('appcolorbuttonstexth'); ?>; border-color:<?php echo $this->option_model->get_value('appcolorbuttonsbghov'); ?>; } 
    section.scorevoted { background-color: $this->option_model->get_value('appcolorbuttonsbg'); }
    .navbar-custom .nav li a:hover, .navbar-custom .nav li a:focus { color:<?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; }
        #filtrag h3 a.sel { background-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; border-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; }
        #sidebar h3 i { background-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; border-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; }
        footer h4 i { background-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; border-color: <?php echo $this->option_model->get_value('appcolorbuttonsbg'); ?>; }
    </style>
</head>

<body>

