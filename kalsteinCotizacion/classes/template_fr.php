<?php
    session_start();
	if (isset($_SESSION['idCotizacion'])) {
		$idCotizacion = $_SESSION['idCotizacion'];
	}else{
        $idCotizacion = $_GET['idCotizacion'];
    }

    require __DIR__ . '/conexion.php';

	$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$idCotizacion'";
    $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$idCotizacion'";
		
    $result = $conexion->query($consulta);
	$row = mysqli_fetch_array($result);

    $id = $row["cotizacion_id"];
    $sres = $row["cotizacion_sres"];
    $atc = $row["cotizacion_atencion"];
    $created = $row["cotizacion_create_at"];
    $fecha = new DateTime($created);
    $onlyDate = date_format($fecha, 'd-m-y');  
    $onlyHours = date_format($fecha, 'h:i A'); 
    $subtotal = $row["cotizacion_submit"];
    $iva = $row["cotizacion_iva"];
    $desc = $row["cotizacion_descuento"];
    $subtotal2 = $row["cotizacion_subtotal"];
    $envio = $row["cotizacion_envio"];
    $total = $row["cotizacion_total"];    
    $incoterm = $row["cotizacion_incoterm"];
    $divisa = $row["cotizacion_divisa"];
    $pago = $row["cotizacion_metodo_pago"];
    $envioM = $row["cotizacion_metodo_envio"];
    $country = $row["cotizacion_destino"];

    if ($country == 0){
        $nameC = "";
    }else{
        $query = "SELECT * FROM wp_paises WHERE iso = '$country'";
        $rs = $conexion->query($query);
        $row = mysqli_fetch_array($rs);
        $nameC = $row['en'];
    }

    if ($incoterm === 'EXW Kalstein France'){
        $descuentoEspecial = '&nbsp;';
    }else{
        $descuentoEspecial = 'Remise spéciale (18%), appliquée.';
    }

    if ($envioM === 'Maritime'){      
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>CIF $nameC (Coût + Fret + Assurance).</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Fret maritime.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 jours.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Assurance d'expédition incluse</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'> $divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 an contre les défauts de fabrication.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 19mm;'>Monnaie:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantie:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Mode de paiement:</p>";
    }else{
        if ($envioM === 'Aerial'){
            $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>DAP $nameC (Livré sur place).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Fret aérien (service de messagerie).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 jours.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Assurance d'expédition incluse</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 an contre les défauts de fabrication.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

            $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 15mm;'>Monnaie:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantie:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Mode de paiement:</p>";
        }else{
            $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$incoterm.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 an contre les défauts de fabrication.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

            $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Monnaie:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantie:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Mode de paiement:</p>";
        }        
    }

    $resultado = $conexion->query($consulta2);
?> 
    <link rel="stylesheet" type="text/css" href="pdf.css">
<div class='cp01'>
    <div class='h-01'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/francia-pais.jpg" style='float: right; width: 18%; margin-top: 25mm; margin-right: 45mm;'>
    </div>
    <div class='b-01' style='background-image: url(https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/fondo.png)'>
        <div class='id'>
            <div class='logo'>
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/logo.png" style='float: right; width: 70%; margin-top: 55mm; margin-right: 2%;'>
            </div>
            <div class='hr'></div>
            <div class='n-id'>
                <p class='co'>DEVIS</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $id?></span></p>
                <p class='msj'>UN ACCOMPAGNEMENT DIFFÉRENT, À VOTRE SERVICE</p>
            </div>
        </div> 
        <div class='f-01'>
            <div class='qr'>
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/qr.jpg" style='width: 100%;'>
            </div>
            <div class='f-text'>
                <p class='l-1'>All rights reserved ® KALSTEIN France S. A. S.,</p>
                <p class='l-2'>2 Rue Jean Lantier •  75001 Paris •</p>
                <p class='l-3'>+33 1 78 95 87 89 / +33 6 80 76 07 10 •</p>
                <p class='l-4'>https://kalstein.eu</p>
                <p class='l-5'>KALSTEIN FRANCE, S. A. S</p>
            </div>
            <div class='hr-2'></div>
            <div class='img-logo2'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/logo-blanco.png" style='width: 50%; float: right;'>
            </div>
        </div>       
    </div>    
