<?php
function enqueue_my_custom_script() {
    wp_enqueue_script( 'add-form', '/wp-content/themes/artetech/js/add-form.js', false );
}
enqueue_my_custom_script();?>