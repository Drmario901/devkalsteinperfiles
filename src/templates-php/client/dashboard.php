<?php 
 session_start();
    require __DIR__. '/../../../php/conexion.php';
    require __DIR__. '/../../../php/clientStuff.php';
?>
<div class='container' style='background-color: #fff; scroll-behavior: smooth;'>

    <?php
        //NAVBAR
        include 'navbar.php';
    ?>
    
    <article class='container article'>
        
        <?php
            $search = $_GET? $_GET['search'] : '';
        ?>
        <input type="hidden" id="search-product" value="<?php echo $search ?>">

        <?php
            //DASHBOARD HOME 
            include 'home.php';
        ?>

        <?php 
            //SUPPORT SERVICES
            include 'services.php';
        ?>

        <?php 
            //CONSULT SHIPPING COST
            include 'consultShippingPricesEU.php';
        ?>

        <?php 
            //MY QUOTES 
            include 'quotes.php';
        ?>

        <?php 
            //ACTIVITY 
            include 'activity.php';
        ?>

        <div id='c-panel04' style='display: none'>
            <?php
                $banner_img = 'Header-usuario-IMG.png';
                $banner_text = "Parámetros";
                include 'banner.php';

                //PROFILE SETTINGS
                include 'settings.php';
            ?>
        </div>

        <?php 
            //GENERATE A QUOTE BUTTON 
            include 'generateQuote.php';
        ?>

        <div id='c-panel07' style='display: none'>
            <?php
                $banner_img = 'Header-usuario-IMG.png';
                $banner_text = "Conectar con otros usuarios";
                include 'banner.php';

                //INBOX 
                include 'inbox.php';
            ?>
        </div>

        <?php 
            //CATALOGS
            include 'catalogs.php';
        ?>

        <?php 
            //DIAGNOSIS APP 
            //require __DIR__. '/diagnosis/index.php';
            echo '<br>';
            echo '<br>';
            include  'diagnosis.php';
            ?>
            

    </article>

    <!-- #FOOTER -->      
    <?php
        $footer_img = 'Footer-usuario-IMG.png';
        include 'footer.php';
    ?>

</div>

<?php
session_start();

$test = isset($_SESSION['user_tag']) ? $_SESSION['user_tag'] : ''; 

?>

<script>
    var user_tag = '<?php echo $test; ?>';
    console.log(user_tag);
</script>


