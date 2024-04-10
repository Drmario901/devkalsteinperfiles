<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
    Plugin Name: Kalstein - Perfiles
    Description:  Plugin desarrollado para la administración de los distintos roles de las distintas cuentas!
    Author: Alejandro Espidea con colaboracion de Ricardo Leañez, Jose Alejandro y Edithson Maestracci.
    Author URI: https://platform.kalstein.us
    Version: 1.0 (Beta)
*/

//Test

//REQUIRED    
require_once dirname(__FILE__) . '/php/shortcode.php';

//ACTIVATED
function perfilesActivated()
{

}

//DEACTIVATED
function perfilesDeactivated()
{

}


// XXX PÁGINAS DE ERROR XX

function errorPage()
{
    $_short = new shortcodePerfiles;

    $html = $_short->error404();
    return $html;
}

//PÁGINA PASARELA DE PAGO (MONETICO).
function payment()
{
    $_short = new shortcodePerfiles;

    $html = $_short->paymentGateway();
    return $html;
}

//PÁGINA DE RESPUESTA DE SERVIDOR (MONETICO)
function paymentResponse()
{
    $_short = new shortcodePerfiles;

    $html = $_short->payment_response();
    return $html;
}

//PÁGINA DE PAGO SATISFACTORIO. 
function successPage()
{
    $_short = new shortcodePerfiles;

    $html = $_short->success_page();
    return $html;
}

//Short Code pagina diego 404 
/*function diego(){
    $_short = new shortcodePerfiles;

    $html = $_short->diego_shortcode();
    return $html;
}*/



register_activation_hook(__FILE__, 'perfilesActivated');

register_deactivation_hook(__FILE__, 'perfilesDeactivated');

// XXX SHORTCODE CUENTAS Y CLIENTE XXX

function loginPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->login();
    return $html;
}

function signupPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->signup();
    return $html;
}

function registerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->register();
    return $html;
}

function dashboardPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->dashboard();
    return $html;
}

function accountRedirectPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->account_redirect();
    return $html;
}

function createCotizacionPerfiles()
{
    $html = "&nbsp";
    return $html;
}

function btnLoginSignup()
{
    $html = "&nbsp";
    return $html;
}

// XXX SHORTCODE FABRICANTE XXX

function dashboardManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_dashboard();
    return $html;
}

function stockManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_stock();
    return $html;
}

function stockPreviewManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_stock_preview();
    return $html;
}

function stockAddManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_stock_add();
    return $html;
}

function stockEditManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_stock_edit();
    return $html;
}

function listOrderManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_list_order();
    return $html;
}

function listOrderProcessedManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_list_order_processed();
    return $html;
}

function listOrderCancelledManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_list_order_cancelled();
    return $html;
}

function salesReportManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_sales_report();
    return $html;
}

function shippingCostsManufacturerPerfiles()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_shipping_costs();
    return $html;
}

function inboxPerfilesManufacturer()
{
    $_short = new shortcodePerfiles;

    $html = $_short->inbox_manufacturer();
    return $html;
}

function editProfilePerfilesManufacturer()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_edit_profile();
    return $html;
}

function catalogsPerfilesManufacturer()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_catalogs();
    return $html;
}

function pursachingPerfilesManufacturer()
{
    $_short = new shortcodePerfiles;

    $html = $_short->manufacturer_pursaching();
    return $html;
}

// XXX DISTRIBUTOR XXX

function dashboardPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->dashboard_distributor();
    return $html;
}

function stockPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->stock_distributor();
    return $html;
}

function stockAddPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->stock_add_distributor();
    return $html;
}

function stockEditPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->stock_edit_distributor();
    return $html;
}

function stockPreviewPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->stock_distributor_preview();
    return $html;
}

function stockShippingPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->stock_shipping_distributor();
    return $html;
}

function listOrderPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->list_order_distributor();
    return $html;
}

function listOrderProcessedPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->list_order_processed_distributor();
    return $html;
}

function listOrderCancelledPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->list_order_cancelled_distributor();
    return $html;
}

function salesPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->sales_distributor();
    return $html;
}

function inboxPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->inbox_distributor();
    return $html;
}

function inboxViewPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->inbox_distributor_view();
    return $html;
}

function inboxComposePerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->inbox_distributor_compose();
    return $html;
}

function inboxSentPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->inbox_distributor_sent();
    return $html;
}

function inboxSentViewPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->inbox_distributor_view_sent();
    return $html;
}

function editProfilePerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->distributor_edit_profile();
    return $html;
}

function catalogsPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->distributor_catalogs();
    return $html;
}

function pursachingPerfilesDistributor()
{
    $_short = new shortcodePerfiles;

    $html = $_short->distributor_pursaching();
    return $html;
}

// XXX SUPPORT XXX

function dashboard_suport()
{
    $_short = new shortcodePerfiles;

    $html = $_short->dashboard_suport();
    return $html;
}

function reportes_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->reports_suport();
    return $html;
}
function reportesadd_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->reports_add_suport();
    return $html;
}

function reportesmod_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->reports_mod_suport();
    return $html;
}

function services_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->service_suport();
    return $html;
}
function servicesadd_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->serviceadd_suport();
    return $html;
}
function servicesmod_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->servicemod_suport();
    return $html;
}

function quotes_Suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->Quotes_suport();
    return $html;
}
function quotesProcessed_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->quotesprocessed_suport();
    return $html;
}
function quotescanceled_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->quotescanceled_suport();
    return $html;
}

function inbox_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->inbox_suport();
    return $html;
}
function inboxsent_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->mailsSuportsent_suport();
    return $html;
}
function inboxsentview_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->mailsSuportsentview();
    return $html;
}
function inboxview_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->emailSuportview();
    return $html;
}
function compose_suport()
{
    $_short = new shortcodeperfiles;

    $html = $_short->emailcompose_suport();
    return $html;
}


function stock_suport()
{

    $_short = new shortcodeperfiles;

    $html = $_short->stock_suport();
    return $html;

}

function catalogo_suport()
{

    $_short = new shortcodeperfiles;

    $html = $_short->catalogo();
    return $html;

}


function supportEditProfile()
{

    $_short = new shortcodeperfiles;

    $html = $_short->support_edit_profile();
    return $html;

}
function pursachingPerfilesSupport()
{
    $_short = new shortcodePerfiles;

    $html = $_short->support_pursaching();
    return $html;
}

//XX RENTAL AND EQUIPMENT SALE

function rentalPerfilesDashboard()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_dashboard();
    return $html;
}

function rentalPerfilesStock()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_stock();
    return $html;
}

function rentalPerfilesStockAdd()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_stock_add();
    return $html;
}

function rentalPerfilesStockUsed()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_stock_used();
    return $html;
}

function rentalPerfilesStockEdit()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_stock_edit();
    return $html;
}

function rentalPerfilesListOrder()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_order();
    return $html;
}

function rentalPerfilesListOrderProcessed()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_order_proccesed();
    return $html;
}

function rentalPerfilesListOrderCancelled()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_order_cancelled();
    return $html;
}

function rentalPerfilesCustomers()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_customers();
    return $html;
}

function rentalPerfilesSales()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_sales();
    return $html;
}

function rentalPerfilesInbox()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_inbox();
    return $html;
}

function rentalPerfilesEditProfile()
{
    $_short = new shortcodePerfiles;

    $html = $_short->rentalsale_edit_profile();
    return $html;
}


// MODERATOR

function PerfilesModeratorDashboard()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_dashboard();
    return $html;
}
function PerfilesModeratorProduct()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_product();
    return $html;
}
function PerfilesModeratorQuotes()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_quotes();
    return $html;
}
function PerfilesModeratorBitacoras()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_bitacora();
    return $html;
}
function PerfilesModeratorShipping()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_shipping();
    return $html;
}
function PerfilesModeratorViewProduct()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_view_product();
    return $html;
}
function PerfilesModeratorViewAccount()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_view_account();
    return $html;
}

function data_recoverP()
{
    $_short = new shortcodePerfiles;

    $html = $_short->data_recover();
    return $html;
}

function perfiles_recover_password()
{
    $_short = new shortcodePerfiles;

    $html = $_short->recoveryPassword();
    return $html;
}

function perfiles_customize_template_quotes()
{
    $_short = new shortcodePerfiles;

    $html = $_short->customize_template();
    return $html;
}

function moderator_cotizacionesP()
{

    $_short = new shortcodePerfiles;

    $html = $_short->moderator_cotizaciones();
    return $html;
}

//PAGINA DE PAGO RECHAZADO.
add_shortcode("ERROR_404_KALSTEIN", "errorPage");

//PAGINA PAGO APROBADO.
add_shortcode("SUCCESS_PAYMENT", "successPage");

//PAYMENT GATEWAY
add_shortcode("MONETICO_PAYMENT", "payment");

//PAYMENT RESPONSE
add_shortcode("MONETICO_PAYMENT_RESPONSE", "paymentResponse");

add_shortcode("PERFILES_DATA_RECOVER", "data_recoverP");

//Shortcode de diego 404 
// add_shortcode("DIEGO_SHORTCODE", "diego");

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
add_shortcode("SUPORT_QUOTESPROCESSED", "quotesProcessed_suport");
add_shortcode("SUPORT_QUOTESCANCELLED", "quotescanceled_suport");
add_shortcode("SUPORT_INBOX", "inbox_suport");
add_shortcode("SUPORT_INBOX_SENT", "inboxsent_suport");
add_shortcode("SUPORT_INBOX_VIEW", "inboxview_suport");
add_shortcode("SUPORT_INBOX_VIEW_SENT", "inboxsentview_suport");
add_shortcode("SUPORT_INBOX_COMPOSE", "compose_suport");
add_shortcode("SUPORT_STOCK", "stock_suport");
add_shortcode("SUPORT_CATALOGO", "catalogo_suport");
add_shortcode("SUPORT_EDIT_PROFILE", "supportEditProfile");
add_shortcode("SUPORT_PURSACHING", "pursachingPerfilesSupport");

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
add_shortcode("MODERATOR_COTIZACIONES", "moderator_cotizacionesP");

//Shortcode Styles


//CHECK DOCUMENTATION FOR LINK

function global_url()
{
    wp_enqueue_script('global-url', plugins_url('src/js/links.upload.js', __FILE__), array('jquery'));
}

