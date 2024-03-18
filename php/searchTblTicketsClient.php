<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    $perPage = 10;
    $page = isset($_GET['e']) ? intval($_GET['e']) : 1;

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    require '../db/conexion.php';

    $consulta = "SELECT * FROM wp_reportes WHERE R_usuario = '$email' ORDER BY R_id DESC LIMIT $offset, $limit";
    $resultado = $conexion->query($consulta);

    include 'translateText.php';
    include 'translations.php';
    translateText();
    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

    $i = 0;

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td scope='col' data-i17n='client:itemTabla'>Item</td>
                    <td scope='col' data-i17n='client:fechaTable'>Fecha</td>
                    <td scope='col' data-i17n='client:service'>Servicio</td>
                    <td scope='col' data-i17n='client:model'>Modelo</td>
                    <td scope='col' data-i17n='client:agent'>Agente</td>
                    <td scope='col' data-i17n='client:statusTable'>Status</td>
                    <td scope='col' data-i17n='client:actions'>Acciones</td>
                </tr>
            </thead>
            <tbody id='tblTickets' class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 01;
            $id = $value['R_id'];
            $idServicio = $value['R_id_servicio'];
            $date = $value["R_fecha"];            
            $date = new DateTime($date);
            $fecha = date_format($date, 'Y-m-d');
            $description = $value['R_Description'];
            $categorie = $value['R_category'];
            $status = $value['R_estado'];
            $model = $value['R_product'];
            $emailAgent = $value['R_usuario_agente'];
            $consulta2 = "SELECT * FROM wp_account WHERE account_correo = '$emailAgent'";
            $resultado2 = $conexion->query($consulta2);
            $row2 = mysqli_fetch_array($resultado2);
            $nameAgent = $row2['account_nombre'];
            $lastnameAgent = $row2['account_apellido'];
            $completeNameAgent = $nameAgent.' '.$lastnameAgent;

            $consulta3 = "SELECT * FROM wp_servicios WHERE SE_id = '$idServicio'";
            $resultado3 = $conexion->query($consulta3);
            $row3 = mysqli_fetch_array($resultado3);
            $nameService = $row3['SE_servicio'];
            $statusTranslated;

            if ($i < 10){
                $i = '000'.$i;
            }else{
                if ($i < 100){
                    $i = '00'.$i;
                }else{
                    if ($i < 1000){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                }
            }

            if ($status == 'Pendiente'){
                $bgStatus = '#e38512';
                $statusTranslated = $translations[$lang]['pendiente'];
            }else{
                if ($status == 'Procesado'){
                    $bgStatus = '#0eab13';
                    $statusTranslated = $translations[$lang]['processed'];
                }else{
                    $bgStatus = '#e61212';
                    $statusTranslated = $translations[$lang]['cancelado'];
                }                
            }

            $html.= "                                    
                <tr>
                    <td class='fw-bold'>$i</td>
                    <td style='max-width: 4rem;'>$fecha</td>
                    <td style='max-width: 15rem;'>$nameService</td>
                    <td style='max-width: 4rem;'>$model</td>
                    <td>$completeNameAgent</td>
                    <td style='background-color: $bgStatus;'><button style='width: 100%; height: 100%; background-color: $bgStatus; color: #fff; text-align: center; font-weight: bold;' id='btn_ChangeStatus' value='$id'>$statusTranslated</button></td>
                    <td><Button value='$id' id='btnViewReportEdit' style='margin: 0 auto; color: black;' data-bs-toggle='modal' data-bs-target='#exampleModalEdit'><i class='fa fa-pencil'></i></Button><Button value='$id' id='btnViewReport' style='margin: 0 auto; color: green;' data-bs-toggle='modal' data-bs-target='#modelViewReport'><i class='fa-solid fa-up-right-from-square'></i></Button><Button value='$id' id='btnDeleteReport' style='margin: 0 auto; color: red;'><i class='fa-solid fa-trash'></i></Button></td>                    
                </tr>
            ";
		}

        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                <p data-i17n='client:dataNotFound'>Datos no encontrados</p>
            </div>
        ";
    }

    $html.= "
            </tbody>
        </table>
        $msjNoData
    ";

    $prevPage = max(1, $page - 1);
    $nextPage = $page + 1;

    $html .= "
        </table>
        <div class='pagination'>
            <div id='currentPageIndicatorTickets'>Page: $page</div>
            <form id='form-previous-tickets' action='' method='get' style='margin-right: 8px'>
                <input id='previous' type='hidden' name='e' value='$prevPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' data-i17n='client:previo' value=''>
            </form>
            <form id='form-next-tickets' action='' method='get'>
                <input id='next' class='next' type='hidden' name='e' value='$nextPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' data-i17n='client:next' value=''>
            </form>
        </div>
        <input id='hiddenPage' type='hidden' value='$page'>
    ";



    echo $html;
    $conexion->close();

    
    ?>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i17n='client:editarSolicitud'>Editar la Solicitud</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formModReportes">
            <input type="hidden" name="idModReporte" id="idModReporte" >
      <input type="text" id="otherModelEdit" style="display: block; margin-top: 1rem;" placeholder="Modelo de Equipo" name="otherModelEdit" data-placeholder='client:model'>
      <textarea id="RDescriptionEdit" class="form-control validate" required="" name="RDescriptionEdit"></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i17n='client:cerrar' >Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarReporteMod" data-i17n='client:guardarCambio'>Guardar Cambio</button>
      </div>
    </div>
  </div>
</div>

<script>
    jQuery(document).ready(function($){
        $(document).on('click', '#btnViewReportEdit', function(){
            
            let valorBoton = $(this).attr('value')
            $.ajax({
                url: 'https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/showReportEdit.php',
                method: 'POST',
                data: { valorBoton },
                success: function (respuesta) {
                    $("#otherModelEdit").val(respuesta.model)
                    $("#RDescriptionEdit").val(respuesta.description)
                    $("#idModReporte").val(respuesta.R_id)
                    

            /* alert('Status cambiado a Cancelado...'); */
            // Aquí puedes agregar el código necesario para realizar la acción de cambiar el status
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al cambiar el status: ' + errorThrown);
          },

            })
            /* .done(function(respuesta){ */

                /* $('#modalBody').html('') */
            /* }) */

        })
    })

    jQuery(document).ready(function($){
        $(document).on('click', '#guardarReporteMod', function(){
            let form = $("#formModReportes").serialize()
            $.ajax({
                url: 'https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/modReporte.php',
                method: 'POST',
                data: form
            })
            .done(function(respuestaMod){
                console.log("actualización realizada con exito!!!")
                iziToast.show({
                    title: 'Éxito',
                    message: 'Operación realizada con éxito',
                    color: 'green',
                    position: 'topRight'
                });
                $("#formModReportes")[0].reset()
                    $("#exampleModalEdit").modal('hide')
                    /* window.location.href = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/modReporte.php" */
                    location.reload();


            })
        })

    })
    
</script>



