<?php /* Template Name: client-form */ ?>

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
        <form method="POST" action="">
            <input type="text" name="client" placeholder="client name" required/>
            <input type="text" name="street" placeholder="street" required/>
            <input type="number" name="number" placeholder="number" required/>
            <input type="text" name="city" placeholder="city" required/>
            <input class="wpcf7-submit" type="submit" value="submit"/>
        </form>
    </div>
    <?php wp_footer(); ?>
</body>
</html>

<?php
global $wpdb;
if($_POST['street'] != null){
    $client = $_POST['client'];
    $street = $_POST['street'];
    $number = $_POST['number'];
    $city = $_POST['city'];

    $adres = $street . ' ' . $number . ', ' . $city;
    $client_table = $wpdb->prefix . "client";
    $wpdb->insert($client_table, array('client_name' => $client, 'adres' => $adres) );
}

?>