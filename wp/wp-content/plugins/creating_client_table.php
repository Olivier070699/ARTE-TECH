<?php
/**
* Plugin Name: Creating Client Tables
* Plugin URI: https://mainwp.com
* Description: This plugin creates the client table
* Version: 1.0.0
* Author: Olivier Decock
* Author URI: https://mainwp.com
* License: GPL2
*/

function client_activate(){
    global $wpdb;
    $client_table = $wpdb->prefix . "client";

    if($wpdb->get_var('SHOW TABLES LIKE ' . $client_table) != $client_table){
        $sql = 'CREATE TABLE ' . $client_table .'(
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            client_name VARCHAR(255),
            adres VARCHAR(255),
            PRIMARY KEY  (id))';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('creating_client_table_version' . '1.0');
    }
}

register_activation_hook(__FILE__, 'client_activate');

?>