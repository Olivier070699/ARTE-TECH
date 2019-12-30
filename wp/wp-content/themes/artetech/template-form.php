<?php /* Template Name: task-form */ ?>
<!-- Voorlopig wordt er alleen nog maar met uren gerekend -->

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
                    <input class="wpcf7-submit" type="submit" value="submit" required/>
            </div>
        </form>
        <form method="POST" action="">
            <div id="client-checkout">
                <select name="task" required>
                    <option value="" disabled selected>Select your client</option> <!-- naam employé moet hier bij komen -->
                    <?php
                      global $wpdb;
                      $clients = $wpdb->get_results( "SELECT wp_client.client_name, wp_task.id FROM wp_client INNER JOIN wp_task ON wp_task.client_id = wp_client.id WHERE wp_task.stop is null ORDER BY wp_client.client_name ASC", ARRAY_A  );
                      $amount_of_clients = count($clients);
                      for($i=0; $i<$amount_of_clients; $i++){
                          $client = $clients[$i]['client_name'];
                          $id = $clients[$i]['id'];
                    ?>
                      <option value="<?php echo $id; ?>"><?php echo $client; ?></option>  
                    <?php
                      }
                    ?>
                </select>
                <input type="text" name="materials" placeholder="wich materials did you use?" required/>
                <textarea placeholder="what did you do?" name="description" required></textarea>
                <input class="wpcf7-submit" type="submit" value="submit"/>
            </div>
            
        </form>
    </div>
    <?php wp_footer(); ?>
</body>
</html>

<?php
    if($_POST['km'] != null){
        // beginning the task
        global $wpdb;
        $client_id = $_POST['client'];
        $km = $_POST['km'];
        $start = date("H:i:s");
        $date = date("Y-m-d");

        $task_table = $wpdb->prefix . "task";
        $wpdb->insert($task_table, array('client_id' => $client_id, 'km' => $km, 'start' => $start, 'datum' => $date) ); 
        header('Location:/add-task');

    }else if($_POST['description'] != null){
        // ending the task
        global $wpdb;
        $task_id = $_POST['task'];
        $stop = date("H:i:s");
        $materials = $_POST['materials'];
        $description = $_POST['description'];

        $task_table = $wpdb->prefix . "task";
        $wpdb->update($task_table, array('task_description' => $description, 'materials' => $materials, 'stop' => $stop), array('id'=>$task_id));
        
        // counting the houres to calculate the bill
        $houres = $wpdb->get_results( "SELECT * FROM $task_table WHERE id = $task_id", ARRAY_A  );
        $start_hour = $houres[0]['start'];
        $stop_hour = $houres[0]['stop'];
        
        $dteStart = new DateTime($start_hour);
        $dteEnd   = new DateTime($stop_hour);

        $dteDiff  = $dteStart->diff($dteEnd);
        $worked_houres = $dteDiff->format("%H:%I:%S");

        $hour_price = 15;
        $price = 0;

        if($worked_houres*1 <= 8){
            $price = $worked_houres * $hour_price;
        }else if($worked_houres*1 > 8 && date('l') === 'Saturday'){
            $price = $worked_houres * ($hour_price*1.5);
        }else if($worked_houres*1 > 8 && date('l') === 'Sunday'){
            $price = $worked_houres * ($hour_price*2);
        }
        
        $invoice_table = $wpdb->prefix . "invoice";
        $wpdb->insert($invoice_table, array('worked_hours' => $worked_houres, 'total_price' => $price, 'task_id' => $task_id) ); 
        header('Location:/add-task');
    }