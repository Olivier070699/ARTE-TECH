<?php
/**
* Plugin Name: Invoice Table
* Plugin URI: https://mainwp.com
* Description: This plugin create invoice table
* Version: 1.0.0
* Author: Olivier Decock
* Author URI: https://mainwp.com
* License: GPL2
*/

function invoice_activate(){
    global $wpdb;
    $invoice_table = $wpdb->prefix . "invoice";

    if($wpdb->get_var('SHOW TABLE LIKE ' . $invoice_table) != $invoice_table){
        $sql = 'CREATE TABLE ' . $invoice_table . '(
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            worked_hours INTEGER,
            total_price INTEGER,
            task_id INTEGER(10),
            PRIMARY KEY (id)
        )';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('invoice_activate_version', '1.0');
    }
}

register_activation_hook(__FILE__, 'invoice_activate');

?>