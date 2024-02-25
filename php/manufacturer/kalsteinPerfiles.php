<?php
    /*
        Plugin Name: Kalstein - Perfiles
        Description:  Plugin desarrollado para la administración de los distintos roles de las distintas cuentas!
        Author: Alejandro Espidea
        Author URI: https://github.com/tzAreg
        Version: 0.0.1
    */

    //REQUIRED    
    require_once dirname(__FILE__) . '/php/shortcode.php';

    //ACTIVATED
    function perfilesActivated(){

    }

    //DEACTIVATED
    function perfilesDeactivated(){

    }

    register_activation_hook(__FILE__, 'perfilesActivated');

    register_deactivation_hook(__FILE__, 'perfilesDeactivated');

    // XXX SHORTCODE CUENTAS Y CLIENTE XXX
    function loginPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->login();
        return $html;
    }

    function signupPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->signup();
        return $html;
    }

    function registerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->register();
        return $html;
    }

    function dashboardPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->dashboard();
        return $html;
    }

    function accountRedirectPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->account_redirect();
        return $html;
    }

    function createCotizacionPerfiles(){
        $html = "&nbsp";
        return $html;
    }

    function btnLoginSignup(){
        $html = "&nbsp";
        return $html;
    }

    // XXX SHORTCODE FABRICANTE XXX

    function dashboardManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_dashboard();
        return $html;
    }

    function stockManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_stock();
        return $html;
    }

    function stockPreviewManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_stock_preview();
        return $html;
    }

    function stockAddManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_stock_add();
        return $html;
    }

    function stockEditManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_stock_edit();
        return $html;
    }

    function listOrderManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_list_order();
        return $html;
    }

    function listOrderProcessedManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_list_order_processed();
        return $html;
    }

    function listOrderCancelledManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_list_order_cancelled();
        return $html;
    }

    function salesReportManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_sales_report();
        return $html;
    }

    function shippingCostsManufacturerPerfiles(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_shipping_costs();
        return $html;
    }

    function inboxPerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_manufacturer();
        return $html;
    }

    function inboxViewPerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_manufacturer_view();
        return $html;
    }

    function inboxComposePerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_manufacturer_compose();
        return $html;
    }

    function inboxSentPerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_manufacturer_sent();
        return $html;
    }
    
    function inboxSentViewPerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_manufacturer_view_sent();
        return $html;
    }

    // XXX DISTRIBUTOR XXX

    function dashboardPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->dashboard_distributor();
        return $html;
    }

    function stockPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->stock_distributor();
        return $html;
    }
    
    function stockAddPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->stock_add_distributor();
        return $html;
    }

    function stockEditPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->stock_edit_distributor();
        return $html;
    }

    function stockShippingPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->stock_shipping_distributor();
        return $html;
    }

    function listOrderPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->list_order_distributor();
        return $html;
    }

    function listOrderProcessedPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->list_order_processed_distributor();
        return $html;
    }

    function listOrderCancelledPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->list_order_cancelled_distributor();
        return $html;
    }

    function salesPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->sales_distributor();
        return $html;
    }

    function inboxPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_distributor();
        return $html;
    }

    function inboxViewPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_distributor_view();
        return $html;
    }

    function inboxComposePerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_distributor_compose();
        return $html;
    }

    function inboxSentPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_distributor_sent();
        return $html;
    }
    
    function inboxSentViewPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->inbox_distributor_view_sent();
        return $html;
    }

    // XXX CUENTAS Y CLIENTE XXXX

    add_shortcode("PERFILES_LOGIN", "loginPerfiles");
    add_shortcode("PERFILES_SIGNUP", "signupPerfiles");
    add_shortcode("PERFILES_REGISTER", "registerPerfiles");
    add_shortcode("PERFILES_REDIRECT", "accountRedirectPerfiles");
    add_shortcode("PERFILES_DASHBOARD", "dashboardPerfiles");
    add_shortcode("PERFILES_DATAUSERS", "createCotizacionPerfiles");
    add_shortcode("PERFILES_BTNLOGINSIGNUP", "btnLoginSignup");

    // XXX FABRICANTE XXX

    add_shortcode("PERFILES_MANUFACTURER_DASHBOARD", 'dashboardManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_STOCK", 'stockManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_STOCK_PREVIEW", 'stockPreviewManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_STOCK_ADD", 'stockAddManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_STOCK_EDIT", 'stockEditManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_LIST_ORDER", 'listOrderManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_LIST_ORDER_PROCESSED", 'listOrderProcessedManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_LIST_ORDER_CANCELLED", 'listOrderCancelledManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_SALES_REPORT", 'salesReportManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_SHIPPING_COSTS", 'shippingCostsManufacturerPerfiles');
    add_shortcode("PERFILES_MANUFACTURER_INBOX", "inboxPerfilesManufacturer");
    add_shortcode("PERFILES_MANUFACTURER_INBOX_SENT", "inboxSentPerfilesManufacturer");
    add_shortcode("PERFILES_MANUFACTURER_INBOX_VIEW", "inboxViewPerfilesManufacturer");
    add_shortcode("PERFILES_MANUFACTURER_INBOX_VIEW_SENT", "inboxSentViewPerfilesManufacturer");
    add_shortcode("PERFILES_MANUFACTURER_INBOX_COMPOSE", "inboxComposePerfilesManufacturer");

    // XXX DISTRIBUTOR XXX

        add_shortcode("PERFILES_DASHBOARD_DISTRIBUTOR", "dashboardPerfilesDistributor");
        add_shortcode("PERFILES_STOCK_DISTRIBUTOR", "stockPerfilesDistributor");
        add_shortcode("PERFILES_STOCK_DISTRIBUTOR_ADD", "stockAddPerfilesDistributor");
        add_shortcode("PERFILES_STOCK_DISTRIBUTOR_EDIT", "stockEditPerfilesDistributor");
        add_shortcode("PERFILES_STOCK_DISTRIBUTOR_SHIPPING", "stockShippingPerfilesDistributor");
        add_shortcode("PERFILES_LIST_ORDER_DISTRIBUTOR", "listOrderPerfilesDistributor");
        add_shortcode("PERFILES_LIST_ORDER_PROCESSED_DISTRIBUTOR", "listOrderProcessedPerfilesDistributor");
        add_shortcode("PERFILES_LIST_ORDER_CANCELLED_DISTRIBUTOR", "listOrderCancelledPerfilesDistributor");
        add_shortcode("PERFILES_SALES_DISTRIBUTOR", "salesPerfilesDistributor");
        add_shortcode("PERFILES_DISTRIBUTOR_INBOX", "inboxPerfilesDistributor");
        add_shortcode("PERFILES_DISTRIBUTOR_INBOX_SENT", "inboxSentPerfilesDistributor");
        add_shortcode("PERFILES_DISTRIBUTOR_INBOX_VIEW", "inboxViewPerfilesDistributor");
        add_shortcode("PERFILES_DISTRIBUTOR_INBOX_VIEW_SENT", "inboxSentViewPerfilesDistributor");
        add_shortcode("PERFILES_DISTRIBUTOR_INBOX_COMPOSE", "inboxComposePerfilesDistributor");

    //Shortcode Styles
    function perfiles_styles() {
        function general_client_styles(){
            wp_enqueue_script('JS', plugins_url('src/js/btnLoginRegister.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/styles.btnLoginSingup.css', __FILE__));            
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
        }

        global $post;
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LOGIN' ) ) {
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/login.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/login.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            general_client_styles();
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_SIGNUP' ) ) {
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/login.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/login.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            general_client_styles();
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_REGISTER' ) ) {
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/register.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/register.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            general_client_styles();
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DASHBOARD' ) ) {
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));  
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('ListJS', plugins_url('src/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('ChartJS', plugins_url('src/js/chart.umd.min.js',__FILE__),array('jquery'));            
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            //navbar script
            wp_enqueue_script('nav', plugins_url('src/js/nav.js',__FILE__),array('jquery'));
            general_client_styles();
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DATAUSERS' ) ) {
            wp_enqueue_script('JS', plugins_url('src/js/dashboard2.script.js',__FILE__),array('jquery'));
            general_client_styles();
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_BTNLOGINSIGNUP' ) ) {
            wp_enqueue_script('JS', plugins_url('src/js/btnLoginRegister.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/styles.btnLoginSingup.css', __FILE__));            
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));  
            general_client_styles();
        }

        // XXX ESTILOS FABRICANTE XXX

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_DASHBOARD' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-js', plugins_url('src/manufacturer/js/chart.js',__FILE__), array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js',__FILE__), array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK' ) ) {
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK_PREVIEW' ) ) {
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quan-calc', plugins_url('src/manufacturer/js/quantity.calculator.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
        }
        
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK_ADD' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK_EDIT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('fetch-product-data', plugins_url('src/manufacturer/js/fetch.data.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER' ) ) {
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('alertify-js', plugins_url('src/alertifyjs/alertify.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'alertify-css', plugins_url('src/alertifyjs/css/alertify.min.css', __FILE__));
            wp_enqueue_style( 'alertify-css', plugins_url('src/alertifyjs/css/alertify.rtl.min.css', __FILE__));
            wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER_PROCESSED' ) ) {
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER_CANCELLED' ) ) {
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_SALES_REPORT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('sales-chart-js', plugins_url('src/manufacturer/js/sales.chart.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js',__FILE__), array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_SHIPPING_COSTS' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('uncheck-form-fields', plugins_url('src/manufacturer/js/uncheck.form.fields.js',__FILE__),array('jquery'));
            wp_enqueue_script('fetch-product-data', plugins_url('src/manufacturer/js/fetch.data.shipping.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_INBOX' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_INBOX_SENT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_INBOX_VIEW' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_INBOX_VIEW_SENT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_INBOX_COMPOSE' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/manufacturer/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('inbox-js', plugins_url('src/manufacturer/js/inbox.js',__FILE__),array('jquery'));
            wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        // XXX DISTRIBUTOR XXX

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DASHBOARD_DISTRIBUTOR' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            //Dashboard styles 
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/dashboard.style.css', __FILE__));
            //material icons Google
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            //js for bootstrap
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            //navbar script
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            //dashboard script
            wp_enqueue_script('dashboard-script', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-g', plugins_url('src/distributor/js/chart_distributor.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/list.style.css', __FILE__));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/distributor/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('table-data', plugins_url('src/distributor/js/table.data.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_ADD' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/distributor/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js',__FILE__),array('jquery'));
        }

        
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_EDIT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/distributor/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_SHIPPING' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('uncheck-form-fields', plugins_url('src/distributor/js/uncheck.form.fields.js',__FILE__),array('jquery'));
            wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.shipping.js',__FILE__),array('jquery'));
            wp_enqueue_script('calc-js', plugins_url('src/distributor/js/show.calculator.js',__FILE__),array('jquery'));
        }

   
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LIST_ORDER_DISTRIBUTOR' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LIST_ORDER_PROCESSED_DISTRIBUTOR' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LIST_ORDER_CANCELLED_DISTRIBUTOR' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_SALES_DISTRIBUTOR' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/list.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-g', plugins_url('src/distributor/js/chart.js.sales.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-d', plugins_url('src/distributor/js/chart_distributor.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_INBOX' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_INBOX_SENT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_INBOX_VIEW' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_INBOX_VIEW_SENT' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_INBOX_COMPOSE' ) ) {
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('inbox-js', plugins_url('src/distributor/js/inbox.js',__FILE__),array('jquery'));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

    }
    add_action( 'wp_enqueue_scripts', 'perfiles_styles' );