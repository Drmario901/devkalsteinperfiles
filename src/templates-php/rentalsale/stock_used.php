<header class="header" data-header>
    <?php
        include 'navbar.php';
    ?>
    <script>
        let page = "stock";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<br>
<br>
<nav class="nav nav-borders">
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock">Products stock</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock/add"> Add rental service</a>
    <a class="nav-link active" href="https://testing.kalstein.digital/index.php/rentalsale/stock/add/used">Add used product</a>
</nav>

<hr class="mt-0 mb-4">

<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row tm-edit-product-row">
                    <?php
                        $add = true;
                        include __DIR__.'/productFormRental.php';
                    ?>
                    <div class="col-12">
                        <center><button style="color: white !important;"type="button" id="btnSendData" name="send" class="btn btn-primary btn-block text-uppercase">Add Product Now</button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>