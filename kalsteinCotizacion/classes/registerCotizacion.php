<?php

require __DIR__ . '/conexion.php';
require __DIR__ . '/../../kalsteinPerfiles/vendor/autoload.php';

$consulta = "SELECT * FROM wp_cotizacion";
$resultConsulta = $conexion->query($consulta);
$count = mysqli_num_rows($resultConsulta);
$row = mysqli_fetch_array($resultConsulta);

$email = $_POST['IDacc'];

$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$resultConsulta = $conexion->query($consulta);
$row10 = mysqli_fetch_array($resultConsulta);
$emailAcc = $row10[1];

$sres = $_POST['sres'];
$atc = $_POST['atc'];
$subtotal = $_POST['subtotal'];
$desc = $_POST['desc'];
$subtotal2 = $_POST['subtotal2'];
$descOnline = $_POST['descOnline'];
$envio = $_POST['envio'];
$arancel = $_POST['arancel'];
$iva = $_POST['iva'];
$total = $_POST['total'];
$mEnvio = $_POST['mEnvio'];
$destino = $_POST['destino'];
$zipcode = $_POST['zipcode'];
$incoterm = $_POST['incoterm'];
$divisa = $_POST['divisa'];
$pago = $_POST['pago'];
$datas = $_POST['datas'];
$newUrl = $_POST['newUrl'];
$item = $datas[0];
$maker = $_POST['maker'];

