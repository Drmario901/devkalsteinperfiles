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
<br>
<br>
<br>

<nav class="nav nav-borders">
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/distributor/stock">Products stock</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/distributor/stock/add"> Add product</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/distributor/stock/edit">Edit product</a>
    <a class="nav-link active" href="https://testing.kalstein.digital/index.php/distributor/stock/shipping">Shipping Costs</a>
</nav>

<?php
    include __DIR__.'/calculator.php';
?>
