<?php
  require_once __DIR__ . '/../db/conexion.php';
  $id = $_POST['consulta'];
  $sql = "SELECT * FROM wp_reportes WHERE R_id = '$id'";
  $result = $conexion->query($sql);
  $row = mysqli_fetch_array($result);
  $idServices = $row['R_id_servicio'];
  $idQuote = $row['R_id_cotizacion'];
  $email = $row['R_usuario'];
  $description = $row['R_Description'];
  $categorie = $row['R_category'];
  $model = $row['R_product'];
  $level = $row['R_Nivel'];
  $status = $row['R_estado'];
  $observation = $row['R_observacion'];

  $sql2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";
  $result2 = $conexion->query($sql2);
  $row2 = mysqli_fetch_array($result2);
  $name = $row2['account_nombre'];
  $lastname = $row2['account_apellido'];
  $nameUser = $name.' '.$lastname;

  $sql3 = "SELECT * FROM wp_servicios WHERE SE_id = '$idServices'";
  $result3 = $conexion->query($sql3);
  $row3 = mysqli_fetch_array($result3);
  $nameService = $row3['SE_servicio'];

  if ($id < 10){
    $numberTicket = '0000'.$id;
  }else{
    if ($id < 100){
      $numberTicket = '000'.$id;
    }else{
      if ($id < 1000){
        $numberTicket = '00'.$id;
      }else{
        if ($id < 10000){
          $numberTicket = '0'.$id;
        }else{
          $numberTicket = $id;
        }
      }
    }
  }

  $html = "
    <span style='float: right;'><b>$numberTicket</b></span>
    <input type='hidden' id='idReport' value='$id'>
    <h5>$nameService</h5>
    <span><b>Cliente:</b> $nameUser.</span>
    <span><b>Modelo:</b> $model.</span>
    <span><b>Categoria:</b> $categorie.</span>
    <span><b>Descripción:</b> $description.</span>
    <span><b>Nivel de Demanda:</b> $level.</span>
    <span><b>Status:</b> $status.</span>
    <hr>  
  ";

 if ($status === 'Pendiente'){
    $html.="
    <span><b>Observación Técnica:</b></span>
    <textarea id='txtObservation'></textarea>
    <hr>
    <h6><center>Information for quotation</center></h6>
    <input type='hidden' id='ih-cant' value='1'>
    <div id='c-descriptionQuote'>
      <div class='row'>
        <div class='col-3'>   
        
        <select name ='precio' id='precio'>
          <option value='0'>Moneda</option>
          <option value='USD'>USD</option>
          <option value='EUR'>EUR</option>
          </select>
          <input type='hidden' name='precio_uno' id='precio_uno' value='' >
          <input type='number' id='cant-1' class='form-control' placeholder='Cantidad' aria-label='Username' style='margin-top: 0.6rem;'> 
        </div>
    
        <div class='col-6'>   
          <input type='number' id='zipCode-1' class='form-control' placeholder='zip-code' aria-label='Username'> 
          <input type='text' id='description-1' class='form-control' placeholder='Descripción' aria-label='Username'>
        </div>

        <div class='col-3'>        
          <input type='number' id='price-1' class='form-control' placeholder='Precio $' aria-label='Username'>
        </div>


       
      </div>
    </div>
    <div class='row'>
      <div class='col-1'>
        <button style='color: #fff;' class='btn btn-success' id='btn-AddDescription'>+</button> 
      </div>
      <div class='col-1'>
        <button style='color: #fff;' class='btn btn-danger' id='btn-lessDescription'>-</button> 
      </div>
      <div class='col-10'>
      </div>
    </div>  
  ";
 }else{
  $html.="
    <span><b>Observación Técnica:</b> $observation</span>
    <hr>
    <div class='row'>
      <div class='col-5'>
        <span class='d-flex flex-row'>
        <b>QUO$idQuote</b><button id='btnViewQuoteSupport' class='btn btn-primary' value='$idQuote' class='d-inline' style='margin-left: 0.5rem; color: #fff;'><i class='fa-solid fa-up-right-from-square'></i></button>
        </span>
      </div>
      <div class='col-7'></div>
    </div>
  ";
 }

  echo $html;
?>
  <script>
    jQuery(document).ready(function($){
      $("#precio").on('change', function(){
        let valor = $(this).val()
        $("#precio_uno").val(valor)

      
      })
    })
  </script>