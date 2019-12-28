<?php /* Template Name: task-form */ ?>

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
        <div>
            <input id="checkin-btn" type="radio" name="check-btn" value="checkin" checked><p>checkin</p>
            <input id="checkout-btn" type="radio" name="check-btn" value="checkout"><p>checkout</p>
        </div>
        <form method="POST" action="">
            <div id="client-checkin">
                <select name="client" required>
                    <option value="" disabled selected>Select your client</option>
                <?php
                    global $wpdb;
                    $clients = $wpdb->get_results( "SELECT * FROM wp_client ORDER BY client_name ASC", ARRAY_A  );
                    $amount_of_clients = count($clients);

                    for($i=0; $i < $amount_of_clients; $i++){
                        $client = $clients[$i]['client_name'];
                        $adres = $clients[$i]['adres'];
                ?>
                        <option value="<?php echo $clients[$i]['id']; ?>"><?php echo $client . ', ' . $adres; ?></option>
                <?php
                    }
                ?> 
                </select>
                    <input type="number" name="km" placeholder="amount of km" required/>
                    <input type="time" name="start" placeholder="start" required/>
                    <input class="wpcf7-submit" type="submit" value="submit" required/>
            </div>
        </form>
        <form method="POST" action="">
            <div id="client-checkout">
            
                <input type="time" name="stop" placeholder="stop" required/>
                <input type="text" name="materials" placeholder="wich materials did you use?" required/>
                <textarea placeholder="what did you do?" name="task" required></textarea>
                <input class="wpcf7-submit" type="submit" value="submit"/>
            </div>
            
        </form>
    </div>
    <?php wp_footer(); ?>
</body>
</html>

<?php
    if($_POST['client'] != null && $_POST['km'] != null && $_POST['start']){
        global $wpdb;
        $client_id = $_POST['client'];
        $km = $_POST['km'];
        $start = $_POST['start'];
        $date = date("Y-m-d");

        $task_table = $wpdb->prefix . "task";
        $wpdb->insert($task_table, array('client_id' => $client_id, 'km' => $km, 'start' => $start, 'datum' => $date) ); 
        header('Location:/add-task');

    }else if($_POST['stop'] != null && $_POST['materials'] != null && $_POST['task']){

    }

    // SELECT wp_client.client_name FROM wp_client
    // INNER JOIN wp_task
    // ON wp_task.client_id = wp_client.id
    // WHERE wp_task.datum = CURRENT_DATE