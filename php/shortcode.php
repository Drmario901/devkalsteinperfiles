<?php
//session_start();

function render_php_file($path)
{
    ob_start();
    include(__DIR__ . '/../src/templates-php/' . $path);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

function verify_session($rol)
{
    if (isset($_SESSION["emailAccount"])) {
        if ($_SESSION["emailAccount"] == '') {
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder/');</script>";
        } else {
            $email = $_SESSION["emailAccount"];

            require_once __DIR__ . '/../db/conexion.php';

            $query = "SELECT account_rol_aid, account_status FROM wp_account WHERE account_correo = '$email'";
            $result = $conexion->query($query);

            $row = $result->fetch_array();

            $rolacc = $row[0];
            $status = $row[1];

            // verificacion de baneof
            $fecha_actual = date("Y-m-d");
            if ($status == 'validated') {

                $prevDate = date("Y-m-d", strtotime($fecha_actual . "- 90 days"));
                $current = date('Y-m-d h:i:s');

                $queryBans = "SELECT COUNT(*), ban_time FROM wp_bans WHERE ban_user = '$email' AND ban_time > '$current'";
                /*$resultBans2 = $conexion->query($queryBans); 
                $resultBans = mysqli_fetch_array($resulbans2);*/

                if ($resultBans[0] > 0) {
                    $suspended = true;
                    $time = $resultBans[1];
                } else {

                    $queryStrikes = "SELECT COUNT(*)  FROM wp_atention_calls WHERE to_user = '$email' AND strike = '1' AND create_at >= '$prevDate' AND enabled = '1'";
                    $resultStrikes = $conexion->query($queryStrikes)->fetch_array()[0];

                    if ($resultStrikes >= 3) {

                        $prevDate2 = date("d-m-Y", strtotime($fecha_actual . "- 730 days"));

                        $queryBans = "SELECT COUNT(*) FROM wp_bans WHERE ban_user = '$email' AND ban_created_at >= '$prevDate2'";
                        $resultBans = $conexion->query($queryBans);

                        if ($resultBans->num_rows > 0) {
                            $row = $resultBans->fetch_array();
                            $bt = 1 + 5 * intval($row[0]);
                        } else {
                            $bt = 2;
                        }

                        $banTime = date('Y-m-d', strtotime($fecha_actual . "+ $bt days"));

                        $resultBanned = $conexion->query("INSERT INTO wp_bans (ban_user, ban_time) VALUES ('$email', '$banTime')");
                        $resultBanAccount = $conexion->query("UPDATE wp_account SET account_status = 'suspended'");

                        $suspended = true;
                        $time = date('d/M/Y', $banTime);
                    }
                }
            } else if ($status == 'suspended') {

                $prevDate = date("Y-m-d", strtotime($fecha_actual . "- 90 days"));
                $current = date('Y-m-d h:i:s');

                $queryBans = "SELECT COUNT(*), ban_time FROM wp_bans WHERE ban_user = '$email' AND ban_time > '$current'";
                //$resultBans2 = $conexion->query($queryBans);
                //$resultBans = mysqli_fetch_array($resultbans2);


                if ($resultBans[0] > 0) {
                    $suspended = true;
                    $time = $resultBans[1];
                } else {
                    $queryUnban = $conexion->query("UPDATE wp_account SET accont_status = 'validated' WHERE account_correo = '$email'");

                    $queryDeleteStrikes = $conexion->query("UPDATE wp_atention_calls SET enabled = '0' WHERE to_user = '$email'");
                }
            }

            if (($rolacc == 2 || $rolacc == 3 || $rolacc == 4) && ($status == 'filled' || $status == 'solving')) {
                echo "
                    <script>
                        alert('Su cuenta está siendo verificada, en un plazo de 24 a 48 horas recibirá un correo electrónico de confirmación.');
                        window.location.replace('https://dev.kalstein.plus/plataforma/acceder');
                    </script>";
            } else if ($suspended) {
                echo "
                    <script>
                        alert('Debido a que se han encontrado ciertas llamadas de atención en su historial, hemos suspendido su cuenta hasta el $time.');
                        window.location.replace('https://dev.kalstein.plus/plataforma/acceder');
                    </script>";
            }

            $conexion->close();

            if ($rol != $rolacc) {
                echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/index.php/account_redirect');</script>";
            }
        }
    } else {
        if ($_GET) {
            $search = '?search=' . $_GET['search'];
        } else {
            $search = '';
        }
        echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder$search');</script>";
    }
}

class shortcodePerfiles
{
    function login()
    {
        return render_php_file("accounts/login.php");
    }

    function signup()
    {
        return render_php_file("accounts/signup.php");
    }

    function recoveryPassword()
    {
        return render_php_file('accounts/resetPassword.php');
    }

    function register()
    {
        if (isset($_SESSION["emailAccount"])) {
            $email = $_SESSION["emailAccount"];
        } else {
            header('Location: https://dev.kalstein.plus/plataforma/');
        }
        return render_php_file('accounts/register.php');
    }

    /*function account_redirect(){
        if(isset($_SESSION["emailAccount"])){
            $email = $_SESSION["emailAccount"];
        }else{
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/');</script>";
            return '';
        }

        
        require __DIR__ . '/conexion.php';
    
        $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
        $resultConsulta = $conexion->query($consulta);
        
        $row = mysqli_fetch_assoc($resultConsulta);
        
        $rolAccount = $row['account_rol_aid'];
        
        if($rolAccount == 1){
            $search = $_GET ? '?search='.$_GET['search'] : '';
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/index.php/dashboard/');</script>";
            return '';
        } elseif($rolAccount == 2){
            $search = $_GET ? '?search='.$_GET['search'] : '';
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/index.php/distribuidor/dashboard');</script>"; 
            return '';
        } elseif($rolAccount == 3){
            $search = $_GET ? '?search='.$_GET['search'] : '';
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/index.php/manufacturer/dashboard');</script>"; 
            return '';
        } elseif($rolAccount == 4){
            $search = $_GET ? '?search='.$_GET['search'] : '';
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/index.php/support/dashboard');</script>"; 
            return '';
        } elseif($rolAccount == 5){
            $search = $_GET ? '?search='.$_GET['search'] : '';
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/index.php/rentalsale/dashboard');</script>"; 
            return '';
        } else {
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder/');</script>"; 
            return '';
        }
    }*/

    //ACCOUNT REDIRECT NUEVO CON SWTICH CASE 06/11/2023

    function account_redirect()
    {
        require __DIR__ . '/conexion.php';

        // if (isset($_GET['pay'])) {
        //     $idCotizacion = $_GET['idCotizacion'];
        //     $idCotizacionDecrypted = base64_decode($idCotizacion);
        //     $pay = $_GET['pay'];
        //     $payDecrypted = base64_decode($pay);
        //     $email = $_SESSION['emailAccount'];

        //     $updateCotizacion = $conexion->prepare("UPDATE wp_cotizacion SET cotizacion_status = ? WHERE cotizacion_id = ? AND cotizacion_id_user = ?");

        //     $status = 3;
        //     $statusN = 2;

        //     if ($payDecrypted === 'success'){                        
        //         $updateCotizacion->bind_param('sis', $status, $idCotizacionDecrypted, $email);
        //     }else{
        //         $updateCotizacion->bind_param('sis', $statusN, $idCotizacionDecrypted, $email);
        //     }

        //     // Ejecutar la sentencia preparada
        //     if ($updateCotizacion->execute()) {
        //         echo "Cotización actualizada correctamente.";
        //     } else {
        //         echo "Error al actualizar la cotización: " . $conexion->error;
        //     }

        //     // Cerrar la sentencia preparada
        //     $updateCotizacion->close();
        // }
        if (isset($_SESSION["emailAccount"])) {
            $email = $_SESSION["emailAccount"];
        } else {
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/');</script>";
            return '';
        }

        if (isset($_SESSION["consulta1"])) {
            $pass = $_SESSION["consulta1"];
        }

        require_once __DIR__ . '/../db/conexion.php';

        $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
        $resultConsulta = $conexion->query($consulta);

        if (!$resultConsulta || $resultConsulta->num_rows == 0) {
            echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder/');</script>";
            return '';
        }

        //$scientistMail = isset($_SESSION["emailAccount"]) ? urlencode($_SESSION["emailAccount"]) : 'mailFail';
        $pass = isset($_SESSION['consulta1']) ? ($_SESSION['consulta1']) : 'passFail';

        $row = mysqli_fetch_assoc($resultConsulta);
        $rolAccount = $row['account_rol_aid'];

        $search = isset($_GET['search']) ? urlencode($_GET['search']) : '';
        $searchQuery = $search ? '?search=' . $search : '';
        /*$scientist = isset($_GET['accountUser']) ? urldecode($_GET['accountUser']) : '';
        $scientistQuery = $scientist ? '&accountUser='.$scientist : '';*/




        $baseURL = 'https://dev.kalstein.plus/plataforma/index.php/';
        $scientistURL = 'https://biblioteca.kalstein.net/';

        switch ($rolAccount) {
            case 1:
                $redirectUrl = $search ? $baseURL . "dashboard/$searchQuery" : $baseURL . "dashboard/";
                break;
            case 2:
                $redirectUrl = $search ? $baseURL . "distribuidor/tienda/$searchQuery" : $baseURL . "distribuidor/dashboard/";
                break;
            case 3:
                $redirectUrl = $search ? $baseURL . "fabricante/tienda/$searchQuery" : $baseURL . "manufacturer/dashboard/";
                break;
            case 4:
                $redirectUrl = $baseURL . "support/dashboard/";
                break;
                /*case 5: 
                $redirectUrl = $baseURL . "rentalsale/dashboard/";
                break;*/
            case 6:
                /* sleep(15); */
                $redirectUrl = $scientistURL . "setSession.php";
                break;
            default:
                echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder/');</script>";
                return '';
        }

        echo "<script>window.location.replace('$redirectUrl');</script>";
        return '';
    }

    //FIN DE ACCOUNT REDIRECT 

    // FUNCIONES DE PAGO 

    function paymentGateway()
    {
        return render_php_file("accounts/payment.php");
    }

    function error404()
    {
        return render_php_file("client/404_plataforma/404.php");
    }

    function success_page()
    {
        return render_php_file("client/success_plataforma/pago_aprobado.php");
    }


    // XXX Client XXX

    function dashboard()
    {
        verify_session(1);
        return render_php_file("client/dashboard.php");
    }

    // XXX Customize Template to Quotes XXX

    function customize_template()
    {
        return render_php_file("customize-template/customizeTemplateQuote.php");
    }

    // XXX Fabricante XXX

    function manufacturer_dashboard()
    {
        verify_session(3);
        return render_php_file("manufacturer/dashboard.php");
    }

    function manufacturer_stock()
    {
        verify_session(3);
        return render_php_file("manufacturer/stock.php");
    }

    function manufacturer_stock_preview()
    {
        verify_session(3);
        return render_php_file("manufacturer/stock_preview.php");
    }

    function manufacturer_stock_add()
    {
        verify_session(3);
        return render_php_file("manufacturer/stock_add.php");
    }

    function manufacturer_stock_edit()
    {
        verify_session(3);
        return render_php_file("manufacturer/stock_edit.php");
    }

    function manufacturer_list_order()
    {
        verify_session(3);
        return render_php_file("manufacturer/list_order.php");
    }

    function manufacturer_list_order_processed()
    {
        verify_session(3);
        return render_php_file("manufacturer/list_order_processed.php");
    }

    function manufacturer_list_order_cancelled()
    {
        verify_session(3);
        return render_php_file("manufacturer/list_order_cancelled.php");
    }

    function manufacturer_sales_report()
    {
        verify_session(3);
        return render_php_file("manufacturer/sales_report.php");
    }

    function manufacturer_shipping_costs()
    {
        verify_session(3);
        return render_php_file("manufacturer/shipping_costs.php");
    }

    function inbox_manufacturer()
    {
        verify_session(3);
        return render_php_file("manufacturer/inbox.php");
    }

    function manufacturer_edit_profile()
    {
        verify_session(3);
        return render_php_file("manufacturer/edit_profile.php");
    }

    function manufacturer_catalogs()
    {
        verify_session(3);
        return render_php_file("manufacturer/catalogs.php");
    }

    function manufacturer_pursaching()
    {
        verify_session(3);
        return render_php_file("manufacturer/pursaching.php");
    }

    function manufacturer_subscripcion()
    {
        verify_session(3);
        return render_php_file("manufacturer/subscripcion.php");
    }

    // XXX DISTRIBUTOR XXX

    function dashboard_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/dashboard.php");
    }

    function stock_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/stock.php");
    }

    function stock_add_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/stock_add.php");
    }

    function stock_edit_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/stock_edit.php");
    }

    function stock_shipping_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/shipping_costs.php");
    }

    function list_order_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/listOrder.php");
    }

    function list_order_processed_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/listOrderProcessed.php");
    }

    function list_order_cancelled_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/listOrderCancelled.php");
    }

    function sales_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/salesReport.php");
    }
    function inbox_distributor()
    {
        verify_session(2);
        return render_php_file("distributor/inboxDistributor.php");
    }

    function inbox_distributor_sent()
    {
        verify_session(2);
        return render_php_file("distributor/sentMails.php");
    }
    function inbox_distributor_view()
    {
        verify_session(2);
        return render_php_file("distributor/viewEmail.php");
    }
    function inbox_distributor_view_sent()
    {
        verify_session(2);
        return render_php_file("distributor/sentMailsView.php");
    }
    function distributor_edit_profile()
    {
        verify_session(2);
        return render_php_file("distributor/edit_profile.php");
    }
    function stock_distributor_preview()
    {
        verify_session(2);
        return render_php_file("distributor/stock_preview.php");
    }
    function inbox_distributor_compose()
    {
        verify_session(2);
        return render_php_file("distributor/composeEmail.php");
    }

    function distributor_catalogs()
    {
        verify_session(2);
        return render_php_file("distributor/catalogs.php");
    }

    function distributor_pursaching()
    {
        verify_session(2);
        return render_php_file("distributor/pursaching.php");
    }

    function distributor_subscripcion()
    {
        verify_session(2);
        return render_php_file("distributor/subscripcion.php");
    }

    /* SOPORTE OLX*/
    function dashboard_suport()
    {
        verify_session(4);
        return render_php_file('suport/dashboard.php');
    }


    function reports_suport()
    {
        verify_session(4);
        return render_php_file('suport/report.php');
    }


    function reports_add_suport()
    {
        verify_session(4);
        return render_php_file('suport/report_add.php');
    }


    function reports_mod_suport()
    {
        verify_session(4);
        return render_php_file('suport/reports_mod.php');
    }

    function service_suport()
    {
        verify_session(4);
        return render_php_file('suport/service.php');
    }
    function serviceadd_suport()
    {
        verify_session(4);
        return render_php_file('suport/serviceadd.php');
    }

    function servicemod_suport()
    {
        verify_session(4);
        return render_php_file('suport/servicemod.php');
    }

    function Quotes_suport()
    {
        verify_session(4);
        return render_php_file('suport/Suport_Quotes.php');
    }
    function quotescanceled_suport()
    {
        verify_session(4);
        return render_php_file('suport/listOrderCancelled.php');
    }

    function quotesprocessed_suport()
    {
        verify_session(4);
        return render_php_file('suport/listOrderProcessed.php');
    }

    function inbox_suport()
    {
        verify_session(4);
        return render_php_file('suport/inboxSuport.php');
    }

    function mailsSuportsent_suport()
    {
        verify_session(4);
        return render_php_file('suport/sentMails.php');
    }
    function mailsSuportsentview()
    {
        verify_session(4);
        return render_php_file('suport/sentMailsView.php');
    }

    function EmailSuportview()
    {
        verify_session(4);
        return render_php_file('suport/viewEmail.php');
    }

    function emailcompose_suport()
    {
        verify_session(4);
        return render_php_file('suport/composeEmail.php');
    }

    function stock_suport()
    {
        verify_session(4);
        return render_php_file('suport/stock_suport.php');
    }

    function catalogo()
    {
        verify_session(4);
        return render_php_file('suport/catalogo.php');
    }

    function support_edit_profile()
    {
        verify_session(4);
        return render_php_file('suport/edit_profile.php');
    }

    function support_pursaching()
    {
        verify_session(4);
        return render_php_file("suport/pursaching.php");
    }


    //XX RENTAL AND USED EQUIPMENT
    function rentalsale_dashboard()
    {
        verify_session(5);
        return render_php_file('rentalsale/dashboard.php');
    }

    function rentalsale_stock()
    {
        verify_session(5);
        return render_php_file('rentalsale/stock.php');
    }

    function rentalsale_stock_add()
    {
        verify_session(5);
        return render_php_file('rentalsale/stock_add.php');
    }

    function rentalsale_stock_used()
    {
        verify_session(5);
        return render_php_file('rentalsale/stock_used.php');
    }

    function rentalsale_stock_edit()
    {
        verify_session(5);
        return render_php_file('rentalsale/stock_edit.php');
    }

    function rentalsale_order()
    {
        verify_session(5);
        return render_php_file('rentalsale/listOrder.php');
    }

    function rentalsale_order_proccesed()
    {
        verify_session(5);
        return render_php_file('rentalsale/listOrderProcessed.php');
    }

    function rentalsale_order_cancelled()
    {
        verify_session(5);
        return render_php_file('rentalsale/listOrderCancelled.php');
    }

    function rentalsale_customers()
    {
        verify_session(5);
        return render_php_file('rentalsale/rentalConstumers.php');
    }

    function rentalsale_sales()
    {
        verify_session(5);
        return render_php_file('rentalsale/salesReport.php');
    }

    function rentalsale_inbox()
    {
        verify_session(5);
        return render_php_file('rentalsale/inbox.php');
    }

    function rentalsale_edit_profile()
    {
        verify_session(5);
        return render_php_file('rentalsale/edit_profile.php');
    }


    // MODERADOR

    function moderator_dashboard()
    {
        return render_php_file('moderator/dashboard.php');
    }
    function moderator_product()
    {
        return render_php_file('moderator/product.php');
    }
    function moderator_blog(){
        return render_php_file('moderator/blog.php');
    }
    function moderator_view_blog(){
        return render_php_file('moderator/view_verify_blog.php');
    }
    function moderator_barbacoas(){
        return render_php_file('moderator/barbacoas.php');
    }        
    function moderator_view_barbacoas(){
        return render_php_file('moderator/view_verify_guide.php');
    }
    function moderator_quotes()
    {
        return render_php_file('moderator/quotes.php');
    }
    function moderator_shipping()
    {
        return render_php_file('moderator/shipping.php');
    }
    function moderator_bitacora()
    {
        return render_php_file('moderator/binnacle.php');
    }
    function moderator_view_product()
    {
        return render_php_file('moderator/view_verify_product.php');
    }
    function moderator_view_account()
    {
        return render_php_file('moderator/view_verify_account.php');
    }
    function data_recover()
    {
        return render_php_file('retrieve-description.php');
    }
    function moderator_cotizaciones()
    {
        return render_php_file('moderator/cotizaciones-verify.php');
    }
    function moderator_render()
    {
        return render_php_file('moderator/render.php');
    }

    // diego 404
    /*function diego_shortcode(){
        return render_php_file('diego-index.php');
    }*/
}
