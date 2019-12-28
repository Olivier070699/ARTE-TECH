<?php

/**
* Plugin Name: Break Table
* Plugin URI: https://mainwp.com
* Description: This plugin create break table
* Version: 1.0.0
* Author: Olivier Decock
* Author URI: https://mainwp.com
* License: GPL2
*/

function break_activate(){
    global $wpdb;
    $break_table = $wpdb->prefix . "break";

    if($wpdb->get_var('SHOW TABLE LIKE ' . $break_table) != $break_table){
        $sql = 'CREATE TABLE ' . $break_table . '(
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            client_id INTEGER(10),
            employe_id INTEGER(10),
            datum Date,
            duration_break TIME,  
            PRIMARY KEY (id)
        )';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('break_activate_version', '1.0');
    }
}

register_activation_hook(__FILE__, 'break_activate');

?>