</div>
<br/>
<br/>
<br/>
<div class='cp02'>
    <div class='style-01'></div>
    <div class='style-02'></div>
    <div class='h-02'>
        <div class='logo-02'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/logo.png" style='float: right; width: 70%; margin-top: 15mm; margin-right: 2mm;'>
        </div>
        <div class='hr-02'></div>
        <div class='h-text-02'>
            <p class='lt-01'>NOS SERVICES</p>
            <p class='lt-02'>Avantages et soutien</p>
            <p class='lt-03'>Chez Kalstein France, nous nous occupons de la pleine satisfaction de nos clients, c'est pourquoi nous fournissons des services à valeur ajoutée de haut niveau sur la base de notre expérience.</p>
        </div>
    </div>
    <div class='p2img-01'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen1.jpg" style='float: right; width: 100%;'>
    </div>
    <div class='p2img-02'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen2.jpg" style='float: right; width: 100%;'>
    </div>
    <div class='p2img-03'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen3.jpg" style='float: right; width: 100%;'>
    </div>
    <div class='cmsj-01'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono1.png" style='float: right; width: 100%; margin-top: 50%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Inductions et formations en ligne</p>
            <p class='i-p'>Dans n'importe quelle partie du monde, recevez votre initiation ou formation de notre équipe spécialisée d'ingénieurs.</p>
        </div>
    </div>
    <div class='cmsj-02'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono2.png" style='float: right; width: 90%; margin-top: 45%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Réponse rapide</p>
            <p class='i-p'>Notre équipe de travail est toujours disponible pour répondre à toutes vos questions, afin de vous aider dans toutes les situations.</p>
        </div>
    </div>
    <div class='cmsj-03'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono3.png" style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>#Letsgivemore <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/corazon.png" style='width: 12px'></p>
            <p class='i-p'>Grâce à votre achat, un don sera fait à une fondation à but non lucratif qui lutte contre le cancer du sein et aide les communautés les plus vulnérables.</p>
        </div>
    </div>
    <div class='cmsj-04'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono4.png" style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title1'>Support technique</p>
            <p class='i-p'>Profitez de conseils personnalisés pour la maintenance préventive et corrective de votre équipement, grâce aux manuels et articles Kalstein, aux catalogues spéciaux et aux tutoriels vidéo.</p>
        </div>
    </div>
    <div class='cmsj-05'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono5.png" style='float: right; width: 100%; margin-top: 58%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title2'>Logistique d'expédition</p>
            <p class='i-p'>Nous nous occupons de toute la logistique nécessaire à l'expédition de vos produits, que ce soit par voie maritime, terrestre ou aérienne.</p>
        </div>
    </div>
    <div class='cmsj-06'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono6.png" style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title3'>Kalstein Worldwide</p>
            <p class='i-p'>Avec plus de 25 ans de croissance avec nos clients, le contenu moderne et multiformat de Kalstein est maintenant présent dans plus de 10 pays et en pleine croissance.</p>
        </div>
    </div>
    <div class='f2-text'>
        <p class='t-1'>Tous droits réservés ® KALSTEIN France S. A. S.,</p>
    </div>
    <div class='style-03'><p style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>Page [[page_cu]] de [[page_nb]]</p></div>
    <div class='style-04'></div>
</div>
    

