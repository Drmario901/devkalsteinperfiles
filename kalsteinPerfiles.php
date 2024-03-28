<?php
/*     ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); */
    /*
        Plugin Name: Kalstein - Perfiles
        Description:  Plugin desarrollado para la administración de los distintos roles de las distintas cuentas!
        Author: Alejandro Espidea con colaboracion de Ricardo Leañez, Jose Alejandro y Edithson Maestracci.
        Author URI: https://platform.kalstein.us
        Version: 1.0 (Beta)
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

    function editProfilePerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_edit_profile();
        return $html;
    }

    function catalogsPerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_catalogs();
        return $html;
    }

    function pursachingPerfilesManufacturer(){
        $_short = new shortcodePerfiles;

        $html = $_short->manufacturer_pursaching();
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

    function stockPreviewPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->stock_distributor_preview();
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

    function editProfilePerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->distributor_edit_profile();
        return $html;
    }

    function catalogsPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->distributor_catalogs();
        return $html;
    }

    function pursachingPerfilesDistributor(){
        $_short = new shortcodePerfiles;

        $html = $_short->distributor_pursaching();
        return $html;
    }

    // XXX SUPPORT XXX

    function dashboard_suport(){
        $_short = new shortcodePerfiles;
    
        $html = $_short->dashboard_suport();
        return $html;
    }
    
    function reportes_suport(){
    $_short= new shortcodeperfiles;    
    
    $html = $_short->reports_suport();
    return $html;
    }
    function reportesadd_suport(){
        $_short= new shortcodeperfiles;    
    
        $html = $_short->reports_add_suport();
        return $html;
        }
    
    function reportesmod_suport(){
         $_short= new shortcodeperfiles;    
        
          $html = $_short->reports_mod_suport();
            return $html;
    }
    
    function services_suport(){
        $_short= new shortcodeperfiles;    
       
         $html = $_short->service_suport();
           return $html;
    }
    function servicesadd_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->serviceadd_suport();
       return $html;
    }
    function servicesmod_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->servicemod_suport();
       return $html;
    }
    
    function quotes_Suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->Quotes_suport();
       return $html;
    }
    function quotesProcessed_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->quotesprocessed_suport();
       return $html;
    }
    function quotescanceled_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->quotescanceled_suport();
       return $html;
    }
    
    function inbox_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->inbox_suport();
       return $html;
    }
    function inboxsent_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->mailsSuportsent_suport();
       return $html;
    }
    function inboxsentview_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->mailsSuportsentview();
       return $html;
    }
    function inboxview_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->emailSuportview();
       return $html;
    }
    function compose_suport(){
    $_short= new shortcodeperfiles;    
    
     $html = $_short->emailcompose_suport();
       return $html;
    }
    
    
    function stock_suport(){
    
    $_short= new shortcodeperfiles;    
    
     $html = $_short->stock_suport();
       return $html;
    
    }
    
    function catalogo_suport(){
    
    $_short= new shortcodeperfiles;    
        
    $html = $_short->catalogo();
     return $html;
        
     }

    
    function supportEditProfile(){
        
    $_short= new shortcodeperfiles;    
                
    $html = $_short->support_edit_profile();
    return $html;
                
    }
    function pursachingPerfilesSupport(){
        $_short = new shortcodePerfiles;

        $html = $_short->support_pursaching();
        return $html;
    }

     //XX RENTAL AND EQUIPMENT SALE

     function rentalPerfilesDashboard(){
        $_short = new shortcodePerfiles;
    
        $html = $_short->rentalsale_dashboard();
        return $html;
    }

    function rentalPerfilesStock(){
        $_short = new shortcodePerfiles;

        $html = $_short->rentalsale_stock();
        return $html;
    }

    function rentalPerfilesStockAdd(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_stock_add();
        return $html;
    }

    function rentalPerfilesStockUsed(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_stock_used();
        return $html;
    }

    function rentalPerfilesStockEdit(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_stock_edit();
        return $html;
    }

    function rentalPerfilesListOrder(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_order();
        return $html;
    }

    function rentalPerfilesListOrderProcessed(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_order_proccesed();
        return $html;
    }

    function rentalPerfilesListOrderCancelled(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_order_cancelled();
        return $html;
    }

    function rentalPerfilesCustomers(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_customers();
        return $html;
    }

    function rentalPerfilesSales(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_sales();
        return $html;
    }

    function rentalPerfilesInbox(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_inbox();
        return $html;
    }

    function rentalPerfilesEditProfile(){
        $_short = new shortcodePerfiles;
        
        $html = $_short->rentalsale_edit_profile();
        return $html;
    }


    // MODERATOR

    function PerfilesModeratorDashboard(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_dashboard();
        return $html;
    }
    function PerfilesModeratorProduct(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_product();
        return $html;
    }
    function PerfilesModeratorQuotes(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_quotes();
        return $html;
    }
    function PerfilesModeratorBitacoras(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_bitacora();
        return $html;
    }
    function PerfilesModeratorShipping(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_shipping();
        return $html;
    }
    function PerfilesModeratorViewProduct(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_view_product();
        return $html;
    }
    function PerfilesModeratorViewAccount(){

        $_short = new shortcodePerfiles;

        $html = $_short->moderator_view_account();
        return $html;
    }

    function data_recoverP(){
        $_short = new shortcodePerfiles;

        $html = $_short->data_recover();
        return $html;
    }

    function perfiles_recover_password(){
        $_short = new shortcodePerfiles;

        $html = $_short->recoveryPassword();
        return $html;
    }

    function perfiles_customize_template_quotes(){
        $_short = new shortcodePerfiles;

        $html = $_short->customize_template();
        return $html;
    }

    add_shortcode("PERFILES_DATA_RECOVER", "data_recoverP");

    // XXX CUENTAS Y CLIENTE XXXX

    add_shortcode("PERFILES_LOGIN", "loginPerfiles");
    add_shortcode("PERFILES_SIGNUP", "signupPerfiles");
    add_shortcode("PERFILES_REGISTER", "registerPerfiles");
    add_shortcode("PERFILES_REDIRECT", "accountRedirectPerfiles");
    add_shortcode("PERFILES_DASHBOARD", "dashboardPerfiles");
    add_shortcode("PERFILES_DATAUSERS", "createCotizacionPerfiles");
    add_shortcode("PERFILES_BTNLOGINSIGNUP", "btnLoginSignup");
    add_shortcode("PERFILES_RECOVERY_PASSWORD", "perfiles_recover_password");

    // XXX CUSTOMIZE TEMPLATES QUOTES XXX
    add_shortcode("PERFILES_CUSTOMIZE_TEMPLATE_QUOTES", "perfiles_customize_template_quotes");

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
    add_shortcode("PERFILES_MANUFACTURER_EDIT_PROFILE", "editProfilePerfilesManufacturer");
    add_shortcode("PERFILES_MANUFACTURER_CATALOGS", "catalogsPerfilesManufacturer");
    add_shortcode("PERFILES_MANUFACTURER_PURSACHING", "pursachingPerfilesManufacturer");

    // XXX DISTRIBUTOR XXX

    add_shortcode("PERFILES_DASHBOARD_DISTRIBUTOR", "dashboardPerfilesDistributor");
    add_shortcode("PERFILES_STOCK_DISTRIBUTOR", "stockPerfilesDistributor");
    add_shortcode("PERFILES_STOCK_DISTRIBUTOR_ADD", "stockAddPerfilesDistributor");
    add_shortcode("PERFILES_STOCK_DISTRIBUTOR_EDIT", "stockEditPerfilesDistributor");
    add_shortcode("PERFILES_STOCK_DISTRIBUTOR_PREVIEW", "stockPreviewPerfilesDistributor");
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
    add_shortcode("PERFILES_DISTRIBUTOR_EDIT_PROFILE", "editProfilePerfilesDistributor");
    add_shortcode("PERFILES_DISTRIBUTOR_CATALOGS", "catalogsPerfilesDistributor");
    add_shortcode("PERFILES_DISTRIBUTOR_PURSACHING", "pursachingPerfilesDistributor");


    //XX SUPPORT XX//

    add_shortcode("SUPORT_DASHBOARD", "dashboard_suport");
    add_shortcode("SUPORT_REPORTS", "reportes_suport");
    add_shortcode("SUPORT_ADDREPORTS", "reportesadd_suport");
    add_shortcode("SUPORT_MODREPORTS", "reportesmod_suport");  
    add_shortcode("SUPORT_SERVICES", "services_suport");
    add_shortcode("SUPORT_SERVICESADD", "servicesadd_suport");
    add_shortcode("SUPORT_SERVICESMOD", "servicesmod_suport");
    add_shortcode("SUPORT_QUOTES", "quotes_Suport");
    add_shortcode("SUPORT_QUOTESPROCESSED","quotesProcessed_suport");
    add_shortcode("SUPORT_QUOTESCANCELLED", "quotescanceled_suport");
    add_shortcode("SUPORT_INBOX","inbox_suport");
    add_shortcode("SUPORT_INBOX_SENT","inboxsent_suport");
    add_shortcode("SUPORT_INBOX_VIEW","inboxview_suport");
    add_shortcode("SUPORT_INBOX_VIEW_SENT","inboxsentview_suport");
    add_shortcode("SUPORT_INBOX_COMPOSE","compose_suport");
    add_shortcode("SUPORT_STOCK","stock_suport"); 
    add_shortcode("SUPORT_CATALOGO","catalogo_suport"); 
    add_shortcode("SUPORT_EDIT_PROFILE","supportEditProfile");
    add_shortcode("SUPORT_PURSACHING","pursachingPerfilesSupport");

    // RENTAL AND USED EQUIPMENT

    /*add_shortcode("RENTAL_DASHBOARD","rentalPerfilesDashboard");
    add_shortcode("RENTAL_STOCK","rentalPerfilesStock");
    add_shortcode("RENTAL_STOCK_ADD","rentalPerfilesStockAdd");
    add_shortcode("RENTAL_USED","rentalPerfilesStockUsed");
    add_shortcode("RENTAL_STOCK_EDIT","rentalPerfilesStockEdit");
    add_shortcode("RENTAL_ORDER","rentalPerfilesListOrder");
    add_shortcode("RENTAL_COSTUMERS","rentalPerfilesCustomers");
    add_shortcode("RENTAL_ORDER_PROCESSED","rentalPerfilesListOrderProcessed");
    add_shortcode("RENTAL_ORDER_CANCELLED","rentalPerfilesListOrderCancelled");
    add_shortcode("RENTAL_SALES","rentalPerfilesSales");
    add_shortcode("RENTAL_INBOX","rentalPerfilesInbox");
    add_shortcode("RENTAL_EDIT_PROFILE","rentalPerfilesEditProfile");*/


    // MODERATOR //

    add_shortcode("MODERATOR_DASHBOARD", "PerfilesModeratorDashboard");
    add_shortcode("MODERATOR_PRODUCT", "PerfilesModeratorProduct");
    add_shortcode("MODERATOR_QUOTES", "PerfilesModeratorQuotes");
    add_shortcode("MODERATOR_SHIPPING", "PerfilesModeratorShipping");
    add_shortcode("MODERATOR_VIEW_PRODUCT", "PerfilesModeratorViewProduct");
    add_shortcode("MODERATOR_VIEW_ACCOUNT", "PerfilesModeratorViewAccount");
    add_shortcode("MODERATOR_BITACORAS", "PerfilesModeratorBitacoras");

    //Shortcode Styles


    //CHECK DOCUMENTATION FOR LINK

        function global_url() {
            wp_enqueue_script('global-url', plugins_url('src/js/links.upload.js',__FILE__),array('jquery'));
        }       
    
        function translations() {
            wp_enqueue_script('i18next', plugins_url('src/js/i18next.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('i18n', plugins_url('src/js/i18n.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-3.4.0', plugins_url('src/js/jquery-migrate-3.4.0.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-i18n', plugins_url('src/js/jquery-i18next.min.js',__FILE__),array('jquery'));
        }

    function perfiles_styles() {

         //MAIN URLS
        $plugin_dir = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles';
        $plugin_quote = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion';

        function general_client_styles(){
            wp_enqueue_script('JS', plugins_url('src/js/btnLoginRegister.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/styles.btnLoginSingup.css', __FILE__));            
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));         
            wp_enqueue_style( 'signaling-css', plugins_url('src/css/signaling.css', __FILE__));            
            wp_enqueue_script('signaling-js', plugins_url('src/js/signaling.js',__FILE__),array('jquery'));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
        }

        global $post;

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LOGIN' ) ) {
            global_url();
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/login.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/login.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-3.4.0', plugins_url('src/js/jquery-migrate-3.4.0.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('i18n', plugins_url('src/js/i18n.js',__FILE__),array('jquery'));
            /*wp_enqueue_script('session-script', plugins_url('src/js/session.script.js',__FILE__),array('jquery'));*/
            general_client_styles();    
        }
        
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_SIGNUP' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/login.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/login.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('session-script', plugins_url('src/js/session.script.js',__FILE__),array('jquery'));
            general_client_styles();         
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_REGISTER' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/register.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/register.script00.js',__FILE__),array('jquery'));
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            general_client_styles();
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DASHBOARD' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));  
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('ListJS', plugins_url('src/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('ChartJS', plugins_url('src/js/chart.umd.min.js',__FILE__),array('jquery'));            
            wp_enqueue_script('woo-model-table-lib', plugins_url('src/js/product.ref.to.table.js',__FILE__),array('jquery')); //
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery')); //
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery')); 
            //navbar script
            wp_enqueue_script('nav', plugins_url('src/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            //INBOX
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));

            //CATALOGS 
            wp_enqueue_style( 'dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
            wp_enqueue_style( 'themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('catalogo', plugins_url('src/js/catalog.js',__FILE__),array('jquery')); //
            wp_enqueue_script('input-control', plugins_url('src/js/input.control.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js',__FILE__),array('jquery')); 
            //QUOTE 
            wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js',__FILE__),array('jquery'));  //
            general_client_styles();
            
            //COTIZACION_KALSTEIN 
            wp_enqueue_script('quote-script-js', ''.$plugin_quote.'/assets/js/script.cot2.js', array('jquery'), true); //
            wp_enqueue_style( 'quote-css', ''.$plugin_quote.'/assets/css/styles.cot.css', true); // 
            
            //inbox JS
            wp_enqueue_script('inbox-pages-js', ''.$plugin_dir.'/src/js/inbox.pages.js', array('jquery'), true); // 

            //Banner and footer
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__)); // 
            
            //File Drop
            
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));

            wp_enqueue_script('anchors-js', plugins_url('src/js/anchors.script.js',__FILE__),array('jquery'));

            //DIAGNOSIS APP JS 

            wp_enqueue_script('diag-pages', plugins_url('src/js/diag.pages.js',__FILE__),array('jquery'));

        }
        
        //NOBODY KNOWS WTF IS THIS
        /*if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DATAUSERS' ) ) {
            wp_enqueue_script('JS', plugins_url('src/js/dashboard2.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/css/styles.TemplateQuoteEdit.css', __FILE__));
            general_client_styles();
        }*/
        //GLOBAL URL PENDING
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_CUSTOMIZE_TEMPLATE_QUOTES' ) ) {
            wp_enqueue_style( 'css', plugins_url('src/css/styles.TemplateQuoteEdit.css', __FILE__));
            wp_enqueue_script('JS', plugins_url('src/js/dashboard2.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('izitoast-js', plugins_url('src/js/script.TemplateQuoteEdit.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));

            general_client_styles();
        }
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_BTNLOGINSIGNUP' ) ) {
            global_url();
            wp_enqueue_script('JS', plugins_url('src/js/btnLoginRegister.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/styles.btnLoginSingup.css', __FILE__));            
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));  
            general_client_styles();
        }
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_RECOVERY_PASSWORD' ) ) {
            global_url();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/login.style.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/login.script.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('sessionPHP-js', plugins_url('src/js/recoveryPassword.script.js',__FILE__),array('jquery')); // 
            general_client_styles();
        }
        
        // XXX ESTILOS FABRICANTE XXX

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_DASHBOARD' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js',__FILE__), array('jquery')); 
            wp_enqueue_script('chartjs-js', plugins_url('src/manufacturer/js/chart9.js',__FILE__), array('jquery')); //

            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); //
        }
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); // 
        }
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK_PREVIEW' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quan-calc', plugins_url('src/manufacturer/js/quantity.calculator.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('accesorie-preview', plugins_url('src/manufacturer/js/accessories/accessorie.preview.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK_ADD' ) ) {
            translations();
            global_url();

            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery')); 
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('accesories-requests', plugins_url('src/manufacturer/js/accessories/accessories.requests.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_STOCK_EDIT' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery')); //
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); //
            wp_enqueue_script('accesories-requests', plugins_url('src/manufacturer/js/accessories/accessories.requests.js',__FILE__),array('jquery')); //
            wp_enqueue_script('fetch-product-data', plugins_url('src/manufacturer/js/fetch.data.js',__FILE__),array('jquery')); //
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); //
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__)); 
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('alertify-js', plugins_url('src/alertifyjs/alertify.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'alertify-css', plugins_url('src/alertifyjs/css/alertify.min.css', __FILE__));
            wp_enqueue_style( 'alertify-css', plugins_url('src/alertifyjs/css/alertify.rtl.min.css', __FILE__));
            wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js',__FILE__),array('jquery')); //
        }
        
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER_PROCESSED' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__)); 
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery')); 
        }
        
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER_CANCELLED' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_SALES_REPORT' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js',__FILE__), array('jquery'));
            wp_enqueue_script('sales-chart-js', plugins_url('src/manufacturer/js/sales.chart.js',__FILE__),array('jquery')); // 
        }
        
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_SHIPPING_COSTS' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('uncheck-form-fields', plugins_url('src/manufacturer/js/uncheck.form.fields.js',__FILE__),array('jquery'));
            wp_enqueue_script('fetch-product-data', plugins_url('src/manufacturer/js/fetch.data.shipping.js',__FILE__),array('jquery'));
            wp_enqueue_script('calc-js', plugins_url('src/distributor/js/show.calculator.js',__FILE__),array('jquery')); //
        }
        
        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_INBOX' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('inbox-pages-js', ''.$plugin_dir.'/src/js/inbox.pages.js', array('jquery'), true); //
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_EDIT_PROFILE' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery')); 
            wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_CATALOGS' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('catalog-script', plugins_url('src/js/catalog.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
            wp_enqueue_style( 'themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
            wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js',__FILE__),array('jquery')); 
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_MANUFACTURER_PURSACHING' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quote-script-js', ''.$plugin_quote.'/assets/js/script.cot2.js', array('jquery'), true);
            wp_enqueue_style( 'quote-css', ''.$plugin_quote.'/assets/css/styles.cot.css', true);
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js',__FILE__),array('jquery'));
            wp_enqueue_script('pursaching-script', plugins_url('src/manufacturer/js/pursaching.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
        }

        // XXX DISTRIBUTOR XXX

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DASHBOARD_DISTRIBUTOR' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js',__FILE__), array('jquery')); 
            wp_enqueue_script('chartjs-js', plugins_url('src/distributor/js/chart1.js',__FILE__), array('jquery')); // 
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); //
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery')); 
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__)); 
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery')); 
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery')); //  
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_ADD' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/productRequest.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('accessory-requests', plugins_url('src/distributor/js/accesories/accessories.requests.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }
        
        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_EDIT' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery')); //
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery')); //
            wp_enqueue_script('accesories-requests', plugins_url('src/distributor/js/accesories/accessories.requests.js',__FILE__),array('jquery')); //
            wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.js',__FILE__),array('jquery')); //
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_PREVIEW' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('quan-calc', plugins_url('src/manufacturer/js/quantity.calculator.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('accesorie-preview', plugins_url('src/manufacturer/js/accessories/accessorie.preview.js',__FILE__),array('jquery')); //
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_SHIPPING' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery')); //
            wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js',__FILE__),array('jquery')); //
            wp_enqueue_script('uncheck-form-fields', plugins_url('src/distributor/js/uncheck.form.fields.js',__FILE__),array('jquery')); //
            wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.shipping.js',__FILE__),array('jquery')); //
            wp_enqueue_script('calc-js', plugins_url('src/distributor/js/show.calculator.js',__FILE__),array('jquery')); // 
        } 
   
        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LIST_ORDER_DISTRIBUTOR' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__)); 
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery')); 
            wp_enqueue_script('cotization-details-show', plugins_url('src/distributor/js/show.cotizacion.details.js',__FILE__),array('jquery')); // 
        }

        //GLOBAL URL APPLIED 
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LIST_ORDER_PROCESSED_DISTRIBUTOR' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__)); 
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__)); 
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor3.js',__FILE__),array('jquery')); //
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__)); // 
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery')); 
            wp_enqueue_script('cotization-details-show', plugins_url('src/distributor/js/show.cotizacion.details.js',__FILE__),array('jquery')); //
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_LIST_ORDER_CANCELLED_DISTRIBUTOR' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery')); 
            wp_enqueue_script('cotization-details-show', plugins_url('src/distributor/js/show.cotizacion.details.js',__FILE__),array('jquery')); // 
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_SALES_DISTRIBUTOR' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js',__FILE__), array('jquery'));
            wp_enqueue_script('sales-chart-js', plugins_url('src/manufacturer/js/sales.chart.js',__FILE__),array('jquery')); //
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_INBOX' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery')); //
            wp_enqueue_style( 'email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('inbox-pages-js', ''.$plugin_dir. '/src/js/inbox.pages.js', array('jquery'), true); //
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_EDIT_PROFILE' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__)); 
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery')); //
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js',__FILE__),array('jquery')); // 
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_CATALOGS' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__)); 
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('catalog-script', plugins_url('src/js/catalog.js',__FILE__),array('jquery')); // 
            wp_enqueue_style( 'dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
            wp_enqueue_style( 'themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
            wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js',__FILE__),array('jquery')); 
        }

        //GLOBAL URL APPLIED
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DISTRIBUTOR_PURSACHING' ) ) {
            translations();
            global_url();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quote-script-js', ''.$plugin_quote.'/assets/js/script.cot2.js', array('jquery'), true);
            wp_enqueue_style( 'quote-css', ''.$plugin_quote.'/assets/css/styles.cot.css', true);
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js',__FILE__),array('jquery'));
            wp_enqueue_script('pursaching-script', plugins_url('src/distributor/js/pursaching.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        // XXX SUPPORT STYLES

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_DASHBOARD' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('chartjs-js', plugins_url('src/suport/js/chart.js',__FILE__),array('jquery'));
            wp_enqueue_script('chart-umd-js', plugins_url('src/suport/js/chart.umd.min.js',__FILE__), array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('Reportes', plugins_url('src/suport/js/reportes.js',__FILE__),array('jquery'));  
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_REPORTS' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));  
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_ADDREPORTS' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/suport/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS-SUPPORT', plugins_url('src/suport/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js',__FILE__),array('jquery'));
            wp_enqueue_script('script', plugins_url('src/suport/js/script.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_MODREPORTS' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style(' tamplatemo', plugins_url('admin\css\templatemo-style.css',__FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'nav-style', plugins_url('src/suport/css/stock.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js',__FILE__),array('jquery'));
            wp_enqueue_script('consulta.JS', plugins_url('src/suport/js/consulta.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_SERVICES' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('service.js', plugins_url('src/suport/js/serviceslist.js',__FILE__),array('jquery'));
            wp_enqueue_script('servicescheck.js', plugins_url('src/suport/js/servicescategory.js',__FILE__),array('jquery'));
            wp_enqueue_script('servicescheck.js', plugins_url('src/suport/js/servicescategory.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_SERVICESADD' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js',__FILE__),array('jquery'));
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('service.js', plugins_url('src/suport/js/serviceslist.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_SERVICESMOD' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js',__FILE__),array('jquery'));
            wp_enqueue_script('service.js', plugins_url('src/suport/js/serviceslist.js',__FILE__),array('jquery')); 
            wp_enqueue_script('servicesmod.js', plugins_url('src/suport/js/servicesmod.js',__FILE__),array('jquery')); 
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_QUOTES' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
            wp_enqueue_style( 'iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/css/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('quotes.js', plugins_url('src/suport/js/quotes.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_QUOTESPROCESSED' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
            wp_enqueue_style( 'iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/css/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('quotes.js', plugins_url('src/suport/js/quotes.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_QUOTESCANCELLED' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/css/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('quotes.js', plugins_url('src/suport/js/quotes.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_INBOX' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'email-style', plugins_url('src/suport/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_script('inbox-pages-js', 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/inbox.pages.js', array('jquery'), true);
            wp_enqueue_style( 'izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_STOCK' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
            wp_enqueue_style( 'iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('stock_suport', plugins_url('src/suport/js/suport_stock.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_CATALOGO' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/suport/css/material.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
            wp_enqueue_style( 'dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
            wp_enqueue_style( 'themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('catalogo', plugins_url('src/suport/js/catalogo.js',__FILE__),array('jquery'));
            wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('catalog-script', plugins_url('src/js/catalog.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_EDIT_PROFILE' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'SUPORT_PURSACHING' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quote-script-js', 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/js/script.cot2.js', array('jquery'), true);
            wp_enqueue_style( 'quote-css', 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/css/styles.cot.css', true);
            wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js',__FILE__),array('jquery'));
            wp_enqueue_script('pursaching-script', plugins_url('src/distributor/js/pursaching.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        //RENTAL AND USED EQUIPMENT
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_DASHBOARD' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__)); 
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-g', plugins_url('src/rentalsale/js/chart_rentalsale.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_STOCK' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_STOCK_ADD' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/rentalsale/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_USED' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/rentalsale/js/products.request.used.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_STOCK_EDIT' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_ORDER' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_ORDER_PROCESSED' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_ORDER_CANCELLED' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_COSTUMERS' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
            wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/rentalsale/js/products.request.used.js',__FILE__),array('jquery'));
            wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js',__FILE__),array('jquery'));
            wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_SALES' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/distributor/css/material.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'list-CSS', plugins_url('src/distributor/css/list.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-g', plugins_url('src/distributor/js/chart.js.sales.distributor.js',__FILE__),array('jquery'));
            wp_enqueue_script('test-d', plugins_url('src/distributor/js/chart_distributor.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_INBOX' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('inbox-pages-js', 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/inbox.pages.js', array('jquery'), true);
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'RENTAL_EDIT_PROFILE' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/manufacturer/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js',__FILE__),array('jquery'));
            wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
    
        // MODERADOR

        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_DASHBOARD' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));  
            wp_enqueue_style( 'CSS', plugins_url('src/moderator/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/moderator/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));

        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_PRODUCT' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_QUOTES' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quote-table', plugins_url('src/moderator/js/quote.table.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_BITACORAS' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quote-table', plugins_url('src/moderator/js/quote.table.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('log-table-js', plugins_url('src/moderator/js/log.table.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_SHIPPING' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_script('quote-shipping', plugins_url('src/moderator/js/quote.shipping.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_VIEW_PRODUCT' ) ) {
            translations();
            wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
            wp_enqueue_style( 'AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css',__FILE__));  
            wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('validate-product-js', plugins_url('src/moderator/js/validate.product.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'MODERATOR_VIEW_ACCOUNT' ) ) {
            translations();
            wp_enqueue_style( 'bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
            wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
            wp_enqueue_style( 'material', plugins_url('src/moderator/css/material.css', __FILE__));
            wp_enqueue_style( 'font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
            wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js',__FILE__),array('jquery'));
            wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
            wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
            wp_enqueue_script('validate-product-js', plugins_url('src/moderator/js/validate.account.js',__FILE__),array('jquery'));
        }
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DATA_RECOVER' ) ){
            translations();
            wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js',__FILE__),array('jquery'));
            wp_enqueue_style( 'izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
            wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js',__FILE__),array('jquery'));
        }
        
    }
    add_action( 'wp_enqueue_scripts', 'perfiles_styles' );