function translations()
{
    wp_enqueue_script('i18next', plugins_url('src/js/i18next.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('i18n', plugins_url('src/js/i18n.js', __FILE__), array('jquery'));
    wp_enqueue_script('jQuery-3.4.0', plugins_url('src/js/jquery-migrate-3.4.0.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('jQuery-i18n', plugins_url('src/js/jquery-i18next.min.js', __FILE__), array('jquery'));
}

function perfiles_styles()
{

    //MAIN URLS
    $plugin_dir = 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles';
    $plugin_quote = 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion';

    function general_client_styles()
    {
        wp_enqueue_script('JS', plugins_url('src/js/btnLoginRegister.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/styles.btnLoginSingup.css', __FILE__));
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('signaling-css', plugins_url('src/css/signaling.css', __FILE__));
        wp_enqueue_script('signaling-js', plugins_url('src/js/signaling.js', __FILE__), array('jquery'));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
    }

    global $post;

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_LOGIN')) {
        global_url();
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/login.style.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('JS', plugins_url('src/js/login.script.js', __FILE__), array('jquery'));
        wp_enqueue_script('jQuery-3.4.0', plugins_url('src/js/jquery-migrate-3.4.0.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('i18n', plugins_url('src/js/i18n.js', __FILE__), array('jquery'));
        /*wp_enqueue_script('session-script', plugins_url('src/js/session.script.js',__FILE__),array('jquery'));*/
        general_client_styles();
    }

    //DIEGO_SHORTCODE

    // if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'DIEGO_SHORTCODE' ) ) {
    //     global_url();
    //     translations();
    //     wp_enqueue_style( 'boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
    //     wp_enqueue_style( 'CSS', plugins_url('src/css/login.style.css', __FILE__));
    //     wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js',__FILE__),array('jquery'));
    //     wp_enqueue_script('JS', plugins_url('src/js/login.script.js',__FILE__),array('jquery'));
    //     wp_enqueue_script('diego', plugins_url('src/js/diego.js',__FILE__),array('jquery'));
    //     wp_enqueue_script('jQuery-3.4.0', plugins_url('src/js/jquery-migrate-3.4.0.min.js',__FILE__),array('jquery'));
    //     wp_enqueue_style( 'izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
    //     wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js',__FILE__),array('jquery'));
    //     wp_enqueue_script('i18n', plugins_url('src/js/i18n.js',__FILE__),array('jquery'));
    //     /*wp_enqueue_script('session-script', plugins_url('src/js/session.script.js',__FILE__),array('jquery'));*/
    //     general_client_styles();    
    // }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_SIGNUP')) {
        translations();
        global_url();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/login.style.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('JS', plugins_url('src/js/login.script.js', __FILE__), array('jquery'));
        wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('session-script', plugins_url('src/js/session.script.js', __FILE__), array('jquery'));
        general_client_styles();
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_REGISTER')) {
        translations();
        global_url();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/register.style.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('JS', plugins_url('src/js/register.script1.js', __FILE__), array('jquery'));
        wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        general_client_styles();
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DASHBOARD')) {
        translations();
        global_url();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('ListJS', plugins_url('src/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('ChartJS', plugins_url('src/js/chart.umd.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('woo-model-table-lib', plugins_url('src/js/product.ref.to.table.js', __FILE__), array('jquery')); //
        wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js', __FILE__), array('jquery')); //
        wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js', __FILE__), array('jquery'));
        //navbar script
        wp_enqueue_script('nav', plugins_url('src/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));

        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        //INBOX
        wp_enqueue_style('email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));

        //CATALOGS 
        wp_enqueue_style('dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
        wp_enqueue_style('themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('catalogo', plugins_url('src/js/catalog.js', __FILE__), array('jquery')); //
        wp_enqueue_script('input-control', plugins_url('src/js/input.control.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js', __FILE__), array('jquery'));
        //QUOTE 
        wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js', __FILE__), array('jquery'));  //
        general_client_styles();

        //COTIZACION_KALSTEIN 
        wp_enqueue_script('quote-script-js', '' . $plugin_quote . '/assets/js/script.cot2.js', array('jquery'), true); //
        wp_enqueue_style('quote-css', '' . $plugin_quote . '/assets/css/styles.cot.css', true); // 

        //inbox JS
        wp_enqueue_script('inbox-pages-js', '' . $plugin_dir . '/src/js/inbox.pages.js', array('jquery'), true); // 

        //Banner and footer
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__)); // 

        //File Drop

        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));

        wp_enqueue_script('anchors-js', plugins_url('src/js/anchors.script.js', __FILE__), array('jquery'));

        //DIAGNOSIS APP JS 

        wp_enqueue_script('diag-pages', plugins_url('src/js/diag.pages.js', __FILE__), array('jquery'));

    }

    //NOBODY KNOWS WTF IS THIS
    /*if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'PERFILES_DATAUSERS' ) ) {
        wp_enqueue_script('JS', plugins_url('src/js/dashboard2.script.js',__FILE__),array('jquery'));
        wp_enqueue_style( 'CSS', plugins_url('src/css/styles.TemplateQuoteEdit.css', __FILE__));
        general_client_styles();
    }*/
    //GLOBAL URL PENDING
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_CUSTOMIZE_TEMPLATE_QUOTES')) {
        wp_enqueue_style('css', plugins_url('src/css/styles.TemplateQuoteEdit.css', __FILE__));
        wp_enqueue_script('JS', plugins_url('src/js/dashboard2.script.js', __FILE__), array('jquery'));
        wp_enqueue_script('izitoast-js', plugins_url('src/js/script.TemplateQuoteEdit.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));

        general_client_styles();
    }
    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_BTNLOGINSIGNUP')) {
        global_url();
        wp_enqueue_script('JS', plugins_url('src/js/btnLoginRegister.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/styles.btnLoginSingup.css', __FILE__));
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        general_client_styles();
    }
    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_RECOVERY_PASSWORD')) {
        global_url();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/login.style.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('JS', plugins_url('src/js/login.script.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('jQuery-1.4.1', plugins_url('src/js/jquery-migrate-1.4.1.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('sessionPHP-js', plugins_url('src/js/recoveryPassword.script.js', __FILE__), array('jquery')); // 
        general_client_styles();
    }

    // XXX ESTILOS FABRICANTE XXX

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_DASHBOARD')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('chartjs-js', plugins_url('src/manufacturer/js/chart9.js', __FILE__), array('jquery')); //

        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); //
    }
    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_STOCK')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); // 
    }
    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_STOCK_PREVIEW')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quan-calc', plugins_url('src/manufacturer/js/quantity.calculator.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('accesorie-preview', plugins_url('src/manufacturer/js/accessories/accessorie.preview.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }
    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_STOCK_ADD')) {
        translations();
        global_url();

        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('accesories-requests', plugins_url('src/manufacturer/js/accessories/accessories.requests.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }
    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_STOCK_EDIT')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery')); //
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); //
        wp_enqueue_script('accesories-requests', plugins_url('src/manufacturer/js/accessories/accessories.requests.js', __FILE__), array('jquery')); //
        wp_enqueue_script('fetch-product-data', plugins_url('src/manufacturer/js/fetch.data.js', __FILE__), array('jquery')); //
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); //
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('alertify-js', plugins_url('src/alertifyjs/alertify.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('alertify-css', plugins_url('src/alertifyjs/css/alertify.min.css', __FILE__));
        wp_enqueue_style('alertify-css', plugins_url('src/alertifyjs/css/alertify.rtl.min.css', __FILE__));
        wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js', __FILE__), array('jquery')); //
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER_PROCESSED')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_LIST_ORDER_CANCELLED')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('cotization-details-show', plugins_url('src/manufacturer/js/show.cotizacion.details.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_SALES_REPORT')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('sales-chart-js', plugins_url('src/manufacturer/js/sales.chart.js', __FILE__), array('jquery')); // 
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_SHIPPING_COSTS')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery'));
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('uncheck-form-fields', plugins_url('src/manufacturer/js/uncheck.form.fields.js', __FILE__), array('jquery'));
        wp_enqueue_script('fetch-product-data', plugins_url('src/manufacturer/js/fetch.data.shipping.js', __FILE__), array('jquery'));
        wp_enqueue_script('calc-js', plugins_url('src/distributor/js/show.calculator.js', __FILE__), array('jquery')); //
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_INBOX')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('inbox-pages-js', '' . $plugin_dir . '/src/js/inbox.pages.js', array('jquery'), true); //
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_EDIT_PROFILE')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_CATALOGS')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery'));
        wp_enqueue_script('catalog-script', plugins_url('src/js/catalog.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
        wp_enqueue_style('themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
        wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_MANUFACTURER_PURSACHING')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quote-script-js', '' . $plugin_quote . '/assets/js/script.cot2.js', array('jquery'), true);
        wp_enqueue_style('quote-css', '' . $plugin_quote . '/assets/css/styles.cot.css', true);
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js', __FILE__), array('jquery'));
        wp_enqueue_script('pursaching-script', plugins_url('src/manufacturer/js/pursaching.js', __FILE__), array('jquery'));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
    }

    // XXX DISTRIBUTOR XXX

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DASHBOARD_DISTRIBUTOR')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('chartjs-js', plugins_url('src/distributor/js/chart1.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); //
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_STOCK_DISTRIBUTOR')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js', __FILE__), array('jquery')); //  
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_ADD')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/productRequest.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('accessory-requests', plugins_url('src/distributor/js/accesories/accessories.requests.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_EDIT')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery')); //
        wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js', __FILE__), array('jquery')); //
        wp_enqueue_script('accesories-requests', plugins_url('src/distributor/js/accesories/accessories.requests.js', __FILE__), array('jquery')); //
        wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.js', __FILE__), array('jquery')); //
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_PREVIEW')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('quan-calc', plugins_url('src/manufacturer/js/quantity.calculator.js', __FILE__), array('jquery'));
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('accesorie-preview', plugins_url('src/manufacturer/js/accessories/accessorie.preview.js', __FILE__), array('jquery')); //
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_STOCK_DISTRIBUTOR_SHIPPING')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js', __FILE__), array('jquery')); //
        wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js', __FILE__), array('jquery')); //
        wp_enqueue_script('uncheck-form-fields', plugins_url('src/distributor/js/uncheck.form.fields.js', __FILE__), array('jquery')); //
        wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.shipping.js', __FILE__), array('jquery')); //
        wp_enqueue_script('calc-js', plugins_url('src/distributor/js/show.calculator.js', __FILE__), array('jquery')); // 
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_LIST_ORDER_DISTRIBUTOR')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('cotization-details-show', plugins_url('src/distributor/js/show.cotizacion.details.js', __FILE__), array('jquery')); // 
    }

    //GLOBAL URL APPLIED 
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_LIST_ORDER_PROCESSED_DISTRIBUTOR')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor3.js', __FILE__), array('jquery')); //
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__)); // 
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('cotization-details-show', plugins_url('src/distributor/js/show.cotizacion.details.js', __FILE__), array('jquery')); //
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_LIST_ORDER_CANCELLED_DISTRIBUTOR')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('cotization-details-show', plugins_url('src/distributor/js/show.cotizacion.details.js', __FILE__), array('jquery')); // 
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_SALES_DISTRIBUTOR')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('chart-umd-js', plugins_url('src/manufacturer/js/chart.umd.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('sales-chart-js', plugins_url('src/manufacturer/js/sales.chart.js', __FILE__), array('jquery')); //
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DISTRIBUTOR_INBOX')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js', __FILE__), array('jquery')); //
        wp_enqueue_style('email-style', plugins_url('src/distributor/css/email.style.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('inbox-pages-js', '' . $plugin_dir . '/src/js/inbox.pages.js', array('jquery'), true); //
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DISTRIBUTOR_EDIT_PROFILE')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery')); //
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js', __FILE__), array('jquery')); // 
        wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DISTRIBUTOR_CATALOGS')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('catalog-script', plugins_url('src/js/catalog.js', __FILE__), array('jquery')); // 
        wp_enqueue_style('dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
        wp_enqueue_style('themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
        wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js', __FILE__), array('jquery'));
    }

    //GLOBAL URL APPLIED
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DISTRIBUTOR_PURSACHING')) {
        translations();
        global_url();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quote-script-js', '' . $plugin_quote . '/assets/js/script.cot2.js', array('jquery'), true);
        wp_enqueue_style('quote-css', '' . $plugin_quote . '/assets/css/styles.cot.css', true);
        wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js', __FILE__), array('jquery'));
        wp_enqueue_script('pursaching-script', plugins_url('src/distributor/js/pursaching.js', __FILE__), array('jquery'));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    // XXX SUPPORT STYLES

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_DASHBOARD')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('chartjs-js', plugins_url('src/suport/js/chart.js', __FILE__), array('jquery'));
        wp_enqueue_script('chart-umd-js', plugins_url('src/suport/js/chart.umd.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('Reportes', plugins_url('src/suport/js/reportes.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_REPORTS')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_ADDREPORTS')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('nav-style', plugins_url('src/suport/css/stock.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS-SUPPORT', plugins_url('src/suport/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js', __FILE__), array('jquery'));
        wp_enqueue_script('script', plugins_url('src/suport/js/script.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));

    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_MODREPORTS')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style(' tamplatemo', plugins_url('admin\css\templatemo-style.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('nav-style', plugins_url('src/suport/css/stock.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js', __FILE__), array('jquery'));
        wp_enqueue_script('consulta.JS', plugins_url('src/suport/js/consulta.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_SERVICES')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
        wp_enqueue_style('izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('service.js', plugins_url('src/suport/js/serviceslist.js', __FILE__), array('jquery'));
        wp_enqueue_script('servicescheck.js', plugins_url('src/suport/js/servicescategory.js', __FILE__), array('jquery'));
        wp_enqueue_script('servicescheck.js', plugins_url('src/suport/js/servicescategory.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_SERVICESADD')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js', __FILE__), array('jquery'));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('service.js', plugins_url('src/suport/js/serviceslist.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_SERVICESMOD')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/suport/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('xda', plugins_url('src/suport/js/file_input.js', __FILE__), array('jquery'));
        wp_enqueue_script('service.js', plugins_url('src/suport/js/serviceslist.js', __FILE__), array('jquery'));
        wp_enqueue_script('servicesmod.js', plugins_url('src/suport/js/servicesmod.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_QUOTES')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
        wp_enqueue_style('iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/css/all.css', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js', __FILE__), array('jquery'));
        wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('quotes.js', plugins_url('src/suport/js/quotes.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_QUOTESPROCESSED')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
        wp_enqueue_style('iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/css/all.css', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js', __FILE__), array('jquery'));
        wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('quotes.js', plugins_url('src/suport/js/quotes.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_QUOTESCANCELLED')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/css/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js', __FILE__), array('jquery'));
        wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('quotes.js', plugins_url('src/suport/js/quotes.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_INBOX')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('email-style', plugins_url('src/suport/css/email.style.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_script('inbox-pages-js', 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/src/js/inbox.pages.js', array('jquery'), true);
        wp_enqueue_style('izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_STOCK')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('list-CSS', plugins_url('src/suport/css/list.style.css', __FILE__));
        wp_enqueue_style('iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/suport/js/reportes.js', __FILE__), array('jquery'));
        wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('stock_suport', plugins_url('src/suport/js/suport_stock.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_CATALOGO')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/suport/css/material.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('iziToast.css', plugins_url('src/suport/css/iziToast.css', __FILE__));
        wp_enqueue_style('dflip.css', plugins_url('src/suport/css/dflip.min.css', __FILE__));
        wp_enqueue_style('themify-icons.min.css', plugins_url('src/suport/css/themify-icons.min.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/suport/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('list-js', plugins_url('src/suport/js/list.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('iziToast.js', plugins_url('src/suport/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('catalogo', plugins_url('src/suport/js/catalogo.js', __FILE__), array('jquery'));
        wp_enqueue_script('dflip.js', plugins_url('src/suport/js/dflip.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('logout', plugins_url('src/suport/js/logout.js', __FILE__), array('jquery'));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('catalog-script', plugins_url('src/js/catalog.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_EDIT_PROFILE')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery'));
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SUPORT_PURSACHING')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quote-script-js', 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/js/script.cot2.js', array('jquery'), true);
        wp_enqueue_style('quote-css', 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/css/styles.cot.css', true);
        wp_enqueue_script('JS', plugins_url('src/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_script('acordeon', plugins_url('src/js/acordeon.js', __FILE__), array('jquery'));
        wp_enqueue_script('pursaching-script', plugins_url('src/distributor/js/pursaching.js', __FILE__), array('jquery'));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast.css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast.js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    //RENTAL AND USED EQUIPMENT
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_DASHBOARD')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-g', plugins_url('src/rentalsale/js/chart_rentalsale.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_STOCK')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('banner-footer-css', plugins_url('src/css/banner-footer.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_STOCK_ADD')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/rentalsale/js/products.request.js', __FILE__), array('jquery'));
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_USED')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/rentalsale/js/products.request.used.js', __FILE__), array('jquery'));
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_STOCK_EDIT')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/distributor/js/products.request.js', __FILE__), array('jquery'));
        wp_enqueue_script('fetch-product-data', plugins_url('src/distributor/js/fetch.data.js', __FILE__), array('jquery'));
        wp_enqueue_script('clamp-form-fields', plugins_url('src/distributor/js/form.format.control.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_ORDER')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_ORDER_PROCESSED')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_ORDER_CANCELLED')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_COSTUMERS')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('admin/css/templatemo-style.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.css', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_style('filedrop-css', plugins_url('src/manufacturer/css/filedrop.css', __FILE__));
        wp_enqueue_script('filedrop-js', plugins_url('src/manufacturer/js/filedrop.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('image-select-preview', plugins_url('src/manufacturer/js/image.preview.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/rentalsale/js/products.request.used.js', __FILE__), array('jquery'));
        wp_enqueue_script('clamp-form-fields', plugins_url('src/manufacturer/js/form.format.control.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_script('json-to-csv-lib', plugins_url('src/manufacturer/js/json2csv.js', __FILE__), array('jquery'));
        wp_enqueue_script('csv-table', plugins_url('src/manufacturer/js/csvtable.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_SALES')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/distributor/css/material.css', __FILE__));
        wp_enqueue_script('dashboard', plugins_url('src/distributor/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_style('list-CSS', plugins_url('src/distributor/css/list.style.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/distributor/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-c', plugins_url('src/distributor/js/products.request.distributor.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-g', plugins_url('src/distributor/js/chart.js.sales.distributor.js', __FILE__), array('jquery'));
        wp_enqueue_script('test-d', plugins_url('src/distributor/js/chart_distributor.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_INBOX')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_script('dashboard', plugins_url('src/manufacturer/js/dashboard.script.js', __FILE__), array('jquery'));
        wp_enqueue_style('email-style', plugins_url('src/manufacturer/css/email.style.css', __FILE__));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('inbox-pages-js', 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/src/js/inbox.pages.js', array('jquery'), true);
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'RENTAL_EDIT_PROFILE')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/manufacturer/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/manufacturer/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/manufacturer/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('product-requests', plugins_url('src/manufacturer/js/products.request.js', __FILE__), array('jquery'));
        wp_enqueue_script('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('edit_profile', plugins_url('src/manufacturer/js/edit_profile.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }

    // MODERADOR

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_DASHBOARD')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/moderator/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/moderator/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));

    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_PRODUCT')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_QUOTES')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quote-table', plugins_url('src/moderator/js/quote.table.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_BITACORAS')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quote-table', plugins_url('src/moderator/js/quote.table.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('log-table-js', plugins_url('src/moderator/js/log.table.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_SHIPPING')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quote-shipping', plugins_url('src/moderator/js/quote.shipping.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_VIEW_PRODUCT')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('validate-product-js', plugins_url('src/moderator/js/validate.product.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_VIEW_ACCOUNT')) {
        translations();
        wp_enqueue_style('bootstrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('bootstrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('material', plugins_url('src/moderator/css/material.css', __FILE__));
        wp_enqueue_style('font-awesome-css', plugins_url('src/fontawesome/css/all.css', __FILE__));
        wp_enqueue_script('font-awesome-js', plugins_url('src/fontawesome/js/all.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/manufacturer/css/izitoast.css', __FILE__));
        wp_enqueue_script('iziToast-js', plugins_url('src/manufacturer/js/iziToast.js', __FILE__), array('jquery'));
        wp_enqueue_script('validate-product-js', plugins_url('src/moderator/js/validate.account.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'PERFILES_DATA_RECOVER')) {
        translations();
        wp_enqueue_script('csv-to-json-lib', plugins_url('src/manufacturer/js/csv2json.js', __FILE__), array('jquery'));
        wp_enqueue_style('izitoast-css', plugins_url('src/distributor/css/izitoast.css', __FILE__));
        wp_enqueue_script('izitoast-js', plugins_url('src/distributor/js/iziToast.js', __FILE__), array('jquery'));
    }
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'MODERATOR_COTIZACIONES')) {
        translations();
        wp_enqueue_style('boostrap-css', plugins_url('src/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('CSS', plugins_url('src/css/dashboard.style.css', __FILE__));
        wp_enqueue_style('CSS-MATERIAL', plugins_url('src/css/material.css', __FILE__));
        wp_enqueue_style('AlertJS-CSS', plugins_url('jAlert-master/dist/jAlert.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('src/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('FontAwesome', plugins_url('src/js/fontAwesome.js', __FILE__), array('jquery'));
        wp_enqueue_script('nav', plugins_url('src/moderator/js/nav.js', __FILE__), array('jquery'));
        wp_enqueue_script('quotes-monetico', plugins_url('src/moderator/js/quotes.monetico.js', __FILE__), array('jquery'));
        // wp_enqueue_script('diego', plugins_url('src/js/diego.js',__FILE__),array('jquery'));
    }
    //quotes.monetico.js

}
add_action('wp_enqueue_scripts', 'perfiles_styles');

require_once dirname(__FILE__) . '/kalsteinCotizacion/classes/shortcode.php';

function activated()
{

    global $wpdb;



    $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}cotizacion` (
            `cotizacion_id` INT NOT NULL AUTO_INCREMENT , `cotizacion_domain` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_sres` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_atencion` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_create_at` TIMESTAMP NOT NULL , `cotizacion_metodo_envio` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_destino` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_zipcode` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_incoterm` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_divisa` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_metodo_pago` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_submit` DECIMAL(10,2) NOT NULL , `cotizacion_iva` DECIMAL(10,2) NOT NULL , `cotizacion_descuento` DECIMAL(10,2) NOT NULL , `cotizacion_subtotal` DECIMAL(10,2) NOT NULL , `cotizacion_envio` DECIMAL(10,2) NOT NULL , `cotizacion_total` DECIMAL(10,2) NOT NULL , PRIMARY KEY (`cotizacion_id`)) ENGINE = InnoDB;";

    $wpdb->query($sql);



    $sql2 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}cotizacion_detalle` (
            `cotizacion_detalle_aid` INT NOT NULL AUTO_INCREMENT , `cotizacion_detalle_id` INT NOT NULL , `cotizacion_detalle_name` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_detalle_model` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_detalle_maker` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_detalle_image` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_detalle_cant` INT NOT NULL , `cotizacion_detalle_unid` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `cotizacion_detalle_valor_unit` DECIMAL(10,2) NOT NULL , `cotizacion_detalle_valor_total` DECIMAL(10,2) NOT NULL , `cotizacion_detalle_valor_anidado` DECIMAL(10,2) NOT NULL , PRIMARY KEY (`cotizacion_detalle_aid`)) ENGINE = InnoDB;";
    $wpdb->query($sql2);

    $sql3 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}paises` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `iso` char(2) DEFAULT NULL,
            `es` varchar(80) DEFAULT NULL,
            `en` varchar(80) DEFAULT NULL,
            `fr` varchar(80) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql3);

    $paises = [
        array(
            'id' => 1,
            'iso' => 'AF',
            'nombre' => 'Afganistán',
            'name' => 'Afghanistan',
            'nom' => 'Afghanistan'
        ),
        array(
            'id' => 2,
            'iso' => 'AX',
            'nombre' => 'Islas Gland',
            'name' => 'Gland Islands',
            'nom' => 'Îles Gland'
        ),
        array(
            'id' => 3,
            'iso' => 'AL',
            'nombre' => 'Albania',
            'name' => 'Albania',
            'nom' => 'Albanie'
        ),
        array(
            'id' => 4,
            'iso' => 'DE',
            'nombre' => 'Alemania',
            'name' => 'Germany',
            'nom' => 'Allemagne'
        ),
        array(
            'id' => 5,
            'iso' => 'AD',
            'nombre' => 'Andorra',
            'name' => 'Andorra',
            'nom' => 'Andorre'
        ),
        array(
            'id' => 6,
            'iso' => 'AO',
            'nombre' => 'Angola',
            'name' => 'Angola',
            'nom' => 'Angola'
        ),
        array(
            'id' => 7,
            'iso' => 'AI',
            'nombre' => 'Anguilla',
            'name' => 'Anguilla',
            'nom' => 'Anguilla'
        ),
        array(
            'id' => 8,
            'iso' => 'AQ',
            'nombre' => 'Antártida',
            'name' => 'Antarctica',
            'nom' => 'Antarctique'
        ),
        array(
            'id' => 9,
            'iso' => 'AG',
            'nombre' => 'Antigua y Barbuda',
            'name' => 'Antigua and Barbuda',
            'nom' => 'Antigua-et-Barbuda'
        ),
        array(
            'id' => 10,
            'iso' => 'AN',
            'nombre' => 'Antillas Holandesas',
            'name' => 'Netherlands Antilles',
            'nom' => 'Antilles néerlandaises'
        ),
        array(
            'id' => 11,
            'iso' => 'SA',
            'nombre' => 'Arabia Saudíta',
            'name' => 'Saudi Arabia',
            'nom' => 'Arabie Saoudite'
        ),
        array(
            'id' => 12,
            'iso' => 'DZ',
            'nombre' => 'Argelia',
            'name' => 'Algeria',
            'nom' => 'Algérie'

        ),
        array(
            'id' => 13,
            'iso' => 'AR',
            'nombre' => 'Argentina',
            'name' => 'Argentina',
            'nom' => 'Argentine'
        ),
        array(
            'id' => 14,
            'iso' => 'AM',
            'nombre' => 'Armenia',
            'name' => 'Armenia',
            'nom' => 'Arménie'
        ),
        array(
            'id' => 15,
            'iso' => 'AW',
            'nombre' => 'Aruba',
            'name' => 'Aruba',
            'nom' => 'Aruba'
        ),
        array(
            'id' => 16,
            'iso' => 'AU',
            'nombre' => 'Australia',
            'name' => 'Australia',
            'nom' => 'Australie'
        ),
        array(
            'id' => 17,
            'iso' => 'AT',
            'nombre' => 'Austria',
            'name' => 'Austria',
            'nom' => 'Autriche'
        ),
        array(
            'id' => 18,
            'iso' => 'AZ',
            'nombre' => 'Azerbaiyán',
            'name' => 'Azerbaijan',
            'nom' => 'Azerbaïdjan'
        ),
        array(
            'id' => 19,
            'iso' => 'BS',
            'nombre' => 'Bahamas',
            'name' => 'Bahamas',
            'nom' => 'Bahamas'
        ),
        array(
            'id' => 20,
            'iso' => 'BH',
            'nombre' => 'Bahréin',
            'name' => 'Bahrain',
            'nom' => 'Bahreïn'
        ),
        array(
            'id' => 21,
            'iso' => 'BD',
            'nombre' => 'Bangladesh',
            'name' => 'Bangladesh',
            'nom' => 'Bangladesh'
        ),
        array(
            'id' => 22,
            'iso' => 'BB',
            'nombre' => 'Barbados',
            'name' => 'Barbados',
            'nom' => 'Barbade'
        ),
        array(
            'id' => 23,
            'iso' => 'BY',
            'nombre' => 'Bielorrusia',
            'name' => 'Belarus',
            'nom' => 'Biélorussie'
        ),
        array(
            'id' => 24,
            'iso' => 'BE',
            'nombre' => 'Bélgica',
            'name' => 'Belgium',
            'nom' => 'Belgique'
        ),
        array(
            'id' => 25,
            'iso' => 'BZ',
            'nombre' => 'Belice',
            'name' => 'Belize',
            'nom' => 'Belize'
        ),
        array(
            'id' => 26,
            'iso' => 'BJ',
            'nombre' => 'Benin',
            'name' => 'Benin',
            'nom' => 'Bénin'
        ),
        array(
            'id' => 27,
            'iso' => 'BM',
            'nombre' => 'Bermudas',
            'name' => 'Bermuda',
            'nom' => 'Bermudes'
        ),
        array(
            'id' => 28,
            'iso' => 'BT',
            'nombre' => 'Bhután',
            'name' => 'Bhutan',
            'nom' => 'Bhoutan'
        ),
        array(
            'id' => 29,
            'iso' => 'BO',
            'nombre' => 'Bolivia',
            'name' => 'Bolivia',
            'nom' => 'Bolivie'
        ),
        array(
            'id' => 30,
            'iso' => 'BA',
            'nombre' => 'Bosnia y Herzegovina',
            'name' => 'Bosnia and Herzegovina',
            'nom' => 'Bosnie-Herzégovine'
        ),
        array(
            'id' => 31,
            'iso' => 'BW',
            'nombre' => 'Botsuana',
            'name' => 'Botswana',
            'nom' => 'Botswana'
        ),
        array(
            'id' => 32,
            'iso' => 'BV',
            'nombre' => 'Isla Bouvet',
            'name' => 'Bouvet Island',
            'nom' => 'Île Bouvet'
        ),
        array(
            'id' => 33,
            'iso' => 'BR',
            'nombre' => 'Brasil',
            'name' => 'Brazil',
            'nom' => 'Brésil'
        ),
        array(
            'id' => 34,
            'iso' => 'BN',
            'nombre' => 'Brunéi',
            'name' => 'Brunei',
            'nom' => 'Brunei'
        ),
        array(
            'id' => 35,
            'iso' => 'BG',
            'nombre' => 'Bulgaria',
            'name' => 'Bulgaria',
            'nom' => 'Bulgarie'
        ),
        array(
            'id' => 36,
            'iso' => 'BF',
            'nombre' => 'Burkina Faso',
            'name' => 'Burkina Faso',
            'nom' => 'Burkina Faso'
        ),
        array(
            'id' => 37,
            'iso' => 'BI',
            'nombre' => 'Burundi',
            'name' => 'Burundi',
            'nom' => 'Burundi'
        ),
        array(
            'id' => 38,
            'iso' => 'CV',
            'nombre' => 'Cabo Verde',
            'name' => 'Cape Verde',
            'nom' => 'Cap Vert'
        ),
        array(
            'id' => 39,
            'iso' => 'KY',
            'nombre' => 'Islas Caimán',
            'name' => 'Cayman Islands',
            'nom' => 'îles Caïmanes'
        ),
        array(
            'id' => 40,
            'iso' => 'KH',
            'nombre' => 'Camboya',
            'name' => 'Cambodia',
            'nom' => 'Cambodge'
        ),
        array(
            'id' => 41,
            'iso' => 'CM',
            'nombre' => 'Camerún',
            'name' => 'Cameroon',
            'nom' => 'Cameroun'
        ),
        array(
            'id' => 42,
            'iso' => 'CA',
            'nombre' => 'Canadá',
            'name' => 'Canada',
            'nom' => 'Canada'
        ),
        array(
            'id' => 43,
            'iso' => 'CF',
            'nombre' => 'República Centroafricana',
            'name' => 'Central African Republic',
            'nom' => 'République centrafricaine'
        ),
        array(
            'id' => 44,
            'iso' => 'TD',
            'nombre' => 'Chad',
            'name' => 'Chad',
            'nom' => 'Tchad'
        ),
        array(
            'id' => 45,
            'iso' => 'CZ',
            'nombre' => 'República Checa',
            'name' => 'Czech Republic',
            'nom' => 'République tchèque'
        ),
        array(
            'id' => 46,
            'iso' => 'CL',
            'nombre' => 'Chile',
            'name' => 'Chile',
            'nom' => 'Chili'
        ),
        array(
            'id' => 47,
            'iso' => 'CN',
            'nombre' => 'China',
            'name' => 'China',
            'nom' => 'Chine'
        ),
        array(
            'id' => 48,
            'iso' => 'CY',
            'nombre' => 'Chipre',
            'name' => 'Cyprus',
            'nom' => 'Chypre'
        ),
        array(
            'id' => 49,
            'iso' => 'CX',
            'nombre' => 'Isla de Navidad',
            'name' => 'Christmas Island',
            'nom' => 'Île de Noël'
        ),
        array(
            'id' => 50,
            'iso' => 'VA',
            'nombre' => 'Ciudad del Vaticano',
            'name' => 'Vatican City',
            'nom' => 'Cité du Vatican'
        ),
        array(
            'id' => 51,
            'iso' => 'CC',
            'nombre' => 'Islas Cocos',
            'name' => 'Cocos Islands',
            'nom' => 'Îles Cocos'
        ),
        array(
            'id' => 52,
            'iso' => 'CO',
            'nombre' => 'Colombia',
            'name' => 'Colombia',
            'nom' => 'Colombie'
        ),
        array(
            'id' => 53,
            'iso' => 'KM',
            'nombre' => 'Comoras',
            'name' => 'Comoros',
            'nom' => 'Comores'
        ),
        array(
            'id' => 54,
            'iso' => 'CD',
            'nombre' => 'República Democrática del Congo',
            'name' => 'Democratic Republic of the Congo',
            'nom' => 'République démocratique du Congo'
        ),
        array(
            'id' => 55,
            'iso' => 'CG',
            'nombre' => 'Congo',
            'name' => 'Congo',
            'nom' => 'Congo'
        ),
        array(
            'id' => 56,
            'iso' => 'CK',
            'nombre' => 'Islas Cook',
            'name' => 'Cook Islands',
            'nom' => 'Îles Cook'
        ),
        array(
            'id' => 57,
            'iso' => 'KP',
            'nombre' => 'Corea del Norte',
            'name' => 'North Korea',
            'nom' => 'Corée du Nord'
        ),
        array(
            'id' => 58,
            'iso' => 'KR',
            'nombre' => 'Corea del Sur',
            'name' => 'South Korea',
            'nom' => 'Corée du Sud'
        ),
        array(
            'id' => 59,
            'iso' => 'CI',
            'nombre' => 'Costa de Marfil',
            'name' => "Côte d'Ivoire",
            'nom' => "Côte d'Ivoire"
        ),
        array(
            'id' => 60,
            'iso' => 'CR',
            'nombre' => 'Costa Rica',
            'name' => 'Costa Rica',
            'nom' => 'Costa Rica'
        ),
        array(
            'id' => 61,
            'iso' => 'HR',
            'nombre' => 'Croacia',
            'name' => 'Croatia',
            'nom' => 'Croatie'
        ),
        array(
            'id' => 62,
            'iso' => 'CU',
            'nombre' => 'Cuba',
            'name' => 'Cuba',
            'nom' => 'Cuba'
        ),
        array(
            'id' => 63,
            'iso' => 'DK',
            'nombre' => 'Dinamarca',
            'name' => 'Denmark',
            'nom' => 'Danemark'
        ),
        array(
            'id' => 64,
            'iso' => 'DM',
            'nombre' => 'Dominica',
            'name' => 'Dominica',
            'nom' => 'Dominique'
        ),
        array(
            'id' => 65,
            'iso' => 'DO',
            'nombre' => 'República Dominicana',
            'name' => 'Dominican Republic',
            'nom' => 'République dominicaine'
        ),
        array(
            'id' => 66,
            'iso' => 'EC',
            'nombre' => 'Ecuador',
            'name' => 'Ecuador',
            'nom' => 'Équateur'
        ),
        array(
            'id' => 67,
            'iso' => 'EG',
            'nombre' => 'Egipto',
            'name' => 'Egypt',
            'nom' => 'Égypte'
        ),
        array(
            'id' => 68,
            'iso' => 'SV',
            'nombre' => 'El Salvador',
            'name' => 'El Salvador',
            'nom' => 'El Salvador'
        ),
        array(
            'id' => 69,
            'iso' => 'AE',
            'nombre' => 'Emiratos Árabes Unidos',
            'name' => 'United Arab Emirates',
            'nom' => 'Émirats arabes unis'
        ),
        array(
            'id' => 70,
            'iso' => 'ER',
            'nombre' => 'Eritrea',
            'name' => 'Eritrea',
            'nom' => 'Erythrée'
        ),
        array(
            'id' => 71,
            'iso' => 'SK',
            'nombre' => 'Eslovaquia',
            'name' => 'Slovakia',
            'nom' => 'Slovaquie'
        ),
        array(
            'id' => 72,
            'iso' => 'SI',
            'nombre' => 'Eslovenia',
            'name' => 'Slovenia',
            'nom' => 'Slovénie'
        ),
        array(
            'id' => 73,
            'iso' => 'ES',
            'nombre' => 'España',
            'name' => 'Spain',
            'nom' => 'Espagne'
        ),
        array(
            'id' => 74,
            'iso' => 'UM',
            'nombre' => 'Islas ultramarinas de Estados Unidos',
            'name' => 'United States Overseas Islands',
            'nom' => "Îles d'outre-mer des États-Unis"
        ),
        array(
            'id' => 75,
            'iso' => 'US',
            'nombre' => 'Estados Unidos',
            'name' => 'United States',
            'nom' => 'États Unis'
        ),
        array(
            'id' => 76,
            'iso' => 'EE',
            'nombre' => 'Estonia',
            'name' => 'Estonia',
            'nom' => 'Estonie'
        ),
        array(
            'id' => 77,
            'iso' => 'ET',
            'nombre' => 'Etiopía',
            'name' => 'Ethiopia',
            'nom' => 'Éthiopie'
        ),
        array(
            'id' => 78,
            'iso' => 'FO',
            'nombre' => 'Islas Feroe',
            'name' => 'Faroe Islands',
            'nom' => 'Îles Féroé'
        ),
        array(
            'id' => 79,
            'iso' => 'PH',
            'nombre' => 'Filipinas',
            'name' => 'Philippines',
            'nom' => 'Philippines'
        ),
        array(
            'id' => 80,
            'iso' => 'FI',
            'nombre' => 'Finlandia',
            'name' => 'Finland',
            'nom' => 'Finlande'
        ),
        array(
            'id' => 81,
            'iso' => 'FJ',
            'nombre' => 'Fiyi',
            'name' => 'Fiji',
            'nom' => 'Fidji'
        ),
        array(
            'id' => 82,
            'iso' => 'FR',
            'nombre' => 'Francia',
            'name' => 'France',
            'nom' => 'France'
        ),
        array(
            'id' => 83,
            'iso' => 'GA',
            'nombre' => 'Gabón',
            'name' => 'Gabon',
            'nom' => 'Gabon'
        ),
        array(
            'id' => 84,
            'iso' => 'GM',
            'nombre' => 'Gambia',
            'name' => 'Gambia',
            'nom' => 'Gambie'
        ),
        array(
            'id' => 85,
            'iso' => 'GE',
            'nombre' => 'Georgia',
            'name' => 'Georgia',
            'nom' => 'Géorgie'
        ),
        array(
            'id' => 86,
            'iso' => 'GS',
            'nombre' => 'Islas Georgias del Sur y Sandwich del Sur',
            'name' => 'South Georgia and the South Sandwich Islands',
            'nom' => 'Géorgie du Sud et îles Sandwich du Sud'
        ),
        array(
            'id' => 87,
            'iso' => 'GH',
            'nombre' => 'Ghana',
            'name' => 'Ghana',
            'nom' => 'Ghana'
        ),
        array(
            'id' => 88,
            'iso' => 'GI',
            'nombre' => 'Gibraltar',
            'name' => 'Gibraltar',
            'nom' => 'Gibraltar'
        ),
        array(
            'id' => 89,
            'iso' => 'GD',
            'nombre' => 'Granada',
            'name' => 'Grenada',
            'nom' => 'Grenade'
        ),
        array(
            'id' => 90,
            'iso' => 'GR',
            'nombre' => 'Grecia',
            'name' => 'Greece',
            'nom' => 'Grèce'
        ),
        array(
            'id' => 91,
            'iso' => 'GL',
            'nombre' => 'Groenlandia',
            'name' => 'Greenland',
            'nom' => 'Groenland'
        ),
        array(
            'id' => 92,
            'iso' => 'GP',
            'nombre' => 'Guadalupe',
            'name' => 'Guadeloupe',
            'nom' => 'Guadeloupe'
        ),
        array(
            'id' => 93,
            'iso' => 'GU',
            'nombre' => 'Guam',
            'name' => 'Guam',
            'nom' => 'Guam'
        ),
        array(
            'id' => 94,
            'iso' => 'GT',
            'nombre' => 'Guatemala',
            'name' => 'Guatemala',
            'nom' => 'Guatemala'
        ),
        array(
            'id' => 95,
            'iso' => 'GF',
            'nombre' => 'Guayana Francesa',
            'name' => 'French Guiana',
            'nom' => 'Guyane française'
        ),
        array(
            'id' => 96,
            'iso' => 'GN',
            'nombre' => 'Guinea',
            'name' => 'Guinea',
            'nom' => 'Guinée'
        ),
        array(
            'id' => 97,
            'iso' => 'GQ',
            'nombre' => 'Guinea Ecuatorial',
            'name' => 'Equatorial Guinea',
            'nom' => 'Guinée équatoriale'
        ),
        array(
            'id' => 98,
            'iso' => 'GW',
            'nombre' => 'Guinea-Bissau',
            'name' => 'Guinea-Bissau',
            'nom' => 'Guinée-Bissau'
        ),
        array(
            'id' => 99,
            'iso' => 'GY',
            'nombre' => 'Guyana',
            'name' => 'Guyana',
            'nom' => 'Guyana'
        ),
        array(
            'id' => 100,
            'iso' => 'HT',
            'nombre' => 'Haití',
            'name' => 'Haiti',
            'nom' => 'Haïti'
        ),
        array(
            'id' => 101,
            'iso' => 'HM',
            'nombre' => 'Islas Heard y McDonald',
            'name' => 'Heard and McDonald Islands',
            'nom' => 'Îles Heard et McDonald'
        ),
        array(
            'id' => 102,
            'iso' => 'HN',
            'nombre' => 'Honduras',
            'name' => 'Honduras',
            'nom' => 'Honduras'
        ),
        array(
            'id' => 103,
            'iso' => 'HK',
            'nombre' => 'Hong Kong',
            'name' => 'Hong Kong',
            'nom' => 'Hong Kong'
        ),
        array(
            'id' => 104,
            'iso' => 'HU',
            'nombre' => 'Hungría',
            'name' => 'Hungary',
            'nom' => 'Hongrie'
        ),
        array(
            'id' => 105,
            'iso' => 'IN',
            'nombre' => 'India',
            'name' => 'India',
            'nom' => 'Inde'
        ),
        array(
            'id' => 106,
            'iso' => 'ID',
            'nombre' => 'Indonesia',
            'name' => 'Indonesia',
            'nom' => 'Indonésie'
        ),
        array(
            'id' => 107,
            'iso' => 'IR',
            'nombre' => 'Irán',
            'name' => 'Iran',
            'nom' => 'Iran'
        ),
        array(
            'id' => 108,
            'iso' => 'IQ',
            'nombre' => 'Iraq',
            'name' => 'Iraq',
            'nom' => 'Irak'
        ),
        array(
            'id' => 109,
            'iso' => 'IE',
            'nombre' => 'Irlanda',
            'name' => 'Ireland',
            'nom' => 'Irlande'
        ),
        array(
            'id' => 110,
            'iso' => 'IS',
            'nombre' => 'Islandia',
            'name' => 'Iceland',
            'nom' => 'Islande'
        ),
        array(
            'id' => 111,
            'iso' => 'IL',
            'nombre' => 'Israel',
            'name' => 'Israel',
            'nom' => 'Israël'
        ),
        array(
            'id' => 112,
            'iso' => 'IT',
            'nombre' => 'Italia',
            'name' => 'Italy',
            'nom' => 'Italie'
        ),
        array(
            'id' => 113,
            'iso' => 'JM',
            'nombre' => 'Jamaica',
            'name' => 'Jamaica',
            'nom' => 'Jamaïque'
        ),
        array(
            'id' => 114,
            'iso' => 'JP',
            'nombre' => 'Japón',
            'name' => 'Japan',
            'nom' => 'Japon'
        ),
        array(
            'id' => 115,
            'iso' => 'JO',
            'nombre' => 'Jordania',
            'name' => 'Jordan',
            'nom' => 'Jordanie'
        ),
        array(
            'id' => 116,
            'iso' => 'KZ',
            'nombre' => 'Kazajstán',
            'name' => 'Kazakhstan',
            'nom' => 'Kazakhstan'
        ),
        array(
            'id' => 117,
            'iso' => 'KE',
            'nombre' => 'Kenia',
            'name' => 'Kenya',
            'nom' => 'Kenya'
        ),
        array(
            'id' => 118,
            'iso' => 'KG',
            'nombre' => 'Kirguistán',
            'name' => 'Kyrgyzstan',
            'nom' => 'Kirghizistan'
        ),
        array(
            'id' => 119,
            'iso' => 'KI',
            'nombre' => 'Kiribati',
            'name' => 'Kiribati',
            'nom' => 'Kiribati'
        ),
        array(
            'id' => 120,
            'iso' => 'KW',
            'nombre' => 'Kuwait',
            'name' => 'Kuwait',
            'nom' => 'Koweït'
        ),
        array(
            'id' => 121,
            'iso' => 'LA',
            'nombre' => 'Laos',
            'name' => 'Laos',
            'nom' => 'Laos'
        ),
        array(
            'id' => 122,
            'iso' => 'LS',
            'nombre' => 'Lesotho',
            'name' => 'Lesotho',
            'nom' => 'Lesotho'
        ),
        array(
            'id' => 123,
            'iso' => 'LV',
            'nombre' => 'Letonia',
            'name' => 'Latvia',
            'nom' => 'Lettonie'
        ),
        array(
            'id' => 124,
            'iso' => 'LB',
            'nombre' => 'Líbano',
            'name' => 'Lebanon',
            'nom' => 'Liban'
        ),
        array(
            'id' => 125,
            'iso' => 'LR',
            'nombre' => 'Liberia',
            'name' => 'Liberia',
            'nom' => 'Libéria'
        ),
        array(
            'id' => 126,
            'iso' => 'LY',
            'nombre' => 'Libia',
            'name' => 'Libya',
            'nom' => 'Libye'
        ),
        array(
            'id' => 127,
            'iso' => 'LI',
            'nombre' => 'Liechtenstein',
            'name' => 'Liechtenstein',
            'nom' => 'Liechtenstein'
        ),
        array(
            'id' => 128,
            'iso' => 'LT',
            'nombre' => 'Lituania',
            'name' => 'Lithuania',
            'nom' => 'Lituanie'
        ),
        array(
            'id' => 129,
            'iso' => 'LU',
            'nombre' => 'Luxemburgo',
            'name' => 'Luxembourg',
            'nom' => 'Luxembourg'
        ),
        array(
            'id' => 130,
            'iso' => 'MO',
            'nombre' => 'Macao',
            'name' => 'Macau',
            'nom' => 'Macao'
        ),
        array(
            'id' => 131,
            'iso' => 'MK',
            'nombre' => 'ARY Macedonia',
            'name' => 'ARY Macedonia',
            'nom' => 'ARY Macedonia'
        ),
        array(
            'id' => 132,
            'iso' => 'MG',
            'nombre' => 'Madagascar',
            'name' => 'Madagascar',
            'nom' => 'Madagascar'
        ),
        array(
            'id' => 133,
            'iso' => 'MY',
            'nombre' => 'Malasia',
            'name' => 'Malaysia',
            'nom' => 'Malaisie'
        ),
        array(
            'id' => 134,
            'iso' => 'MW',
            'nombre' => 'Malawi',
            'name' => 'Malawi',
            'nom' => 'Malawi'
        ),
        array(
            'id' => 135,
            'iso' => 'MV',
            'nombre' => 'Maldivas',
            'name' => 'Maldives',
            'nom' => 'Maldives'
        ),
        array(
            'id' => 136,
            'iso' => 'ML',
            'nombre' => 'Malí',
            'name' => 'Mali',
            'nom' => 'Mali'
        ),
        array(
            'id' => 137,
            'iso' => 'MT',
            'nombre' => 'Malta',
            'name' => 'Malta',
            'nom' => 'Malte'
        ),
        array(
            'id' => 138,
            'iso' => 'FK',
            'nombre' => 'Islas Malvinas',
            'name' => 'Falkland Islands',
            'nom' => 'Îles Malouines'
        ),
        array(
            'id' => 139,
            'iso' => 'MP',
            'nombre' => 'Islas Marianas del Norte',
            'name' => 'Northern Mariana Islands',
            'nom' => 'Îles Mariannes du Nord'
        ),
        array(
            'id' => 140,
            'iso' => 'MA',
            'nombre' => 'Marruecos',
            'name' => 'Morocco',
            'nom' => 'Maroc'
        ),
        array(
            'id' => 141,
            'iso' => 'MH',
            'nombre' => 'Islas Marshall',
            'name' => 'Marshall Islands',
            'nom' => 'Îles Marshall'
        ),
        array(
            'id' => 142,
            'iso' => 'MQ',
            'nombre' => 'Martinica',
            'name' => 'Martinique',
            'nom' => 'Martinique'
        ),
        array(
            'id' => 143,
            'iso' => 'MU',
            'nombre' => 'Mauricio',
            'name' => 'Mauritius',
            'nom' => 'Maurice'
        ),
        array(
            'id' => 144,
            'iso' => 'MR',
            'nombre' => 'Mauritania',
            'name' => 'Mauritania',
            'nom' => 'Mauritanie'
        ),
        array(
            'id' => 145,
            'iso' => 'YT',
            'nombre' => 'Mayotte',
            'name' => 'Mayotte',
            'nom' => 'Mayotte'
        ),
        array(
            'id' => 146,
            'iso' => 'MX',
            'nombre' => 'México',
            'name' => 'Mexico',
            'nom' => 'Mexique'
        ),
        array(
            'id' => 147,
            'iso' => 'FM',
            'nombre' => 'Micronesia',
            'name' => 'Micronesia',
            'nom' => 'Micronésie'
        ),
        array(
            'id' => 148,
            'iso' => 'MD',
            'nombre' => 'Moldavia',
            'name' => 'Moldova',
            'nom' => 'Moldavie'
        ),
        array(
            'id' => 149,
            'iso' => 'MC',
            'nombre' => 'Mónaco',
            'name' => 'Monaco',
            'nom' => 'Monaco'
        ),
        array(
            'id' => 150,
            'iso' => 'MN',
            'nombre' => 'Mongolia',
            'name' => 'Mongolia',
            'nom' => 'Mongolie'
        ),
        array(
            'id' => 151,
            'iso' => 'MS',
            'nombre' => 'Montserrat',
            'name' => 'Montserrat',
            'nom' => 'Montserrat'
        ),
        array(
            'id' => 152,
            'iso' => 'MZ',
            'nombre' => 'Mozambique',
            'name' => 'Mozambique',
            'nom' => 'Mozambique'
        ),
        array(
            'id' => 153,
            'iso' => 'MM',
            'nombre' => 'Myanmar',
            'name' => 'Myanmar',
            'nom' => 'Myanmar'
        ),
        array(
            'id' => 154,
            'iso' => 'NA',
            'nombre' => 'Namibia',
            'name' => 'Namibia',
            'nom' => 'Namibia'
        ),
        array(
            'id' => 155,
            'iso' => 'NR',
            'nombre' => 'Nauru',
            'name' => 'Nauru',
            'nom' => 'Nauru'
        ),
        array(
            'id' => 156,
            'iso' => 'NP',
            'nombre' => 'Nepal',
            'name' => 'Nepal',
            'nom' => 'Népal'
        ),
        array(
            'id' => 157,
            'iso' => 'NI',
            'nombre' => 'Nicaragua',
            'name' => 'Nicaragua',
            'nom' => 'Nicaragua'
        ),
        array(
            'id' => 158,
            'iso' => 'NE',
            'nombre' => 'Níger',
            'name' => 'Niger',
            'nom' => 'Niger'
        ),
        array(
            'id' => 159,
            'iso' => 'NG',
            'nombre' => 'Nigeria',
            'name' => 'Nigeria',
            'nom' => 'Nigéria'
        ),
        array(
            'id' => 160,
            'iso' => 'NU',
            'nombre' => 'Niue',
            'name' => 'Niue',
            'nom' => 'Niue'
        ),
        array(
            'id' => 161,
            'iso' => 'NF',
            'nombre' => 'Isla Norfolk',
            'name' => 'Norfolk Island',
            'nom' => 'Île Norfolk'
        ),
        array(
            'id' => 162,
            'iso' => 'NO',
            'nombre' => 'Noruega',
            'name' => 'Norway',
            'nom' => 'Norvège'
        ),
        array(
            'id' => 163,
            'iso' => 'NC',
            'nombre' => 'Nueva Caledonia',
            'name' => 'New Caledonia',
            'nom' => 'Nouvelle-Calédonie'
        ),
        array(
            'id' => 164,
            'iso' => 'NZ',
            'nombre' => 'Nueva Zelanda',
            'name' => 'New Zealand',
            'nom' => 'Nouvelle-Zélande'
        ),
        array(
            'id' => 165,
            'iso' => 'OM',
            'nombre' => 'Omán',
            'name' => 'Oman',
            'nom' => 'Oman'
        ),
        array(
            'id' => 166,
            'iso' => 'NL',
            'nombre' => 'Países Bajos',
            'name' => 'The Netherlands',
            'nom' => 'Pays Bas'
        ),
        array(
            'id' => 167,
            'iso' => 'PK',
            'nombre' => 'Pakistán',
            'name' => 'Pakistan',
            'nom' => 'Pakistan'
        ),
        array(
            'id' => 168,
            'iso' => 'PW',
            'nombre' => 'Palau',
            'name' => 'Palau',
            'nom' => 'Palaos'
        ),
        array(
            'id' => 169,
            'iso' => 'PS',
            'nombre' => 'Palestina',
            'name' => 'Palestine',
            'nom' => 'Palestine'
        ),
        array(
            'id' => 170,
            'iso' => 'PA',
            'nombre' => 'Panamá',
            'name' => 'Panama',
            'nom' => 'Panama'
        ),
        array(
            'id' => 171,
            'iso' => 'PG',
            'nombre' => 'Papúa Nueva Guinea',
            'name' => 'Papua New Guinea',
            'nom' => 'Papouasie Nouvelle Guinée'
        ),
        array(
            'id' => 172,
            'iso' => 'PY',
            'nombre' => 'Paraguay',
            'name' => 'Paraguay',
            'nom' => 'Paraguay'
        ),
        array(
            'id' => 173,
            'iso' => 'PE',
            'nombre' => 'Perú',
            'name' => 'Peru',
            'nom' => 'Pérou'
        ),
        array(
            'id' => 174,
            'iso' => 'PN',
            'nombre' => 'Islas Pitcairn',
            'name' => 'Pitcairn Islands',
            'nom' => 'Îles Pitcairn'
        ),
        array(
            'id' => 175,
            'iso' => 'PF',
            'nombre' => 'Polinesia Francesa',
            'name' => 'French Polynesia',
            'nom' => 'Polynésie française'
        ),
        array(
            'id' => 176,
            'iso' => 'PL',
            'nombre' => 'Polonia',
            'name' => 'Poland',
            'nom' => 'Pologne'
        ),
        array(
            'id' => 177,
            'iso' => 'PT',
            'nombre' => 'Portugal',
            'name' => 'Portugal',
            'nom' => 'Portugal'
        ),
        array(
            'id' => 178,
            'iso' => 'PR',
            'nombre' => 'Puerto Rico',
            'name' => 'Puerto Rico',
            'nom' => 'Porto Rico'
        ),
        array(
            'id' => 179,
            'iso' => 'QA',
            'nombre' => 'Qatar',
            'name' => 'Qatar',
            'nom' => 'Qatar'
        ),
        array(
            'id' => 180,
            'iso' => 'GB',
            'nombre' => 'Reino Unido',
            'name' => 'United Kingdom',
            'nom' => 'Royaume Uni'
        ),
        array(
            'id' => 181,
            'iso' => 'RE',
            'nombre' => 'Reunión',
            'name' => 'Reunion',
            'nom' => 'Rassemblement'
        ),
        array(
            'id' => 182,
            'iso' => 'RW',
            'nombre' => 'Ruanda',
            'name' => 'Rwanda',
            'nom' => 'Rwanda'
        ),
        array(
            'id' => 183,
            'iso' => 'RO',
            'nombre' => 'Rumania',
            'name' => 'Romania',
            'nom' => 'Roumanie'
        ),
        array(
            'id' => 184,
            'iso' => 'RU',
            'nombre' => 'Rusia',
            'name' => 'Russia',
            'nom' => 'Russie'
        ),
        array(
            'id' => 185,
            'iso' => 'EH',
            'nombre' => 'Sahara Occidental',
            'name' => 'Western Sahara',
            'nom' => 'Sahara Occidental'
        ),
        array(
            'id' => 186,
            'iso' => 'SB',
            'nombre' => 'Islas Salomón',
            'name' => 'Solomon Islands',
            'nom' => 'Îles Salomon'
        ),
        array(
            'id' => 187,
            'iso' => 'WS',
            'nombre' => 'Samoa',
            'name' => 'Samoa',
            'nom' => 'Samoa'
        ),
        array(
            'id' => 188,
            'iso' => 'AS',
            'nombre' => 'Samoa Americana',
            'name' => 'American Samoa',
            'nom' => 'Samoa américaines'
        ),
        array(
            'id' => 189,
            'iso' => 'KN',
            'nombre' => 'San Cristóbal y Nevis',
            'name' => 'Saint Kitts and Nevis',
            'nom' => 'Saint-Christophe-et-Nevis'
        ),
        array(
            'id' => 190,
            'iso' => 'SM',
            'nombre' => 'San Marino',
            'name' => 'San Marino',
            'nom' => 'Saint-Marin'
        ),
        array(
            'id' => 191,
            'iso' => 'PM',
            'nombre' => 'San Pedro y Miquelón',
            'name' => 'Saint Pierre and Miquelon',
            'nom' => 'Saint Pierre et Miquelon'
        ),
        array(
            'id' => 192,
            'iso' => 'VC',
            'nombre' => 'San Vicente y las Granadinas',
            'name' => 'Saint Vincent And The Grenadines',
            'nom' => 'Saint-Vincent-et-les Grenadines'
        ),
        array(
            'id' => 193,
            'iso' => 'SH',
            'nombre' => 'Santa Helena',
            'name' => 'St. Helena',
            'nom' => 'Sainte Hélène'
        ),
        array(
            'id' => 194,
            'iso' => 'LC',
            'nombre' => 'Santa Lucía',
            'name' => 'Saint Lucia',
            'nom' => 'Sainte-Lucie'
        ),
        array(
            'id' => 195,
            'iso' => 'ST',
            'nombre' => 'Santo Tomé y Príncipe',
            'name' => 'Sao Tome and Principe',
            'nom' => 'Sao Tomé-et-Principe'
        ),
        array(
            'id' => 196,
            'iso' => 'SN',
            'nombre' => 'Senegal',
            'name' => 'Senegal',
            'nom' => 'Sénégal'
        ),
        array(
            'id' => 197,
            'iso' => 'CS',
            'nombre' => 'Serbia y Montenegro',
            'name' => 'Serbia and Montenegro',
            'nom' => 'Serbie-et-Monténégro'
        ),
        array(
            'id' => 198,
            'iso' => 'SC',
            'nombre' => 'Seychelles',
            'name' => 'Seychelles',
            'nom' => 'Seychelles'
        ),
        array(
            'id' => 199,
            'iso' => 'SL',
            'nombre' => 'Sierra Leona',
            'name' => 'Sierra Leone',
            'nom' => 'Sierra Leone'
        ),
        array(
            'id' => 200,
            'iso' => 'SG',
            'nombre' => 'Singapur',
            'name' => 'Singapore',
            'nom' => 'Singapour'
        ),
        array(
            'id' => 201,
            'iso' => 'SY',
            'nombre' => 'Siria',
            'name' => 'Syria',
            'nom' => 'Syrie'
        ),
        array(
            'id' => 202,
            'iso' => 'SO',
            'nombre' => 'Somalia',
            'name' => 'Somalia',
            'nom' => 'Somalie'
        ),
        array(
            'id' => 203,
            'iso' => 'LK',
            'nombre' => 'Sri Lanka',
            'name' => 'Sri Lanka',
            'nom' => 'Sri Lanka'
        ),
        array(
            'id' => 204,
            'iso' => 'SZ',
            'nombre' => 'Suazilandia',
            'name' => 'Swaziland',
            'nom' => 'Swaziland'
        ),
        array(
            'id' => 205,
            'iso' => 'ZA',
            'nombre' => 'Sudáfrica',
            'name' => 'South Africa',
            'nom' => 'Afrique du Sud'
        ),
        array(
            'id' => 206,
            'iso' => 'SD',
            'nombre' => 'Sudán',
            'name' => 'Sudan',
            'nom' => 'Soudan'
        ),
        array(
            'id' => 207,
            'iso' => 'SE',
            'nombre' => 'Suecia',
            'name' => 'Sweden',
            'nom' => 'Suède'
        ),
        array(
            'id' => 208,
            'iso' => 'CH',
            'nombre' => 'Suiza',
            'name' => 'Switzerland',
            'nom' => 'Suisse'
        ),
        array(
            'id' => 209,
            'iso' => 'SR',
            'nombre' => 'Surinam',
            'name' => 'Suriname',
            'nom' => 'Suriname'
        ),
        array(
            'id' => 210,
            'iso' => 'SJ',
            'nombre' => 'Svalbard y Jan Mayen',
            'name' => 'Svalbard and Jan Mayen',
            'nom' => 'Svalbard et Jan Mayen'
        ),
        array(
            'id' => 211,
            'iso' => 'TH',
            'nombre' => 'Tailandia',
            'name' => 'Thailand',
            'nom' => 'Thaïlande'
        ),
        array(
            'id' => 212,
            'iso' => 'TW',
            'nombre' => 'Taiwán',
            'name' => 'Taiwan',
            'nom' => 'Taïwan'
        ),
        array(
            'id' => 213,
            'iso' => 'TZ',
            'nombre' => 'Tanzania',
            'name' => 'Tanzania',
            'nom' => 'Tanzanie'
        ),
        array(
            'id' => 214,
            'iso' => 'TJ',
            'nombre' => 'Tayikistán',
            'name' => 'Tajikistan',
            'nom' => 'Tadjikistan'
        ),
        array(
            'id' => 215,
            'iso' => 'IO',
            'nombre' => 'Territorio Británico del Océano Índico',
            'name' => 'British Indian Ocean Territory',
            'nom' => "Territoire britannique de l'océan Indien"
        ),
        array(
            'id' => 216,
            'iso' => 'TF',
            'nombre' => 'Territorios Australes Franceses',
            'name' => 'French Southern Territories',
            'nom' => 'Territoires Austraux Français'
        ),
        array(
            'id' => 217,
            'iso' => 'TL',
            'nombre' => 'Timor Oriental',
            'name' => 'East Timor',
            'nom' => 'Timor oriental'
        ),
        array(
            'id' => 218,
            'iso' => 'TG',
            'nombre' => 'Togo',
            'name' => 'Togo',
            'nom' => 'Togo'
        ),
        array(
            'id' => 219,
            'iso' => 'TK',
            'nombre' => 'Tokelau',
            'name' => 'Tokelau',
            'nom' => 'Tokélaou'
        ),
        array(
            'id' => 220,
            'iso' => 'TO',
            'nombre' => 'Tonga',
            'name' => 'Tonga',
            'nom' => 'Tonga'
        ),
        array(
            'id' => 221,
            'iso' => 'TT',
            'nombre' => 'Trinidad y Tobago',
            'name' => 'Trinidad and Tobago',
            'nom' => 'Trinité-et-Tobago'
        ),
        array(
            'id' => 222,
            'iso' => 'TN',
            'nombre' => 'Túnez',
            'name' => 'Tunisia',
            'nom' => 'Tunisie'
        ),
        array(
            'id' => 223,
            'iso' => 'TC',
            'nombre' => 'Islas Turcas y Caicos',
            'name' => 'Turks and Caicos Islands',
            'nom' => 'Îles Turques et Caïques'
        ),
        array(
            'id' => 224,
            'iso' => 'TM',
            'nombre' => 'Turkmenistán',
            'name' => 'Turkmenistan',
            'nom' => 'Turkménistan'
        ),
        array(
            'id' => 225,
            'iso' => 'TR',
            'nombre' => 'Turquía',
            'name' => 'Turkey',
            'nom' => 'Turquie'
        ),
        array(
            'id' => 226,
            'iso' => 'TV',
            'nombre' => 'Tuvalu',
            'name' => 'Tuvalu',
            'nom' => 'Tuvalu'
        ),
        array(
            'id' => 227,
            'iso' => 'UA',
            'nombre' => 'Ucrania',
            'name' => 'Ukraine',
            'nom' => 'Ukraine'
        ),
        array(
            'id' => 228,
            'iso' => 'UG',
            'nombre' => 'Uganda',
            'name' => 'Uganda',
            'nom' => 'Ouganda'
        ),
        array(
            'id' => 229,
            'iso' => 'UY',
            'nombre' => 'Uruguay',
            'name' => 'Uruguay',
            'nom' => 'Uruguay'
        ),
        array(
            'id' => 230,
            'iso' => 'UZ',
            'nombre' => 'Uzbekistán',
            'name' => 'Uzbekistan',
            'nom' => 'Ouzbékistan'
        ),
        array(
            'id' => 231,
            'iso' => 'VU',
            'nombre' => 'Vanuatu',
            'name' => 'Vanuatu',
            'nom' => 'Vanuatu'
        ),
        array(
            'id' => 232,
            'iso' => 'VE',
            'nombre' => 'Venezuela',
            'name' => 'Venezuela',
            'nom' => 'Venezuela'
        ),
        array(
            'id' => 233,
            'iso' => 'VN',
            'nombre' => 'Vietnam',
            'name' => 'Vietnam',
            'nom' => 'Vietnam'
        ),
        array(
            'id' => 234,
            'iso' => 'VG',
            'nombre' => 'Islas Vírgenes Británicas',
            'name' => 'British Virgin Islands',
            'nom' => 'Îles Vierges britanniques'
        ),
        array(
            'id' => 235,
            'iso' => 'VI',
            'nombre' => 'Islas Vírgenes de los Estados Unidos',
            'name' => 'United States Virgin Islands',
            'nom' => 'Îles Vierges des États-Unis'
        ),
        array(
            'id' => 236,
            'iso' => 'WF',
            'nombre' => 'Wallis y Futuna',
            'name' => 'Wallis and Futuna',
            'nom' => 'Wallis et Futuna'
        ),
        array(
            'id' => 237,
            'iso' => 'YE',
            'nombre' => 'Yemen',
            'name' => 'Yemen',
            'nom' => 'Yémen'
        ),
        array(
            'id' => 238,
            'iso' => 'DJ',
            'nombre' => 'Yibuti',
            'name' => 'Djibouti',
            'nom' => 'Djibouti'
        ),
        array(
            'id' => 239,
            'iso' => 'ZM',
            'nombre' => 'Zambia',
            'name' => 'Zambia',
            'nom' => 'Zambie'
        ),
        array(
            'id' => 240,
            'iso' => 'ZW',
            'nombre' => 'Zimbabue',
            'name' => 'Zimbabwe',
            'nom' => 'Zimbabwe'
        ),
    ];

    foreach ($paises as $key => $value) {
        $id = $value['id'];
        $iso = $value['iso'];
        $nombre = $value['nombre'];
        $name = $value['name'];
        $nom = $value['nom'];

        $sql4 = "INSERT INTO `{$wpdb->prefix}paises` (`id`, `iso`, `es`, `en`, `fr`) VALUES ('$id','$iso','$nombre', '$name', '$nom');";
        $wpdb->query($sql4);
    }

    $sql5 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}weights_air` (
            `aid` int(11) NOT NULL AUTO_INCREMENT,
            `weight_detalle` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            PRIMARY KEY (`aid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql5);

    $sql6 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rates_air` (
            `aid` int(11) NOT NULL AUTO_INCREMENT,
            `rate_country` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            PRIMARY KEY (`aid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql6);

    $sql7 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rates_maritime` (
            `aid` int(11) NOT NULL AUTO_INCREMENT,
            `rate_country` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            PRIMARY KEY (`aid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql7);

    $sql8 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rates_country` (
            `aid` int(11) NOT NULL AUTO_INCREMENT,
            `rate_country` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            PRIMARY KEY (`aid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql8);

    $sql9 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}weights_maritime` (
            `aid` int(11) NOT NULL AUTO_INCREMENT,
            `weight_detalle` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            PRIMARY KEY (`aid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql9);

    $sql10 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}k_products` (
            `product_aid` int(11) NOT NULL AUTO_INCREMENT,
            `product_tags` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_line` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_category` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_subcategory` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_es` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_en` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_fr` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_de` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_ee` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_it` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_nl` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_pl` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_pt` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_name_se` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_maker` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_model` varchar(80) DEFAULT NULL,
            `product_image` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_description` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_technical_description` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_peso_neto` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_peso_bruto` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_alto` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_ancho` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_largo` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_alto_paquete` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_ancho_paquete` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_largo_paquete` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
            `product_priceUSD` DECIMAL(10,2) NOT NULL ,
            `product_priceEUR` DECIMAL(10,2) NOT NULL ,
            `product_create_at` TIMESTAMP NOT NULL , 
            PRIMARY KEY (`product_aid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($sql10);
}

function deactivated()
{

}



register_activation_hook(__FILE__, 'activated');

register_deactivation_hook(__FILE__, 'deactivated');



add_action('admin_menu', 'createdMenu');

function createdMenu()
{
    add_menu_page(
        'Quote', //Título
        'Quote', //Título del menu
        'manage_options', //Capability
        plugin_dir_path(__FILE__) . 'classes/cotizacion.php', //Slug
        null,//Contenido
        plugin_dir_url(__FILE__) . 'assets/images/icon.png',//Icono
        '4' //Priority
    );

    add_submenu_page(
        plugin_dir_path(__FILE__) . 'classes/cotizacion.php', //Slug Parents
        'Rates', //Título
        'Rates', //Título del submenu
        'manage_options', //Capability
        plugin_dir_path(__FILE__) . 'classes/tarifas.php' //Slug
    );

    add_submenu_page(
        plugin_dir_path(__FILE__) . 'classes/cotizacion.php', //Slug Parents
        'Products', //Título
        'Products', //Título del submenu
        'manage_options', //Capability
        plugin_dir_path(__FILE__) . 'classes/productos.php' //Slug
    );

}



//Boostrap JS

function bootstrapJS($hook)
{

    if ($hook != 'kalsteinCotizacion/classes/cotizacion.php' && $hook != 'kalsteinCotizacion/classes/tarifas.php' && $hook != 'kalsteinCotizacion/classes/productos.php') {
        return;
    }

    wp_enqueue_script('bootstrapJS', plugins_url('assets/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
}

add_action('admin_enqueue_scripts', 'bootstrapJS');


//JS
function JS($hook)
{
    if ($hook != 'kalsteinCotizacion/classes/cotizacion.php' && $hook != 'kalsteinCotizacion/classes/tarifas.php' && $hook != 'kalsteinCotizacion/classes/productos.php') {
        return;
    }

    wp_enqueue_script('JS', plugins_url('assets/js/script.js', __FILE__), array('jquery'));
}

add_action('admin_enqueue_scripts', 'JS');


//jQuery Cookie

function jQueryCookie($hook)
{
    if ($hook != 'kalsteinCotizacion/classes/cotizacion.php' && $hook != 'kalsteinCotizacion/classes/tarifas.php' && $hook != 'kalsteinCotizacion/classes/productos.php') {
        return;
    }

    wp_enqueue_script('jQueryCookie', plugins_url('assets/js/jquery.cookie.js', __FILE__), array('jquery'));
}

add_action('admin_enqueue_scripts', 'jQueryCookie');

//Boostrap CSS
function bootstrapCSS($hook)
{
    if ($hook != 'kalsteinCotizacion/classes/cotizacion.php' && $hook != 'kalsteinCotizacion/classes/tarifas.php' && $hook != 'kalsteinCotizacion/classes/productos.php') {
        return;
    }

    wp_enqueue_style('bootstrapCSS', plugins_url('assets/bootstrap/css/bootstrap.min.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'bootstrapCSS');

//CSS
function CSS($hook)
{
    if ($hook != 'kalsteinCotizacion/classes/cotizacion.php' && $hook != 'kalsteinCotizacion/classes/tarifas.php' && $hook != 'kalsteinCotizacion/classes/productos.php') {
        return;
    }

    wp_enqueue_style('CSS', plugins_url('assets/css/style.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'CSS');

//SHORTCODE
function shortcode()
{
    $_short = new shortcode;

    $html = $_short->body();
    return $html;
}

function shortcode_es()
{
    $_short = new shortcode;

    $html = $_short->body_es();
    return $html;
}

function shortcode_fr()
{
    $_short = new shortcode;

    $html = $_short->body_fr();
    return $html;
}

function shortcode_de()
{
    $_short = new shortcode;

    $html = $_short->body_de();
    return $html;
}

function shortcode_ee()
{
    $_short = new shortcode;

    $html = $_short->body_ee();
    return $html;
}

function shortcode_it()
{
    $_short = new shortcode;

    $html = $_short->body_it();
    return $html;
}

function shortcode_nl()
{
    $_short = new shortcode;

    $html = $_short->body_nl();
    return $html;
}

function shortcode_pl()
{
    $_short = new shortcode;

    $html = $_short->body_pl();
    return $html;
}

function shortcode_pt()
{
    $_short = new shortcode;

    $html = $_short->body_pt();
    return $html;
}

function shortcode_se()
{
    $_short = new shortcode;

    $html = $_short->body_se();
    return $html;
}

function resultPage()
{
    $_short = new shortcode;

    $html = $_short->resultPage();
    return $html;
}

function resultPage_es()
{
    $_short = new shortcode;

    $html = $_short->resultPage_es();
    return $html;
}

function resultPage_fr()
{
    $_short = new shortcode;

    $html = $_short->resultPage_fr();
    return $html;
}

function resultPage_de()
{
    $_short = new shortcode;

    $html = $_short->resultPage_de();
    return $html;
}

function resultPage_ee()
{
    $_short = new shortcode;

    $html = $_short->resultPage_ee();
    return $html;
}

function resultPage_it()
{
    $_short = new shortcode;

    $html = $_short->resultPage_it();
    return $html;
}

function resultPage_nl()
{
    $_short = new shortcode;

    $html = $_short->resultPage_nl();
    return $html;
}

function resultPage_pl()
{
    $_short = new shortcode;

    $html = $_short->resultPage_pl();
    return $html;
}

function resultPage_pt()
{
    $_short = new shortcode;

    $html = $_short->resultPage_pt();
    return $html;
}

function resultPage_se()
{
    $_short = new shortcode;

    $html = $_short->resultPage_se();
    return $html;
}

function logIn()
{
    $_short = new shortcode;

    $html = $_short->logIn();
    return $html;
}

function singIn()
{
    $_short = new shortcode;

    $html = $_short->singIn();
    return $html;
}

function navbar()
{
    $_short = new shortcode;

    $html = $_short->navbar();
    return $html;
}

add_shortcode("COTIZACION_KALSTEIN", "shortcode");

add_shortcode("RESULTPAGE_KALSTEIN", "resultPage");

add_shortcode("LOGIN_KALSTEIN", "logIn");

add_shortcode("SINGIN_KALSTEIN", "singIn");

add_shortcode("NAVBAR_KALSTEIN", "navbar");

//Shortcode Styles
// 1
function my_shortcode_styles()
{
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'NAVBAR_KALSTEIN')) {
        wp_enqueue_style('boostrap-css', plugins_url('assets/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_script('boostrap-JS', plugins_url('assets/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'COTIZACION_KALSTEIN')) {
        wp_enqueue_style('shortcode-css', plugins_url('assets/css/styles.cot.css', __FILE__));
        wp_enqueue_script('script-Quote', plugins_url('assets/js/script.cot2.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'LOGIN_KALSTEIN')) {
        wp_enqueue_style('shortcode-css', plugins_url('assets/css/styles.cot.css', __FILE__));
        wp_enqueue_script('JS', plugins_url('assets/js/script.cot2.js', __FILE__), array('jquery'));
    }

    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'SINGIN_KALSTEIN')) {
        wp_enqueue_style('shortcode-css', plugins_url('assets/css/styles.cot.css', __FILE__));
        wp_enqueue_script('JS', plugins_url('assets/js/script.cot2.js', __FILE__), array('jquery'));
    }
}
add_action('wp_enqueue_scripts', 'my_shortcode_styles');