if ($count > 0) {
    $register = "INSERT INTO wp_cotizacion(cotizacion_id, cotizacion_id_user, cotizacion_domain, cotizacion_sres, cotizacion_atencion, cotizacion_create_at, cotizacion_metodo_envio, cotizacion_destino, cotizacion_zipcode, cotizacion_incoterm, cotizacion_divisa, cotizacion_metodo_pago, cotizacion_submit, cotizacion_iva, cotizacion_descuento, cotizacion_subtotal, cotizacion_envio, cotizacion_arancel, cotizacion_total, cotizacion_total_with_discount, cotizacion_status, cotizacion_id_remitente) VALUES ('', '$emailAcc', '$newUrl', '$sres', '$atc', CURRENT_TIMESTAMP, '$mEnvio', '$destino', '$zipcode', '$incoterm', '$divisa', '$pago', '$subtotal', '$iva', '$desc', '$subtotal2', '$envio', '$arancel', '$total', '$descOnline', '0', '$maker')";

    if ($conexion->query($register) === TRUE) {
        $registro = 'correcto';
        $query = "SELECT * FROM wp_cotizacion ORDER BY cotizacion_id DESC";
        $result = $conexion->query($query);
        $col = mysqli_fetch_array($result);
        $id = $col['cotizacion_id'];
        foreach ($datas as $key => $value) {
            $name = $value['name'];
            $model = $value['model'];
            $image = $value['image'];
            $newImage = str_replace("https://kalstein.us/wp-content/uploads/kalsteinQuote/", "", $image);
            $newImage = str_replace("https://kalstein.net/es/wp-content/uploads/kalsteinQuote/", "", $newImage);
            $newImage2 = str_replace("https://testing.kalstein.digital/wp-content/uploads/kalsteinQuote/", "", $newImage);
            $newImage3 = str_replace("https://dev.kalstein.plus/wp-content/uploads/kalsteinQuote/", "", $newImage2);
            $maker = $value['maker'];
            $cant = $value['cant'];
            $precio = $value['precio'];
            $anidado = $value['anidado'];
            $totalprecio = $value['totalprecio'];
            $arrayAccesories = $value['arrayAccesories'];

            if ($cant == 1) {
                $unid = "A";
            } else {
                if ($cant == 2) {
                    $unid = "TWO";
                } else {
                    if ($cant == 3) {
                        $unid = "THREE";
                    } else {
                        if ($cant == 4) {
                            $unid = "FOUR";
                        } else {
                            if ($cant == 5) {
                                $unid = "FIVE";
                            } else {
                                if ($cant == 6) {
                                    $unid = "SIX";
                                } else {
                                    if ($cant == 7) {
                                        $unid = "SEVEN";
                                    } else {
                                        if ($cant == 8) {
                                            $unid = "EIGHT";
                                        } else {
                                            if ($cant == 9) {
                                                $unid = "NINE";
                                            } else {
                                                if ($cant == 10) {
                                                    $unid = "TEN";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $query2 = "INSERT INTO wp_cotizacion_detalle(cotizacion_detalle_aid, cotizacion_detalle_id, cotizacion_detalle_name, cotizacion_detalle_model, cotizacion_detalle_maker, cotizacion_detalle_image, cotizacion_detalle_cant, cotizacion_detalle_unid, cotizacion_detalle_valor_unit, cotizacion_detalle_valor_total, cotizacion_detalle_valor_anidado) VALUES ('', '$id', '$name', '$model', '$maker', '$newImage3', '$cant', '$unid', '$precio', '$totalprecio', '$anidado')";
            $conexion->query($query2);

            if (!empty($arrayAccesories)) {
                foreach ($arrayAccesories as $key => $value2) {
                    $modelAccesorie = $value2['modelAccesorie'];
                    $query3 = "INSERT INTO wp_cotizacion_detalle(cotizacion_detalle_aid, cotizacion_detalle_id, cotizacion_detalle_model, cotizacion_detalle_parent) VALUES ('', '$id', '$modelAccesorie', '$model')";
                    $conexion->query($query3);
                }
            }

            $client = new Google_Client();
            $client->setApplicationName('Google Sheets API PHP Integration');
            $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
            $client->setAuthConfig(__DIR__ . '/../../kalsteinPerfiles/credentials.json');
            $client->setAccessType('offline');

            $service = new Google_Service_Sheets($client);

            $spreadsheetId = '1jRMFwWkqJ5X908HBNO-n-KHqjQRaNWM_vd8Kj6Dy0Ks';
            $range = 'contactos-crm'; // Nombre de la hoja

            try {
                $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                $values = $response->getValues();

                $emailABuscar = $emailAcc; // Asegúrate de que esta variable esté definida
                $columnaParaActualizar = 'G'; // Columna donde se actualizará el valor

                $rowIndex = null;
                foreach ($values as $index => $row) {
                    if (in_array($emailABuscar, $row)) {
                        $rowIndex = $index + 1; // +1 porque los índices en Sheets comienzan en 1
                        break;
                    }
                }

                if ($rowIndex === null) {
                    throw new Exception("Correo no encontrado.");
                } else {
                    $currentValueRange = 'contactos-crm!' . $columnaParaActualizar . $rowIndex;
                    $currentResponse = $service->spreadsheets_values->get($spreadsheetId, $currentValueRange);
                    $currentValue = $currentResponse->getValues();

                    if ($currentValue[0][0] == 'R2') {
                        $updateRange = 'contactos-crm!' . $columnaParaActualizar . $rowIndex;
                        $updateValues = [['R4']];

                        $body = new Google_Service_Sheets_ValueRange([
                            'values' => $updateValues
                        ]);
                        $params = ['valueInputOption' => 'RAW'];
                        $result = $service->spreadsheets_values->update($spreadsheetId, $updateRange, $body, $params);

                        if ($result->getUpdatedCells() == 0) {
                            throw new Exception("La celda no fue actualizada.");
                        }
                        $statusCelda = "Celda actualizada.";
                    } else {
                        $statusCelda = "No se requiere actualización.";
                    }
                }
            } catch (Exception $e) {
                error_log("Error al actualizar la hoja de cálculo: " . $e->getMessage());
                $statusCelda = "Error: " . $e->getMessage();
            }
        }
    } else {
        $registro = 'incorrecto';
    }
} else {
    $register = "INSERT INTO wp_cotizacion(cotizacion_id, cotizacion_id_user, cotizacion_domain, cotizacion_sres, cotizacion_atencion, cotizacion_create_at, cotizacion_metodo_envio, cotizacion_destino, cotizacion_zipcode, cotizacion_incoterm, cotizacion_divisa, cotizacion_metodo_pago, cotizacion_submit, cotizacion_iva, cotizacion_descuento, cotizacion_subtotal, cotizacion_envio, cotizacion_arancel, cotizacion_total, cotizacion_total_with_discount, cotizacion_status, cotizacion_id_remitente) VALUES ('', '$emailAcc', '$newUrl', '$sres', '$atc', CURRENT_TIMESTAMP, '$mEnvio', '$destino', '$zipcode', '$incoterm', '$divisa', '$pago', '$subtotal', '$iva', '$desc', '$subtotal2', '$envio', '$arancel', '$total', '$descOnline', '0', '$maker')";
    if ($conexion->query($register) === TRUE) {
        $registro = 'correcto';
        $query = "SELECT * FROM wp_cotizacion ORDER BY cotizacion_id DESC";
        $result = $conexion->query($query);
        $col = mysqli_fetch_array($result);
        $id = $col['cotizacion_id'];
        foreach ($datas as $key => $value) {
            $name = $value['name'];
            $model = $value['model'];
            $image = $value['image'];
            $newImage = str_replace("https://kalstein.us/wp-content/uploads/kalsteinQuote/", " ", $image);
            $newImage = str_replace("https://kalstein.net/es/wp-content/uploads/kalsteinQuote/", "", $newImage);
            $newImage2 = str_replace("https://testing.kalstein.digital/wp-content/uploads/kalsteinQuote/", " ", $newImage);
            $newImage3 = str_replace("https://dev.kalstein.plus/wp-content/uploads/kalsteinQuote/", "", $newImage2);
            $maker = $value['maker'];
            $cant = $value['cant'];
            $precio = $value['precio'];
            $anidado = $value['anidado'];
            $totalprecio = $value['totalprecio'];
            $arrayAccesories = $value['arrayAccesories'];

            if ($cant == 1) {
                $unid = "A";
            } else {
                if ($cant == 2) {
                    $unid = "TWO";
                } else {
                    if ($cant == 3) {
                        $unid = "THREE";
                    } else {
                        if ($cant == 4) {
                            $unid = "FOUR";
                        } else {
                            if ($cant == 5) {
                                $unid = "FIVE";
                            } else {
                                if ($cant == 6) {
                                    $unid = "SIX";
                                } else {
                                    if ($cant == 7) {
                                        $unid = "SEVEN";
                                    } else {
                                        if ($cant == 8) {
                                            $unid = "EIGHT";
                                        } else {
                                            if ($cant == 9) {
                                                $unid = "NINE";
                                            } else {
                                                if ($cant == 10) {
                                                    $unid = "TEN";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $query2 = "INSERT INTO wp_cotizacion_detalle(cotizacion_detalle_aid, cotizacion_detalle_id, cotizacion_detalle_name, cotizacion_detalle_model, cotizacion_detalle_maker, cotizacion_detalle_image, cotizacion_detalle_cant, cotizacion_detalle_unid, cotizacion_detalle_valor_unit, cotizacion_detalle_valor_total, cotizacion_detalle_valor_anidado) VALUES ('', '$id', '$name', '$model', '$maker', '$newImage3', '$cant', '$unid', '$precio', '$totalprecio', '$anidado')";
            $conexion->query($query2);

            if (!empty($arrayAccesories)) {
                foreach ($arrayAccesories as $key => $value2) {
                    $modelAccesorie = $value2['modelAccesorie'];
                    $query3 = "INSERT INTO wp_cotizacion_detalle(cotizacion_detalle_aid, cotizacion_detalle_id, cotizacion_detalle_model, cotizacion_detalle_parent) VALUES ('', '$id', '$modelAccesorie', '$model')";
                    $conexion->query($query3);
                }
            }

            $client = new Google_Client();
            $client->setApplicationName('Google Sheets API PHP Integration');
            $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
            $client->setAuthConfig(__DIR__ . '/../../kalsteinPerfiles/credentials.json');
            $client->setAccessType('offline');

            $service = new Google_Service_Sheets($client);

            $spreadsheetId = '1jRMFwWkqJ5X908HBNO-n-KHqjQRaNWM_vd8Kj6Dy0Ks';
            $range = 'contactos-crm'; // Nombre de la hoja

            try {
                $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                $values = $response->getValues();

                $emailABuscar = $emailAcc; // Asegúrate de que esta variable esté definida
                $columnaParaActualizar = 'G'; // Columna donde se actualizará el valor

                $rowIndex = null;
                foreach ($values as $index => $row) {
                    if (in_array($emailABuscar, $row)) {
                        $rowIndex = $index + 1; // +1 porque los índices en Sheets comienzan en 1
                        break;
                    }
                }

                if ($rowIndex === null) {
                    throw new Exception("Correo no encontrado.");
                } else {
                    $currentValueRange = 'contactos-crm!' . $columnaParaActualizar . $rowIndex;
                    $currentResponse = $service->spreadsheets_values->get($spreadsheetId, $currentValueRange);
                    $currentValue = $currentResponse->getValues();

                    if ($currentValue[0][0] == 'R2') {
                        $updateRange = 'contactos-crm!' . $columnaParaActualizar . $rowIndex;
                        $updateValues = [['R4']];

                        $body = new Google_Service_Sheets_ValueRange([
                            'values' => $updateValues
                        ]);
                        $params = ['valueInputOption' => 'RAW'];
                        $result = $service->spreadsheets_values->update($spreadsheetId, $updateRange, $body, $params);

                        if ($result->getUpdatedCells() == 0) {
                            throw new Exception("La celda no fue actualizada.");
                        }
                        $statusCelda = "Celda actualizada.";
                    } else {
                        $statusCelda = "No se requiere actualización.";
                    }
                }
            } catch (Exception $e) {
                error_log("Error al actualizar la hoja de cálculo: " . $e->getMessage());
                $statusCelda = "Error: " . $e->getMessage();
            }
        }
    } else {
        $registro = 'incorrecto';
    }
}

$datos = array(
    'registro' => $registro,
    'id' => $id,
    'emailAcc' => $emailAcc,
    'statusCelda' => $statusCelda,
    'emailFound' => $emailFound
);

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();