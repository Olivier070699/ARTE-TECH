<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARTE-TECH | <?php echo the_title(); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/style.css' ?>">
</head>
<body>
    <div class="sidebar">
       <?php wp_nav_menu() ?>
    </div>
    <div class="container">
        <?php
                if ( have_posts() ) 
                : while ( have_posts() ) : the_post();
                    the_content();
                endwhile; 
            endif;
        ?>
    </div>
    <?php wp_footer(); ?>
</body>
</html>