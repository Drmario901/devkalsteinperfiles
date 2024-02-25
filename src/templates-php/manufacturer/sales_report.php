<div class="container">
    <header class="header" data-header>
        <?php

            include 'navbar.php';
        
        ?>
        <script>
            let page = "sales-report";

            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <?php
        $banner_img = 'Header-fabricante-IMG.png';
        $banner_text = "Reportes de ventas";
        include 'banner.php';
    ?>

    <article class="container article">

        <!-- 
        - #HOME
        -->

        <section class="home">

            <div class="card profile-card">
                <div class="profile-card-wrapper">
                    <h2 class="h2 article-title">Productos más vendidos (últimos seis meses)</h2>
                    <canvas id="sales2"></canvas>
                </div>
            </div>

            <div class="card task-card">
                <h2 id="last-month-h2" class="h2 article-title">Último mes <span class="d-inline">(--)</span></h2>

                <div class="card-icon icon-box green">
                    <span class="material-symbols-rounded  icon">attach_money</span>
                </div>

                <div>
                    <center><data class="card-data" value="">Ingresos totales</data></center>
                    <center><p id="income" class="card-text"> -- </p></center>
                </div>

                <ul>

                    <li id="graph-1-month" class="revenue-item icon-box">
                        <span class="material-symbols-rounded  icon  green">trending_up</span>
                        <center>
                            <data class="revenue-item-data" >--</data>
                        </center>
                    </li>

                </ul>

                <div class="card task-card">

                    <div class="card-icon icon-box blue">
                    <span class="material-symbols-rounded  icon">sell</span>
                    </div>

                    <div>
                    <center><data id="products-sold" class="card-data">--</data></center>

                    <center><p class="card-text">Productos vendidos</p></center>
                    </div>

                </div>
            </div>

            <div class="card revenue-card">

                <h2 class="h2 article-title">Visualización de ingresos</h2>

                <canvas id="sales"></canvas>
                <div class="card task-card">
                    <div class="card-icon icon-box green">
                        <span class="material-symbols-rounded  icon">group</span>
                    </div>

                    <div>
                        <center><data class="card-data" value="">Total clientes</data></center>
                        <center><p id="total-costumers" class="card-text">--</p></center>
                    </div>
                </div>
            </div>
            <p id="will-restart" class="article-subtitle"></p>
        </section>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>