<page backtop="58mm" backbottom="30mm" backleft="0mm" backright="0mm"> 
    <page_header> 
        <div class='ht'>
            <div class='logo-03'>
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/logo.png" style='float: right; width: 70%; margin-top: 15mm; margin-right: 2mm;'>
            </div>
            <div class='tp-01'>
                <p>KALSTEIN FRANCE SIREN: 819 970 815</p>
            </div>
            <div class='tp-02'>
                <p style='font-weight: bold; margin: 0; padding: 0;'>Devis N°: <span style='font-weight: lighter;'>QUO<?php echo $id?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate?> <?php echo $onlyHours?></p>
            </div>
        </div>
        <div class='hr-04'></div>   
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Messieurs:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $sres?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Attention:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $atc?></p>
            </div>
        </div>  
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-m'>Modèle</td>
                    <td class='td-im'>Image</td>
                    <td class='td-d'>Description</td>
                    <td class='td-c'>Qté</td>
                    <td class='td-u'>Unid</td>
                    <td class='td-v'>Valeur unitaire</td>
                    <td class='td-vt'>Valeur totale</td>
                </tr>
            </table>
        </div>
    </page_header> 
    <page_footer> 
        <div class='ft'>
            <div class='ft-01'>
                <div class='img-ce'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/img-ce.jpg" style='float: right; width: 100%; margin-top: 5mm;'>
                </div>
                <div class='text-ce'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Marquage CE : acheter en toute tranquillité d'esprit</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Tous les équipements Kalstein sont conformes aux exigences de l'UE, conformément à la réglementation applicable.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/icono3.png" style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Avec l'acquisition d'un équipement Kalstein</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Vous contribuez à la Fondation Jacinto Convit, OneTreePlanted, la Fondation Humatem et la Fondation Maniapure.</p>
                </div>
            </div>
            <div class='hr-05'></div>
            <div class='ft-02'>
                <div class='ft-02-text'>
                    <p style='margin: 0; padding: 0; font-size: 9px; margin-top: 5mm;'>KALSTEIN FRANCE S.A.S</p>
                    <p style='margin: 0; padding: 0; font-size: 9px; margin-top: 1mm;'>• 2 Rue Jean Lantier, • 75001 Paris •</p>
                    <p style='margin: 0; padding: 0; font-size: 8px; margin-top: 1mm;'>+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://kalstein.eu</p>
                </div>
                <div class='ftn-3'>
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Page [[page_cu]] de [[page_nb]]</p>
                </div>
            </div>
        </div>
    </page_footer>
        <?php
        
            if ($resultado->num_rows > 0) {
                $i = 0;
                while ($value = $resultado->fetch_assoc()) {
                    $model = $value['cotizacion_detalle_model'];
                    $name = $value['cotizacion_detalle_name'];
                    $image = $value['cotizacion_detalle_image'];
                    $cant = $value['cotizacion_detalle_cant'];
                    $unid = $value['cotizacion_detalle_unid'];
                    $maker = $value['cotizacion_detalle_maker'];
                    $valorUnit = $value['cotizacion_detalle_valor_unit'];
                    $valorTotal = $value['cotizacion_detalle_valor_total'];
                    $valorAnidado = $value['cotizacion_detalle_valor_anidado'];
                    $newModel = str_replace("|", " ", $model);
                    $newMaker = str_replace("Fabricante", "Marca", $maker);

                    if ($valorAnidado === '0.00'){
                        $newValor = "";
                    }else{
                        $newValor = "(+ $valorAnidado)";
                    }
                    $i = $i + 1;
                    echo "
                        <table>
                            <tr>
                                <td class='tdb-i'>$i</td>
                                <td class='tdb-m'>$newModel</td>
                                <td class='tdb-img'>
                                    <img src='$image' style='width: 100%;'>
                                </td>
                                <td class='tdb-d'>
                                    <p style='margin: 0; padding: 0; font-size: 11px;'>$newMaker</p>
                                    <p style='margin: 0; padding: 0; font-size: 11px;'>$name</p>
                                </td>
                                <td class='tdb-c'>$cant,00</td>
                                <td class='tdb-u'>$unid</td>
                                <td class='tdb-v'>$valorUnit<br>$newValor</td>
                                <td class='tdb-vt'>$valorTotal</td>                            
                            </tr>
                        </table>
                    ";
                }
            }
        ?>
    <div class='bt-02'>
        <div class='sbt-02'>
            <div class='ob'>
                <div class='sob'>
                    <div class='ob-title'>
                        <p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0;'>Observations:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>Délais de livraison:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Représentant commercial:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 12mm;'>Conditions commerciales:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 7mm;'>Incoterm:</p>                       
                        <?php
                            echo $a;
                        ?>
                    </div>
                    <div class='ob-p'>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 7mm; margin-left: 3mm;'>7 - 10 jours approx.</p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>Yuleana Mia</p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1mm; margin-left: 3mm;'>Email: mia@kalstein.eu</p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1mm; margin-left: 3mm;'>Tlf: +33 1 7895 8789 / +33 6 8076 0710</p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>Acompte avec bon de commande.</p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1mm; margin-left: 3mm;'><?php echo $descuentoEspecial?></p>
                        <?php 
                            echo $b;  
                        ?>
                    </div>
                </div>
            </div>
            <div class='totales'>
                <div class='subtotales'>
                    <div class='totales-t'>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>Sous-total:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>IVA:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Remise (18%):</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Sous-total:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Expédition:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Total:</p>
                    </div>
                    <div class='totales-n'>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'><?php echo $subtotal?></p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'><?php echo $iva?></p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'><?php echo $desc?></p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'><?php echo $subtotal2?></p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'><?php echo $envio?></p>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'><?php echo $total?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>
    <div class='h4-02'>
        <div class='logo4-02'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/logo.png" style='float: right; width: 70%; margin-top: 12mm; margin-right: 2mm;'>
        </div>
        <div class='hr4-02'></div>
        <div class='h4-text-02'>
            <p class='lt4-01'>CONDITIONS COMMERCIALES</p>
        </div>
    </div>
    <div class='p2img-01'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen1.jpg" style='float: right; width: 100%;'>
    </div>
    <div class='p2img-02'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen2.jpg" style='float: right; width: 100%;'>
    </div>
    <div class='p2img-03'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen3.jpg" style='float: right; width: 100%;'>
    </div>
    <div class='main-text'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px;'>ACCEPTATION DE COMMANDE FOURNISSEUR</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Kalstein France SAS reçoit une satisfaction de bon de commande, lorsque ce document exprime fidèlement les conditions commerciales établies dans l'offre.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Paiements en espèces : Pour le traitement et l'expédition de la marchandise demandée, la vérification du paiement sur les comptes bancaires Kalstein France est requise.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm; margin-left: 0.2mm;'>Clients avec crédit : Pour le traitement et l'expédition de la marchandise demandée, une preuve de paiement sur les comptes bancaires Kalstein France est requise.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 10mm;'>DEVISE DE TRANSACTION</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Offres en devises étrangères, le calcul de la conversion monétaire sera effectué conformément aux dispositions de la Banque de France, fixées le jour de la facturation.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La devise de négociation établie pour cette annonce est <?php echo $divisa?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>GARANTIE</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Tous les équipements vendus par Kalstein France bénéficient d'une garantie d'un an à des fins de fabrication à compter de la date de facturation des marchandises.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La garantie ne couvre pas les dommages causés par une mauvaise installation ou un mauvais fonctionnement, des défauts de transport ou par des utilisations autres que celles spécifiées par le fabricant.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La garantie exclut les pièces électriques ou consommables.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>DÉLAIS DE LIVRAISON</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Les délais de livraison indiqués dans ce devis sont des estimations sujettes à variables.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 7mm;'>ANNULATIONS ET RETOURS SANS JUSTIFICATION</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Les marchandises en stock auront une pénalité équivalente à 20 % de la valeur du bon de commande.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Importer la marchandise, après réception de la commande à la satisfaction, il y a un maximum de (3) jours pour annuler la commande, après cette période les annulations ne sont pas acceptées et la marchandise sera facturée comme établi.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Le retour de la marchandise sera à la charge du Client, de la caisse, de l'emballage et de toutes les pièces composant l'équipement à renvoyer, doit être en parfait état sans mauvais traitement, rayures et étiquettes supplémentaires, l'équipe d'assistance technique et logistique de Kalstein France, réalisant le rapport technique et indiquera la réception satisfaisante de la marchandise. S'il n'est pas reçu de manière satisfaisante, l'équipement sera facturé conformément aux dispositions du Bon de Commande.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 22mm;'>POLITIQUES GÉNÉRALES, CONDITIONS GÉNÉRALES</p>
        <p style='margin: 0; padding: 0; font-size: 11px; margin-top: 1mm;'>https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='style-07'><p style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>Page [[page_cu]] de [[page_nb]]</p></div>
    <div class='style-08'></div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>
    
    <div class='logo-05'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/logo.png" style='float: left; width: 60%; margin-top: 15mm; margin-left: 10mm;'><br><br><br><br><br><br><br><br>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 9px; margin-top: -2mm; margin-left: 28mm;'>Un accompagnement différent, à votre service</p>
    </div>
    <div class='img-loc'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/imagen4.jpg" style='float: left; width: 100%;'>
    </div>
    <div class='inf-cont'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 18px;'>DES QUESTIONS?</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Contactez-nous:</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 4mm;'>PARIS - FRANCE</p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 1mm;'>SIÈGE</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>2 Rue Jean Lantier</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Paris - France</p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 1mm;'>Fax: <span style='color: #213280; font-size: 11px; font-weight: lighter;'>+33 (0) 1 78 95 87 89</span></p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 1mm;'>Tlf: <span style='color: #213280; font-size: 11px; font-weight: lighter;'>+33 (0) 6 80 76 07 10</span></p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>sales@kalstein.eu</p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 1mm;'>https://dev.kalstein.plus/plataforma/</p>    
    </div>
    <div class='img-cont'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinCotizacion/assets/images/FAQ_FR.png" style='float: left; width: 100%; height: 100%;'>
    </div>   
    <div class='f-last'>
        <p style='margin: 0; padding: 0; text-align: center; font-size: 7px; margin-top: 5mm;'>KALSTEIN FRANCE S.A.S</p>
        <p style='margin: 0; padding: 0; text-align: center; font-size: 7px; margin-top: 0.1mm;'>• 2 Rue Jean Lantier, • 75001 Paris •</p>
        <p style='margin: 0; padding: 0; text-align: center; font-size: 7px; margin-top: 0.1mm;'>+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://kalstein.eu</p>
    </div>
    <div class='style-07'><p style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>Page [[page_cu]] de [[page_nb]]</p></div>
    <div class='style-08'></div>
</page>