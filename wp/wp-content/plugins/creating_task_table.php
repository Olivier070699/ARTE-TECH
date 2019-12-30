<?php

/**
* Plugin Name: Task Table
* Plugin URI: https://mainwp.com
* Description: This plugin create task table
* Version: 1.0.0
* Author: Olivier Decock
* Author URI: https://mainwp.com
* License: GPL2
*/

function task_activate(){
    global $wpdb;
    $task_table = $wpdb->prefix . "task";

    if($wpdb->get_var('SHOW TABLE LIKE ' . $task_table) != $task_table){
        $sql = 'CREATE TABLE ' . $task_table . '(
            id INTEGER(10) UNSIGNED AUTO_INCREMENT,
            task_description VARCHAR(65000),
            materials VARCHAR(65000),
            client_id INTEGER(10),
            employe_id INTEGER(10),
            km INTEGER,
            datum DATE,
            start TIME,
            stop TIME,
            PRIMARY KEY (id)
        )';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('task_activate_version', '1.0');
    }
}

register_activation_hook(__FILE__, 'task_activate');

?>