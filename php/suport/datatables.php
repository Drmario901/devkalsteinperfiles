<?php
    // Agregar Chart.js y jQuery
function enqueue_datatable_js() {
    if ( ! wp_script_is( 'jquery', 'registered' ) ) {
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.7.0.min.js', array(), '3.7.0', false );
    }
    
    // Agregar Chart.js y jQuery
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'datatable-js', 'https://cdn.jsdelivr.net/npm/chart.js', array( 'jquery' ), '4.0.3', true );
}

add_action( 'wp_enqueue_scripts', 'enqueue_chart_js' );

?>