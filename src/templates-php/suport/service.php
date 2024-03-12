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
        document.addEventListener('DOMContentLoaded', function() {
            let currentPathname = window.location.pathname;
            const navLinks = [
                { id: 'link-services', path: '/plataforma/index.php/support/services/' },
                { id: 'link-addServices', path: '/plataforma/index.php/support/add' },
                { id: 'link-modifyService', path: '/plataforma/index.php/support/services/edit' }
            ];

            navLinks.forEach(linkInfo => {
                const linkElement = document.querySelector('#' + linkInfo.id);
                const isActive = currentPathname.includes(linkInfo.path); // Verificamos si el pathname actual incluye el path del enlace
                linkElement.classList.toggle("active", isActive); // Aplicamos o quitamos la clase 'active' según corresponda

                // Opcional: Remover el atributo style si el enlace está activo
                if (isActive) {
                    linkElement.removeAttribute("style");
                }
            });
        });
    </script>

    

    <article class="container article">

    

        <?php

        $banner_img = 'Header-servicio-tecnico-IMG.jpg';

        require __DIR__. '/../../../php/translateTextBanner.php';
        $banner = 'banner_text_services';
        $banner_text = translateTextBanner($banner);
        include __DIR__.'/../manufacturer/banner.php';

        ?>


    

        <nav class="nav nav-borders">

            <a class="nav-link active ms-0" id="link-services" href="https://dev.kalstein.plus/plataforma/index.php/support/services/" data-i18n='support:servicios'>Services</a>

            <a class="nav-link " id="link-addServices" href="https://dev.kalstein.plus/plataforma/index.php/support/services/add" data-i18n='support:addServices'>Ajouter un service</a>

            <a class="nav-link " id="link-modifyService" href="https://dev.kalstein.plus/plataforma/index.php/support/services/edit" data-i18n='support:modifyService'>Modifier le service</a>

            <hr class="mt-0 mb-4">

        </nav>

        <br>

        <div class="category-select d-flex mb-3">

            <i class="fa-solid fa-search h5 me-2 mt-2"></i>

            <select class="form-control mb-2" type="date" id="category">

                <option value="0" data-i18n='support:selectDefault'>Sélectionner une catégorie</option>

            </select>

        </div>

        <div class="category-select d-flex mb-3">

            <i class="fa-solid fa-play h5 me-2 mt-2"></i>

            <select class="form-control" id="estatus">

                <option value='0' selected data-i18n='support:seleccionarEstatus'>Sélectionner un statut</option>

                <option value="activé" data-i18n='support:activated'>Activé</option>

                <option value="désactivé" data-i18n='support:desactivated'>Handicapés</option>

            </select>

        </div>

        <div id="report-fails" class="table-responsive" width="100">

            <table class='table custom-table' width='auto'>

                <thead class='headTableForQuote'>

                    <tr>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:nombre'>Nombre</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:servicios'>Service</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:Category'>Catégorie</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:labelCompany'>Entreprise</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:agenteSoporte'>agent d'assistance</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:labelCorreo'>Courriel</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:description'>Description</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:date'>Date</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:servicios'>Statut</td>

                        <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n='support:editar'>Editer</td>

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