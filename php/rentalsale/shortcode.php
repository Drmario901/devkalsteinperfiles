<?php
    session_start();

    function render_php_file($path){
        ob_start();
        include(__DIR__.'/../src/templates-php/'.$path);
        $var=ob_get_contents(); 
        ob_end_clean();
        return $var;
    }

    class shortcodePerfiles{
        function dashboard(){
            return render_php_file("distributor/dashboard.php");
        }

        function stock(){
            return render_php_file("manufacturer/stock.php");
        }

        function stock_add(){
            return render_php_file("manufacturer/stock_add.php");
        }

        function stock_edit(){
            return render_php_file("manufacturer/stock_edit.php");
        }

        function list_order(){
            return render_php_file("manufacturer/list_order.php");
        }

        function list_order_processed(){
            return render_php_file("manufacturer/list_order_processed.php");
        }

        function list_order_cancelled(){
            return render_php_file("manufacturer/list_order_cancelled.php");
        }

        //DISTRIBUTOR PROFILE

        function dashboard_distributor(){
            return render_php_file("distributor/dashboard.php");
        }

        function stock_distributor(){
            return render_php_file("distributor/stock.php");
        }

        function stock_add_distributor(){
            return render_php_file("distributor/stock_add.php");
        }

        function stock_edit_distributor(){
            return render_php_file("distributor/stock_edit.php");
        }

        function stock_shipping_distributor(){
            return render_php_file("distributor/shipping_costs.php");
        }

        function list_order_distributor(){
            return render_php_file("distributor/listOrder.php");
        }

        function list_order_processed_distributor(){
            return render_php_file("distributor/listOrderProcessed.php");
        }

        function list_order_cancelled_distributor(){
            return render_php_file("distributor/listOrderCancelled.php");
        }
        
        function sales_distributor(){
            return render_php_file("distributor/salesReport.php");
        }
        function inbox_distributor(){
            return render_php_file("distributor/inboxDistributor.php");
        }

        function inbox_distributor_sent(){
            return render_php_file("distributor/sentMails.php");
        }
        function inbox_distributor_view(){
            return render_php_file("distributor/viewEmail.php");
        }
        function inbox_distributor_view_sent(){
            return render_php_file("distributor/sentMailsView.php");
        }
        function inbox_distributor_compose(){
            return render_php_file("distributor/composeEmail.php");
        }
    }
?>