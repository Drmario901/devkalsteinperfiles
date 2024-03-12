<div class="container">

    <?php

    

        include 'navdar.php';

        require __DIR__."/../../../php/conexion.php";



       /*  $sql = "SELECT DISTINCT categorie_line FROM wp_categories";

        $res = $conexion->query($sql); */

        

        /* while($result = $res->fetch_array()){ */

            /* echo $result["categorie_line"]; */

       /*  } */

        

    ?>

    <script>

        let page = "services";

    

        document.querySelector('#' + page).classList.add("active");

        document.querySelector('#' + page).removeAttribute("style");

    </script>

    

    <article class="container article">

    

        <?php

            $banner_img = 'Header-servicio-tecnico-IMG.jpg';

            $banner_text = "Mes services";

            include __DIR__.'/../manufacturer/banner.php';

        ?>

    

        <nav class="nav nav-borders">

            <a class="nav-link active ms-0" href="https://dev.kalstein.plus/plataforma/index.php/support/services/">Services</a>

            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/add">Ajouter un service</a>

            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/edit">Modifier le service</a>

            <hr class="mt-0 mb-4">

        </nav>

        <br>

        <div class="category-select d-flex mb-3">

            <i class="fa-solid fa-search h5 me-2 mt-2"></i>

            <select class="form-control mb-2" type="date" id="category">

                <option value="0">Sélectionner une catégorie</option>

            </select>

        </div>

        <div class="category-select d-flex mb-3">

            <i class="fa-solid fa-play h5 me-2 mt-2"></i>

            <select class="form-control" id="estatus">

                <option value='0' selected>Sélectionner un statut</option>

                <option value="activé">Activé</option>

                <option value="désactivé">Handicapés</option>

            </select>

        </div>

        <div id="report-fails" class="table-responsive" width="100">

            <table class='table custom-table' width='auto'>

                <thead class='headTableForQuote'>

                    <tr>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Nombre</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Service</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Catégorie</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Entreprise</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>agent d'assistance</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Courriel</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Description</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Date</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Statut</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;'>Editer</td>

                    </tr>

                </thead>

                <tbody id='tblListService' class='bodyTableForQuote'>

                </tbody>

                <tfoot style='margin: 0 auto;'>

                    <tr>

                        <td colspan='12' class='text-center'>

                            <div class='btn-group'>

                                <button class='btn btn-outline-primary prev' Handicapés style='outline: 1px solid #213280 !important; border: 1px solid #213280;'>

                                    <i class='fas fa-chevron-left'></i>

                                </button>

                                <button class='btn btn-outline-primary pagina' style='outline: 1px solid #213280 !important; border: 1px solid #213280;'>1</button>

                                <button class='btn btn-outline-primary sig' style='outline: 1px solid #213280 !important; border: 1px solid #213280;'>

                                    <i class='fas fa-chevron-right'></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>        

        <style>

            #category {

                padding: 12px 20px;

                display: inline-block;

                border: 1px solid #ccc;

                border-radius: 4px;

                box-sizing: border-box;

            }

            

            #estatus {

                width: 200px;

                padding: 12px 20px;

                display: inline-block;

                border: 1px solid #ccc;

                border-radius: 4px;

                box-sizing: border-box; 

            }

            

            #catalogo {

                display: grid;

                grid-gap: 20px;

                place-items: center;

            }

            

            .g-4, .gy-4 {

                --bs-gutter-y: 2rem;

                --bs-gutter-x: -4.5rem;

            }



            .btn-outline-primary{

                color: #000 !important;

            }



            .btn-outline-primary:hover{

                background-color: #213280 !important;

                color: #fff !important;

            }

        </style>

    </article>



    <?php

        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';

        include 'footer.php';

    ?>

</div>    

<script></script>