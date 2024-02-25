<header class="header" data-header>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <?php
        include 'navbar.php';
    ?>
    <script>
        let page = "sales";
        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<br>
<br>
<nav class="nav nav-borders">
    <a class="nav-link active ms-0" target="__blank" style="color: #31363a !important">Sales Analytics</a>
</nav>
<br>
<article class="container article">

      <!-- 
        - #HOME
      -->

      <section class="home">

        <div class="card profile-card">


          
          </ul>

          <div class="profile-card-wrapper">
        <h2 class="h2 article-title">Sales Statistics</h2>
        <canvas id="products">
        </canvas>
       

          </div>

        </div>

        <div class="card task-card">
          <br>
          <br>
          <br>
          <br>

            
            <div class="card task-card">

                <div class="card-icon icon-box blue">
                <span class="material-symbols-rounded  icon">sell</span>
                </div>

                <div>
                <center><data id="processed-orders" class="card-data"> -- </data></center>

                <center><p id="product-selled" class="card-text">Products selled</p></center>
                </div>

            </div>
        </div>
        <div class="card revenue-card">

      

          </ul>

          <p class="card-title">Month sales</p>

          <canvas id="sales">
         </canvas>
         <br>

         <p class="card-title">Customers</p>

         <canvas id="activity"></canvas>

         
          


        
          


        </div>
          </div>
        </div>

      </section>


