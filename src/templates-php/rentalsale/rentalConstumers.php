<header class="header" data-header>
    <?php
    include 'navbar.php';

    ?>
    <script>
        let page = "customers";
        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<?php
require __DIR__ . '/../../../php/conexion.php';

$query = "SELECT 
                wp_account.account_nombre, 
                wp_account.account_apellido, 
                wp_account.account_correo, 
                wp_paises.en AS nombre_pais, 
                wp_account.account_url_image_perfil, 
                wp_cotizacion.rental_status
            FROM wp_account
            INNER JOIN wp_cotizacion ON wp_account.account_correo = wp_cotizacion.cotizacion_id_user
            INNER JOIN wp_paises ON wp_account.account_pais = wp_paises.iso 
            WHERE wp_cotizacion.rental_status IN ('activated', 'disable')";

$result = mysqli_query($conexion, $query);


$itemsPerPage = 4;
$totalItems = mysqli_num_rows($result);

$page = isset($_GET['i']) ? (int) $_GET['i'] : 1;
$page = max(1, min($page, ceil($totalItems / $itemsPerPage)));

$offset = ($page - 1) * $itemsPerPage;
$query .= " LIMIT $offset, $itemsPerPage";

$result = mysqli_query($conexion, $query);
?>
<style>
    body {
        margin-top: 20px;
    }

    .container {
        margin-bottom: 20px;
    }

    .main-box {
        border: 1px solid #ddd;
        padding: 20px;
    }

    .table {
        border-collapse: separate;
    }

    .table th,
    .table td {
        font-size: 0.875em;
        background: #f5f5f5;
        vertical-align: middle;
        padding: 12px 8px;
    }

    .table th {
        border-bottom: 1px solid #C2C2C2;
        padding-bottom: 0;
    }

    .table th span {
        border-bottom: 2px solid #C2C2C2;
        display: inline-block;
        padding: 0 5px;
        padding-bottom: 5px;
        font-weight: normal;
    }

    .table th a span {
        color: #344644;
    }

    .table th a span:after {
        content: "\f0dc";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        margin-left: 5px;
        font-size: 0.75em;
    }

    .table th a.asc span:after {
        content: "\f0dd";
    }

    .table th a.desc span:after {
        content: "\f0de";
    }

    .table th a:hover span {
        text-decoration: none;
        color: #2bb6a3;
        border-color: #2bb6a3;
    }

    .table.table-hover tbody>tr>td {
        background-color: #eee;
    }

    .table tbody tr td .call-type {
        display: block;
        font-size: 0.75em;
        text-align: center;
    }

    .table tbody tr td .first-line {
        line-height: 1.5;
        font-weight: 400;
        font-size: 1.125em;
    }

    .table tbody tr td .first-line span {
        font-size: 0.875em;
        color: #969696;
        font-weight: 300;
    }

    .table tbody tr td .second-line {
        font-size: 0.875em;
        line-height: 1.2;
    }

    .table a.table-link {
        margin: 0 5px;
        font-size: 1.125em;
    }

    .table a.table-link:hover {
        text-decoration: none;
        color: #2aa493;
    }

    .table a.table-link.danger {
        color: #fe635f;
    }

    .table a.table-link.danger:hover {
        color: #dd504c;
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
        text-align: center;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
        margin-left: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
    }

    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover,
    .pagination>li>a:focus,
    .pagination>li>span:focus {
        color: #23527c;
        background-color: #eee;
        border-color: #ddd;
    }

    .pagination .active>a,
    .pagination .active>span,
    .pagination .active>a:hover,
    .pagination .active>span:hover,
    .pagination .active>a:focus,
    .pagination .active>span:focus {
        z-index: 2;
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
        cursor: default;
    }

    .pagination .disabled>span,
    .pagination .disabled>span:hover,
    .pagination .disabled>span:focus,
    .pagination .disabled>a,
    .pagination .disabled>a:hover,
    .pagination .disabled>a:focus {
        color: #777;
        background-color: #fff;
        border-color: #ddd;
        cursor: not-allowed;
    }

    .profile-image {
        max-width: 50px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <?php if ($totalItems > 0): ?>
                        <table class="table user-list">
                            <thead>
                                <tr>
                                    <th><span data-i18n="rentalsale:spanImage">Image</span></th>
                                    <th><span data-i18n="rentalsale:placeholderName">Name</span></th>
                                    <th><span data-i18n="rentalsale:spanCountry">Country</span></th>
                                    <th><span data-i18n="rentalsale:spanPrice">Price</span></th>
                                    <th><span data-i18n="rentalsale:spanRentalTime">Rental time</span></th>
                                    <th><span data-i18n="rentalsale:spanTimeLeft">Time left</span></th>
                                    <th><span data-i18n="rentalsale:spanServiceDetails">Service details</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $acc_img = $row['account_url_image_perfil'];

                                    if ($acc_img == '') {
                                        $urlImagePerfil = 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/' . $row['account_nombre'] . '/' . $row['account_nombre'] . '' . $row['account_apellido'] . '.png';
                                    } else {
                                        $urlImagePerfil = 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/upload/' . $acc_img;
                                    }

                                    echo "<tr>";
                                    echo "<td><center><img src='$urlImagePerfil' class='profile-image' alt='Profile Image'></center></td>";
                                    echo "<td>{$row['account_nombre']} {$row['account_apellido']}</td>";
                                    echo "<td>{$row['nombre_pais']}</td>";
                                    echo "<td>{$row['rental_price']}</td>";
                                    $rentalEndDate = strtotime('2023-10-11111111 23:59:59');
                                    $currentDate = time();
                                    $timeLeft = 'Expired';

                                    $remainingTimeInSeconds = $rentalEndDate - $currentDate;

                                    if ($remainingTimeInSeconds > 0) {
                                        $daysLeft = floor($remainingTimeInSeconds / (60 * 60 * 24));

                                        if ($daysLeft < 7) {
                                            $timeLeft = $daysLeft . ' day' . ($daysLeft > 1 ? 's' : '');
                                        } elseif ($daysLeft < 30) {
                                            $weeksLeft = ceil($daysLeft / 7);
                                            $timeLeft = $weeksLeft . ' week' . ($weeksLeft > 1 ? 's' : '');
                                        } else {
                                            $monthsLeft = ceil($daysLeft / 30);
                                            $timeLeft = $monthsLeft . ' month' . ($monthsLeft > 1 ? 's' : '');
                                        }
                                    }

                                    echo "<td>{$row['rental_type']}</td>";
                                    echo "<td>{$timeLeft}</td>";
                                    echo "<td><center><a href='https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/createPDF.php?idCotizacion=$quoteId' id='btnViewQuote' style='margin: 0 auto; color: green;'><i class='fa-solid fa-up-right-from-square'></i></a></center></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <center>
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= ceil($totalItems / $itemsPerPage); $i++): ?>
                                    <li <?php echo ($i === $page) ? 'class="active"' : ''; ?>>
                                        <a href="?i=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </center>
                    <?php else: ?>
                        <center><b>
                                <p data-i18n="rentalsale:NoServicesYet">No services yet.</p>
                            </b></center>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>