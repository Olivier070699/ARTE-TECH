<?php

/**
* Plugin Name: employe table
* Plugin URI: https://mainwp.com
* Description: This plugin create employe table
* Version: 1.0.0
* Author: Olivier Decock
* Author URI: https://mainwp.com
* License: GPL2
*/

function employe_activate(){
    global $wpdb;
    $employe_table = $wpdb->prefix . "employe";

    if($wpdb->get_var('SHOW TABLE LIKE ' . $employe_table) != $employe_table){
        $sql = 'CREATE TABLE ' . $employe_table . '(
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            name VARCHAR(255),
            freelancer BIT DEFAULT 1,
            PRIMARY KEY (id)
        )';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('employe_activate_version', '1.0');
    }
}

register_activation_hook(__FILE__, 'employe_activate');

?>

<!-- BIT 0=false, 1=true -->