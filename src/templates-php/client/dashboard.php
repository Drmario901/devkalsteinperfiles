<?php 
 session_start();
    require __DIR__. '/../../../php/conexion.php';
    require __DIR__. '/../../../php/clientStuff.php';
?>
<div class='container' style='background-color: #fff; scroll-behavior: smooth;'>

    <?php echo $_COOKIE['en']; ?>
    
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
                $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

                // Incluir el archivo de traducciones
                require __DIR__. '/../../../php/translations.php';

                $banner_text_key = 'banner_text_parameters'; // Clave para el texto de los catálogos (por defecto)
                if (isset($translations[$language]['banner_text_parameters'])) {
                    $banner_text_key = 'banner_text_parameters';
                }

                // Determinar el texto del banner según el idioma
                $banner_text = isset($translations[$language][$banner_text_key]) ? $translations[$language][$banner_text_key] : 'Parameters';
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
                $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

                // Incluir el archivo de traducciones
                include 'translations.php';

                // Determinar el texto del banner según el idioma
                $banner_text_translation = isset($translations[$language]['banner_text_connect_with_others']) ? $translations[$language]['banner_text_connect_with_others'] : $translations['en']['banner_text_connect_with_others'];

                // Incluir el banner.php pasando el texto traducido
                $banner_text = $banner_text_translation;
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


