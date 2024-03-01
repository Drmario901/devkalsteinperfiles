<?php

session_start();

if(isset($_SESSION["nameQuery"])){
    $cName = $_SESSION["nameQuery"];
    $cNameEncrypt = md5($cName);
} else {
    echo "<script>
    alert('Inicia sesión.');

    window.location.replace('https://dev.kalstein.plus/plataforma/acceder/'); 
    </script>";
}

$image_path = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/caret-down-fill.svg";
$image_path2 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/chevron-left.svg";
$image_path3 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/chevron-right.svg";
$image_path4 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/clean.svg";
$image_path5 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/text-left.svg";
$image_path6 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/text-center.svg";
$image_path7 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/text-right.svg";
$image_path8 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/justify.svg";
$image_path9 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/chevron-compact-up.svg";
$image_path10 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/chevron-up.svg";
$image_path11 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/chevron-double-up.svg";
$image_path12 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/chevron-bar-up.svg";
$image_path13 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/box-arrow-in-up.svg";
$image_path14 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/arrows.svg";
$image_path15 = "https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/uploadsvg.svg";
$titleContent = "UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO";
include_once("https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/customizeTemplateQuerys.php");
?>
<!-- <div class="container"> -->
<div class='row' id='content'>
    
    <div class='col-12 col-md-3' id='aside'>
        <div class="row" style='padding: 0; border-bottom: 2px solid #E9E9EB;'>
            <div class="col-2">
                <p class='btnCloseCustomizeTemplate' style='width: auto;'>X</p>
            </div>
            <div class="col-10"></div>
        </div>
        <div class="row" style='background-color: #fff; border-bottom: 2px solid #E9E9EB;'>
            <div class="col-1"></div>
            <div class="col-10" style='margin-top: 0.5rem; margin-bottom: 0.5rem;'>
<<<<<<< HEAD
                <p style='margin: 0 0 0 0 !important;'> ¡Hola! <?php echo $cName ?>, usted está personalizando:</p>
                <br>
                <h5>Plantilla de cotización</h5>
=======
                <p style='margin: 0 0 0 0 !important;'> <span data-i18n="customizeTemplate:spanHola">¡Hola!</span> <?php echo $cName ?><span data-i18n="customizeTemplate:spanYouThisPer">, usted está personalizando:</span></p>
                <br>
                <h5 data-i18n="customizeTemplate:h5PlantillaCotizacion">Plantilla de cotización</h5>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
            </div>
            <div class="col-1"></div>
        </div>
        <!-- Opciones -->

        <!-- OPCIONES GENERALES -->
<!--         <div class="row mt-5" style='background-color: #fff; border-bottom: 2px solid #E9E9EB;' id='textRow'>
            <div class="col-1"></div>
            <div class="col-10" style='margin-top: 0.5rem; margin-bottom: 0.5rem;'>
            <div style="display: block; margin-bottom: 0.3rem !important; margin-top: 0.3rem!important;" id="generalDiv">
                <p style='margin: 0 0 0 0 !important;'>OPCIONES GENERALES</p>
            </div>
                <hr style="border-bottom: 1px solid black; display: none; width: 159px;" class="mt-0 mb-0" id="generalSeparationLine">
                <div style="display: none; justify-content: space-between; align-items: center; margin-left: 10px;" class="mt-3" id="textDiv">
                    <p id="textOption" style='margin: 0 0 0 0 !important;'>TEXTO <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
                    <button class="btn" id="textBtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></button>
                </div>
                <hr style="border-bottom: 1px solid black; display: none;" class="mt-0 mb-0" id="textSeparationLine">                
                <div class="mt-3 mb-0" id="textOptions" style="display: none; margin-left: 20px;">
                    <p id="textFontOption">FUENTE</p>
                        <div style="overflow-x: auto; white-space: nowrap; max-height: 120px;">
                            <select id="textFontPicker1" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="labelGeneralTextFontOption lb2" style="display: none;">Títulos</p>
                            <select id="textFontPicker2" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="labelGeneralTextFontOption lb2" style="display: none;">Subtítulos</p>
                            <select id="textFontPicker3" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="labelGeneralTextFontOption lb2" style="display: none;">Párrafos</p>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <button id="textFontSaveButton" class="my-3" style="margin-right: 10px; display: none;">Guardar</button>
                            <button class="btn my-3" id="textFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></button>
                        </div>

                    <p id="generalTextColorOption">COLOR</p>
                        <input type="color" id="generalTextColorPicker1" style="display: none;" value="#213280">
                        <p class="labelGeneralTextColorOption lb2" style="display: none;">Títulos</p>
                        <input type="color" id="generalTextColorPicker2" style="display: none;" value="#213280">
                        <p class="labelGeneralTextColorOption lb2" style="display: none;">Subtítulos</p>
                        <input type="color" id="generalTextColorPicker3" style="display: none;">
                        <p class="labelGeneralTextColorOption lb2" style="display: none;">Párrafos</p>
                        <div style="display: flex; align-items: center;">
                            <button id="generalTextColorSaveButton" class="my-3" style="margin-right: 10px; display: none;">Guardar</button>
                            <button class="btn my-3" id="generalTextColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></button>
                        </div>

                </div>                      
            </div>
            <div class="col-1"></div>
        </div>        
 -->

        <form method="post" enctype="multipart/form-data" id='formularioImagenes'>

        <!-- OPCIONES PAGINA 1 -->
        <div class="row" style='background-color: #fff; border-bottom: 2px solid #E9E9EB;' id='titleRow'>
            <div class="col-1"></div>
            <div class="col-10" style='margin-top: 0.5rem; margin-bottom: 0.5rem;'>

            <div style="display: block; margin-bottom: 0.3rem !important; margin-top: 0.3rem!important;" id="pagina1Div">
<<<<<<< HEAD
                <p style='margin: 0 0 0 0 !important;'>OPCIONES PAGINA 1</p>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; width: 144px;" class="mt-0 mb-0" id="pagina1SeparationLine">
                <div class="mt-3" style="display: none; justify-content: space-between; align-items: center; margin-left: 10px;" id="titleDiv">
                    <p id="titleOption" style='margin: 0 0 0 0 !important;'>TITULO <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                <p style='margin: 0 0 0 0 !important;' data-i18n="customizeTemplate:elementPageOptionsOne">OPCIONES PAGINA 1</p>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; width: 144px;" class="mt-0 mb-0" id="pagina1SeparationLine">
                <div class="mt-3" style="display: none; justify-content: space-between; align-items: center; margin-left: 10px;" id="titleDiv">
                    <p id="titleOption" style='margin: 0 0 0 0 !important;'><span data-i18n="customizeTemplate:elementTitleMayus">TITULO</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1" id="titleBtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none;" class="mt-0 mb-0" id="titleSeparationLine">
                <div class="mt-3 mb-0" id="titleOptions" style="display: none; margin-left: 20px;">
<!--                     <p id="titleDispositionOption">DISPOSICION</p>
                        <div class="p1TitleOptionsFlex" style="display: none; align-items: center; margin-top: 14px; margin-left: 15px; margin-top: -9px;">
                            <label style="display: none;" class="disabled p1TitleDisplayLabel">AMBOS</label>
                            <input type="checkbox" id="p1TitleDisplay0" checked disabled style="display: none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="p1TitleOptionsFlex" style="display: none; align-items: center; margin-top: 7px; margin-left: 15px;">
                            <label style="display: none;" class="disabled p1TitleDisplayLabel">SOLO IMAGEN</label>
                            <input type="checkbox" id="p1TitleDisplay1" style="display: none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="p1TitleOptionsFlex" style="display: none; align-items: center; margin-top: 7px; margin-left: 15px;">
                            <label style="display: none;" class="disabled p1TitleDisplayLabel">SOLO TITULO</label>
                            <input type="checkbox" id="p1TitleDisplay2" style="display: none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="p1TitleOptionsFlex" style="display: none; align-items: center; margin-left: 15px; margin-bottom: 8px;">
                            <label style="display: none; padding-top: 5px;" class="disabled p1TitleDisplayLabel">LADO</label>
                            <button class="btn mt-0 mb-0 pt-0 pb-0 p1SideChange1" id="p1SideChange" style="display: none;"><img src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/arrows.svg" alt="change"></button>
                        </div> -->
<<<<<<< HEAD
                    <p id="titleTextOption">TEXTO</p>
                        <label style="display: none;" id="p1TitleTextLabel1" class="disabled">Título 1</label>
                        <textarea id="titleTextPicker1" style="display: none; height: 43px;" maxlength="30">COTIZACIÓN</textarea>
                        <p id="charCount1" style="display: none">10 / 30 caracteres</p>

                        <label style="display: none;" id="p1TitleTextLabel3" class="disabled">PÁRRAFO</label>
                        <textarea id="titleTextPicker3" style="display: none;" maxlength="80">UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO</textarea>
                        <p id="charCount3" style="display: none">42 / 80 caracteres</p>
                        <div style="display: flex; align-items: center;">
                            <a id="titleSaveButton" class="btn mt-0 mb-3" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn mt-0 mb-3" id="titleBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>

                    <p id="titleColorOption">COLOR</p>
                        <input type="color" id="titleColorPicker1" style="display: none;">
                        <p class="labelColorOption lb2" style="display: none;">Título 1</p>
                        <input type="color" id="titleColorPicker2" style="display: none;" value="#213280">
                        <p class="labelColorOption lb2" style="display: none;">Título 2</p>
                        <input type="color" id="titleColorPicker3" style="display: none;">
                        <p class="labelColorOption lb2" style="display: none;">Título 3</p>
                        <div style="display: flex; align-items: center;">
                            <a id="colorSaveButton" class="btn my-3" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="titleTextOption" data-i18n="customizeTemplate:elementText">TEXTO</p>
                        <label style="display: none;" id="p1TitleTextLabel1" class="disabled" data-i18n="customizeTemplate:elementTitleOne">Título 1</label>
                        <textarea id="titleTextPicker1" style="display: none; height: 43px;" maxlength="30" data-i18n="customizeTemplate:elementCotizacionMayus">COTIZACIÓN</textarea>
                        <p id="charCount1" style="display: none" data-i18n="customizeTemplate:elementCaracteresOne">10 / 30 caracteres</p>

                        <label style="display: none;" id="p1TitleTextLabel3" class="disabled" data-i18n="customizeTemplate:elementParagraphMayus">PÁRRAFO</label>
                        <textarea id="titleTextPicker3" style="display: none;" maxlength="80" data-i18n="customizeTemplate:elementTextareaText">UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO</textarea>
                        <p id="charCount3" style="display: none" data-i18n="customizeTemplate:elementCaracteresTwo">42 / 80 caracteres</p>
                        <div style="display: flex; align-items: center;">
                            <a id="titleSaveButton" class="btn mt-0 mb-3" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
                            <a class="btn mt-0 mb-3" id="titleBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>

                    <p id="titleColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <input type="color" id="titleColorPicker1" style="display: none;">
                        <p class="labelColorOption lb2" style="display: none;" data-i18n="customizeTemplate:elementTitleOne">Título 1</p>
                        <input type="color" id="titleColorPicker2" style="display: none;" value="#213280">
                        <p class="labelColorOption lb2" style="display: none;" data-i18n="customizeTemplate:elementTitleTwo">Título 2</p>
                        <input type="color" id="titleColorPicker3" style="display: none;">
                        <p class="labelColorOption lb2" style="display: none;" data-i18n="customizeTemplate:elementTitleThree">Título 3</p>
                        <div style="display: flex; align-items: center;">
                            <a id="colorSaveButton" class="btn my-3" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn my-3" id="colorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>

<!--                     <p id="titleSizeOption">TAMAÑO</p>
                        <input type="number" id="titleSizePicker" style="display: none;" min="12" max="40" value="18">
                        <p class="labelSizeOption lb2" style="display: none">Titulo 1</p>
                        <input type="number" id="titleSizePicker2" style="display: none;" min="15" max="85" value="45">
                        <p class="labelSizeOption lb2" style="display: none">Titulo 2</p>
                        <input type="number" id="titleSizePicker3" style="display: none;" min="12" max="40" value="12">
                        <p class="labelSizeOption lb2" style="display: none">Titulo 3</p>
                        <div style="display: flex; align-items: center;">
                            <a id="sizeSaveButton" class="btn my-3" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-3" id="sizeBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->

                    <!-- <p id="titleFontOption">FUENTE</p>
                        <div style="overflow-x: auto; white-space: nowrap; max-height: 120px;">
                            <select id="titleFontPicker1" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="labelFontOption lb2" style="display: none">Titulo 1</p>
                            <select id="titleFontPicker2" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="labelFontOption lb2" style="display: none">Titulo 2</p>
                            <select id="titleFontPicker3" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="labelFontOption lb2" style="display: none">Titulo 3</p>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <a id="fontSaveButton" class="btn my-3" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-1" id="fontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->

<<<<<<< HEAD
                    <p id="titleAlignOption">ALINEACIÓN</p>
=======
                    <p id="titleAlignOption" data-i18n="customizeTemplate:elementAlineacion">ALINEACIÓN</p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <div style="display: flex; align-items: center;">
                            <a class="btn mt-0 mb-3 pt-0" id="alignBtnLeft" style="display: none;"><img src="<?= $image_path5 ?>" alt="izquierda"></a>
                            <a class="btn mt-0 mb-3 pt-0" id="alignBtnCenter" style="display: none;"><img src="<?= $image_path6 ?>" alt="centro"></a>
                            <a class="btn mt-0 mb-3 pt-0" id="alignBtnRight" style="display: none;"><img src="<?= $image_path7 ?>" alt="derecha"></a>
                            <a class="btn mt-0 mb-3 pt-0" id="alignBtnJustify" style="display: none;"><img src="<?= $image_path8 ?>" alt="justificar"></a>
                            <!-- <button class="btn mt-0 mb-3 pt-0 p1SideChange1" id="p1SideChange" style="display: none;"><img src="<?= $image_path14 ?>" alt="change"></button> -->
                        </div>

<<<<<<< HEAD
                    <p id="titleBoldOption">NEGRITA</p>
                        <div class="titleBoldOptionsCSS">
                            <input type="checkbox" id="titleBoldPicker" style="display: none;">
                            <label for="titleBoldPicker" id="titleBoldLabel">Titulo 1 en negritas</label>
                        </div>  
                        <div class="titleBoldOptionsCSS">
                            <input type="checkbox" id="titleBoldPicker2" style="display: none;" checked>
                            <label for="titleBoldPicker2" id="titleBoldLabel2">Titulo 2 en negritas</label>
                        </div>  
                        <div class="titleBoldOptionsCSS">
                            <input type="checkbox" id="titleBoldPicker3" style="display: none;">
                            <label for="titleBoldPicker3" id="titleBoldLabel3">Titulo 3 en negritas</label>
=======
                    <p id="titleBoldOption" data-i18n="customizeTemplate:elementBold">NEGRITA</p>
                        <div class="titleBoldOptionsCSS">
                            <input type="checkbox" id="titleBoldPicker" style="display: none;">
                            <label for="titleBoldPicker" id="titleBoldLabel" data-i18n="customizeTemplate:elementTitleBoldOne">Titulo 1 en negritas</label>
                        </div>  
                        <div class="titleBoldOptionsCSS">
                            <input type="checkbox" id="titleBoldPicker2" style="display: none;" checked>
                            <label for="titleBoldPicker2" id="titleBoldLabel2" data-i18n="customizeTemplate:elementTitleBoldTwo">Titulo 2 en negritas</label>
                        </div>  
                        <div class="titleBoldOptionsCSS">
                            <input type="checkbox" id="titleBoldPicker3" style="display: none;">
                            <label for="titleBoldPicker3" id="titleBoldLabel3" data-i18n="customizeTemplate:elementTitleBoldThree">Titulo 3 en negritas</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>  
                </div>

                <div class="mt-3" style="display: none; justify-content: space-between; align-items: center; margin-left: 10px;" id="p1ImgDiv">
<<<<<<< HEAD
                    <p id="p1ImgOption" style='margin: 0 0 0 0 !important;'>IMAGENES <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                    <p id="p1ImgOption" style='margin: 0 0 0 0 !important;'><span data-i18n="customizeTemplate:elementImages">IMAGENES</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                </div>
                <hr style="border-bottom: 1px solid black; display: none;" class="mt-0 mb-0" id="p1ImgSeparationLine">
                <div class="m-0 p-0" id="p1ImgOptions0" style="display: none;">
                <!-- Imagen de fondo -->
                <div class="mt-3 mb-0" id="p1BackgroundOptions" style="display: none; margin-left: 20px;">
                    <div class="mt-0" style="display: none; justify-content: start; align-items: center;" id="p1BackgroundDiv">
<<<<<<< HEAD
                        <p id="p1BackgroundOption" style="margin: 0;">FONDO </p>
=======
                        <p id="p1BackgroundOption" style="margin: 0;" data-i18n="customizeTemplate:elementBackground">FONDO</p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <input type="checkbox" id="p1BackgroundCheck" checked style="margin-left: 4mm;">
                    </div>
                </div>
                <!-- QR -->
                <div class="mt-3 mb-0" id="p1QROptions" style="display: none; margin-left: 20px;">
                    <div class="mt-0" style="display: none; justify-content: start; align-items: center;" id="p1QRDiv">
                        <p id="p1QROption" style="margin: 0;">QR </p>
                        <input type="checkbox" id="p1QRCheck" checked style="margin-left: 4mm;">
                    </div>
                </div>
                <!-- Imagen 01 -->
                <div class="mt-3 mb-0" id="p1ImgOptions" style="display: none; margin-left: 20px;">
                    <div class="mt-0" style="display: none; justify-content: space-between; align-items: center;" id="p1Img01Div">
<<<<<<< HEAD
                        <p id="p1Img01Option" style="margin: 0;">IMAGEN 01 </p>
=======
                        <p id="p1Img01Option" style="margin: 0;" data-i18n="customizeTemplate:elementImageOne">IMAGEN 01 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1" id="p1Img01BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                    </div>
                    <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0" id="p1Img01OSL">
                        <div class="p1ImgOptionsFlex" style="display: none; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img01DisplayLabel" class="disabled">VISIBILIDAD</label>
=======
                            <label style="display: none;" id="p1Img01DisplayLabel" class="disabled" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <input type="checkbox" id="p1Img01Display" checked style="display:none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="p1ImgOptionsFlex" style="display: none; align-items: center; margin-top: 8px;">
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img01AlignLeft" style="display: none;"><img src="<?= $image_path5 ?>" alt="izquierda"></a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img01AlignCenter" style="display: none;"><img src="<?= $image_path6 ?>" alt="centro"></a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img01AlignRight" style="display: none;"><img src="<?= $image_path7 ?>" alt="derecha"></a>
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img01AlignLabel" class="disabled">ALINEACIÓN</label>
=======
                            <label style="display: none;" id="p1Img01AlignLabel" class="disabled" data-i18n="customizeTemplate:elementAlineacion">ALINEACIÓN</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="p1ImgOptionsFlex" style="display: none; align-items: center; margin-top: 12px;">
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img01SizeSm" style="display: none; font-size: 12px;">sm</a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img01SizeMd" style="display: none; font-size: 12px;">md</a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img01SizeLg" style="display: none; font-size: 12px;">lg</a>
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img01SizeLabel" class="disabled">TAMAÑO</label>
=======
                            <label style="display: none;" id="p1Img01SizeLabel" class="disabled" data-i18n="customizeTemplate:elementSize">TAMAÑO</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="p1ImgOptionsFlex" style="display: none;">
                            <input type="file" name="imagenes[]" id="p1Img01FileInput" style="display:none; border: none;"></input>                        </div>
                </div> 
                <!-- Imagen 02 -->
                <div class="mt-3 mb-0" id="p1ImgOptions02" style="display: none; margin-left: 20px;">
                    <div class="mt-0" style="display: none; justify-content: space-between; align-items: center;" id="p1Img02Div">
<<<<<<< HEAD
                        <p id="p1Img02Option" style="margin: 0;">IMAGEN 02 </p>
=======
                        <p id="p1Img02Option" style="margin: 0;" data-i18n="customizeTemplate:elementImageTwo">IMAGEN 02 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1" id="p1Img02BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                    </div>
                    <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0" id="p1Img02OSL">
                        <div class="p1ImgOptionsFlex02" style="display: none; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img02DisplayLabel" class="disabled">VISIBILIDAD</label>
=======
                            <label style="display: none;" id="p1Img02DisplayLabel" class="disabled" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <input type="checkbox" id="p1Img02Display" checked style="display:none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="p1ImgOptionsFlex02" style="display: none; align-items: center; margin-top: 8px;">
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img02AlignUp1" style="display: none;"><img src="<?= $image_path9 ?>" alt=">"></a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img02AlignUp2" style="display: none;"><img src="<?= $image_path10 ?>" alt=">>"></a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img02AlignUp3" style="display: none;"><img src="<?= $image_path11 ?>" alt=">>>"></a>
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img02AlignLabel" class="disabled">ALINEACIÓN</label>
=======
                            <label style="display: none;" id="p1Img02AlignLabel" class="disabled" data-i18n="customizeTemplate:elementAlineacion">ALINEACIÓN</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="p1ImgOptionsFlex02" style="display: none; align-items: center; margin-top: 12px;">
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img02SizeSm" style="display: none; font-size: 12px;">sm</a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img02SizeMd" style="display: none; font-size: 12px;">md</a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img02SizeLg" style="display: none; font-size: 12px;">lg</a>
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img02SizeLabel" class="disabled">TAMAÑO</label>
=======
                            <label style="display: none;" id="p1Img02SizeLabel" class="disabled" data-i18n="customizeTemplate:elementSize">TAMAÑO</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="p1ImgOptionsFlex02" style="display: none;">
                            <input type="file" name="imagenes[]" id="p1Img02FileInput" style="display:none; border: none;"></input>
                        </div>
                </div>

                <!-- Imagen 03 -->
                <div class="mt-3 mb-0" id="p1ImgOptions03" style="display: none; margin-left: 20px;">
                    <div class="mt-0" style="display: none; justify-content: space-between; align-items: center;" id="p1Img03Div">
<<<<<<< HEAD
                        <p id="p1Img03Option" style="margin: 0;">IMAGEN 03 </p>
=======
                        <p id="p1Img03Option" style="margin: 0;" data-i18n="customizeTemplate:elementImageThree">IMAGEN 03 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1" id="p1Img03BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                    </div>
                    <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0" id="p1Img03OSL">
                        <div class="p1ImgOptionsFlex03" style="display: none; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img03DisplayLabel" class="disabled">VISIBILIDAD</label>
=======
                            <label style="display: none;" id="p1Img03DisplayLabel" class="disabled" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <input type="checkbox" id="p1Img03Display" checked style="display:none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="p1ImgOptionsFlex03" style="display: none; align-items: center; margin-top: 8px;">
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img03AlignUp1" style="display: none;"><img src="<?= $image_path9 ?>" alt=">"></a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img03AlignUp2" style="display: none;"><img src="<?= $image_path10 ?>" alt=">>"></a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img03AlignUp3" style="display: none;"><img src="<?= $image_path11 ?>" alt=">>>"></a>
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img03AlignLabel" class="disabled">ALINEACIÓN</label>
=======
                            <label style="display: none;" id="p1Img03AlignLabel" class="disabled" data-i18n="customizeTemplate:elementAlineacion">ALINEACIÓN</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="p1ImgOptionsFlex03" style="display: none; align-items: center; margin-top: 12px;">
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img03SizeSm" style="display: none; font-size: 12px;">sm</a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img03SizeMd" style="display: none; font-size: 12px;">md</a>
                            <a class="btn mt-0 mb-0 pt-0" id="p1Img03SizeLg" style="display: none; font-size: 12px;">lg</a>
<<<<<<< HEAD
                            <label style="display: none;" id="p1Img03SizeLabel" class="disabled">TAMAÑO</label>
=======
                            <label style="display: none;" id="p1Img03SizeLabel" class="disabled" data-i18n="customizeTemplate:elementSize">TAMAÑO</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="p1ImgOptionsFlex03" style="display: none;">
                            <input type="file" name="imagenes[]"  id="p1Img03FileInput" style="display:none; border: none;"></input>
                        </div>
                </div>

                <!-- fin opciones imagenes -->
                </div>
                <!-- footer -->
                <div class="mt-3" style="display: none; justify-content: space-between; align-items: center; margin-left: 10px;" id="p1FooterDiv">
<<<<<<< HEAD
                    <p id="p1FooterOption" style='margin: 0 0 0 0 !important;'>FOOTER <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                    <p id="p1FooterOption" style='margin: 0 0 0 0 !important;'><span data-i18n="customizeTemplate:elementFooterMayus">FOOTER</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1" id="p1FooterBtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none;" class="mt-0 mb-0" id="p1FooterSeparationLine">
                <!-- opciones footer -->
                <div class="mt-3 mb-0" id="p1FooterOptions" style="display: none; margin-left: 20px;">
<!--                     <p id="p1FooterDispositionOption" class="p1FooterOptionDesp">DISPOSICION</p>
                        <div class="p1FootersOptionsFlex" style="display: none; margin-top: -10px; align-items: center; margin-left: 15px; margin-bottom: 8px;">
                            <label style="display: none; padding-top: 5px;" class="disabled p1FooterDispLabel">LADO</label>
                            <button class="btn mt-0 mb-0 pt-0 pb-0 p1SideChange2" id="p1SideChange2" style="display: none;"><img src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/arrows.svg" alt="change"></button>
                        </div>
                        <div class="p1FootersOptionsFlex" style="display: none; align-items: center; margin-bottom: 7px; margin-left: 15px;">
                            <label style="display: none;" id="p1QRDisplayLabel" class="disabled p1FooterDispLabel">QR</label>
                            <input type="checkbox" id="p1QRDisplay" checked style="display:none; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
 -->
<<<<<<< HEAD
                    <p id="p1FooterTextOption" class="p1FooterOptionDesp">TEXTO</p>
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P1</label>
                        <textarea id="p1FooterTextPicker1" class="p1FooterTextOptionDesp" style="display: none; height: 67px;" minlength="0" maxlength="65">Todos los derechos reservados ® KALSTEIN France S. A. S.</textarea>
                        <p id="p1FooterCharCount1" class="p1FooterTextOptionDesp" style="display: none;">56 / 56 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P2</label>
                        <textarea id="p1FooterTextPicker2" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">2 Rue Jean Lantier •  75001 Paris •</textarea>
                        <p id="p1FooterCharCount2" class="p1FooterTextOptionDesp" style="display: none">35 / 50 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P3</label>
                        <textarea id="p1FooterTextPicker3" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">+33 1 78 95 87 89 / +33 6 80 76 07 10 •</textarea>
                        <p id="p1FooterCharCount3" class="p1FooterTextOptionDesp" style="display: none">39 / 50 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P4</label>
                        <textarea id="p1FooterTextPicker4" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">https://kalstein.eu</textarea>
                        <p id="p1FooterCharCount4" class="p1FooterTextOptionDesp" style="display: none">19 / 50 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P5</label>
                        <textarea id="p1FooterTextPicker5" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">KALSTEIN FRANCE, S. A. S</textarea>
                        <p id="p1FooterCharCount5" class="p1FooterTextOptionDesp" style="display: none">24 / 50 caracteres</p>
                        
                        <div style="display: flex; align-items: center;">
                            <a id="p1FooterTextSaveButton" class=" mt-0 mb-3 p1FooterTextOptionDesp" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn mt-0 mb-3 p1FooterTextOptionDesp" id="p1FooterTextBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>

                    <p id="p1FooterColorOption" class="p1FooterOptionDesp">COLOR</p>
                        <input type="color" id="p1FooterColorPicker" class="p1FooterColorOptionDesp" style="display: none;">
                        <p class="labelColorOption lb2 p1FooterColorOptionDesp" style="display: none; margin-bottom: 0px;">COLOR</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p1FooterColorSaveButton" class="btn my-3 p1FooterColorOptionDesp" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p1FooterTextOption" class="p1FooterOptionDesp" data-i18n="customizeTemplate:elementText">TEXTO</p>
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P1</label>
                        <textarea id="p1FooterTextPicker1" class="p1FooterTextOptionDesp" style="display: none; height: 67px;" minlength="0" maxlength="65" data-i18n="customizeTemplate:elementAllRightsReserved">Todos los derechos reservados ® KALSTEIN France S. A. S.</textarea>
                        <p id="p1FooterCharCount1" class="p1FooterTextOptionDesp" style="display: none;" data-i18n="customizeTemplate:elementCaracteresThree">56 / 56 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P2</label>
                        <textarea id="p1FooterTextPicker2" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">2 Rue Jean Lantier •  75001 Paris •</textarea>
                        <p id="p1FooterCharCount2" class="p1FooterTextOptionDesp" style="display: none" data-i18n="customizeTemplate:elementCaracteresFour">35 / 50 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P3</label>
                        <textarea id="p1FooterTextPicker3" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">+33 1 78 95 87 89 / +33 6 80 76 07 10 •</textarea>
                        <p id="p1FooterCharCount3" class="p1FooterTextOptionDesp" style="display: none" data-i18n="customizeTemplate:elementCaracteresFive">39 / 50 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P4</label>
                        <textarea id="p1FooterTextPicker4" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">https://kalstein.eu</textarea>
                        <p id="p1FooterCharCount4" class="p1FooterTextOptionDesp" style="display: none" data-i18n="customizeTemplate:elementCaracteresSix">19 / 50 caracteres</p>
                        
                        <label style="display: none;" class="disabled p1FooterTextOptionDesp">P5</label>
                        <textarea id="p1FooterTextPicker5" class="p1FooterTextOptionDesp" style="display: none; height: 43px;" minlength="0" maxlength="65">KALSTEIN FRANCE, S. A. S</textarea>
                        <p id="p1FooterCharCount5" class="p1FooterTextOptionDesp" style="display: none" data-i18n="customizeTemplate:elementCaracteresSeven">24 / 50 caracteres</p>
                        
                        <div style="display: flex; align-items: center;">
                            <a id="p1FooterTextSaveButton" class=" mt-0 mb-3 p1FooterTextOptionDesp" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
                            <a class="btn mt-0 mb-3 p1FooterTextOptionDesp" id="p1FooterTextBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>

                    <p id="p1FooterColorOption" class="p1FooterOptionDesp" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <input type="color" id="p1FooterColorPicker" class="p1FooterColorOptionDesp" style="display: none;">
                        <p class="labelColorOption lb2 p1FooterColorOptionDesp" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p1FooterColorSaveButton" class="btn my-3 p1FooterColorOptionDesp" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn my-3 p1FooterColorOptionDesp" id="p1FooterColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>

                    <!-- <p id="p1FooterFontOption" class="p1FooterOptionDesp">FUENTE</p>
                        <div style="overflow-x: auto; white-space: nowrap; max-height: 120px;">
                            <select id="p1FooterFontPicker" class="p1FooterFontOptionDesp" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <a id="p1FooterFontSaveButton" class="my-3 p1FooterFontOptionDesp" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-1 p1FooterFontOptionDesp" id="p1FooterFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->

<<<<<<< HEAD
                    <p id="p1FooterAlignOption" class="p1FooterOptionDesp">ALINEACIÓN</p>
=======
                    <p id="p1FooterAlignOption" class="p1FooterOptionDesp" data-i18n="customizeTemplate:elementAlineacion">ALINEACIÓN</p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <div style="display: flex; align-items: center;">
                            <a class="btn mt-0 mb-3 pt-0 p1FooterAlignOptionDesp" id="p1FooterAlignBtnLeft" style="display: none;"><img src="<?= $image_path5 ?>" alt="izquierda"></a>
                            <a class="btn mt-0 mb-3 pt-0 p1FooterAlignOptionDesp" id="p1FooterAlignBtnCenter" style="display: none;"><img src="<?= $image_path6 ?>" alt="centro"></a>
                            <a class="btn mt-0 mb-3 pt-0 p1FooterAlignOptionDesp" id="p1FooterAlignBtnRight" style="display: none;"><img src="<?= $image_path7 ?>" alt="derecha"></a>
                            <a class="btn mt-0 mb-3 pt-0 p1FooterAlignOptionDesp" id="p1FooterAlignBtnJustify" style="display: none;"><img src="<?= $image_path8 ?>" alt="justificar"></a>
                        </div>

<<<<<<< HEAD
                    <p id="p1FooterBoldOption" class="p1FooterOptionDesp">NEGRITAS</p>
                        <div class="titleBoldOptionsCSS" style="margin-top: -10px;">
                            <input type="checkbox" id="p1FooterBoldPicker" class="p1FooterBoldOptionDesp" style="display: none; margin-right: 5px;">
                            <label for="titleBoldPicker" id="p1FooterBoldLabel" class="p1FooterBoldOptionDesp" style="display:none;">texto en negritas</label>
=======
                    <p id="p1FooterBoldOption" class="p1FooterOptionDesp" data-i18n="customizeTemplate:elementBold">NEGRITA</p>
                        <div class="titleBoldOptionsCSS" style="margin-top: -10px;">
                            <input type="checkbox" id="p1FooterBoldPicker" class="p1FooterBoldOptionDesp" style="display: none; margin-right: 5px;">
                            <label for="titleBoldPicker" id="p1FooterBoldLabel" class="p1FooterBoldOptionDesp" style="display:none;" data-i18n="customizeTemplate:elementBoldText">texto en negritas</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>  
                </div>
            </div>
            <div class="col-1"></div>
        </div>

        <!-- OPCIONES PAGINA 2 -->
        <div class="row" style='background-color: #fff; border-bottom: 2px solid #E9E9EB;' id='pagina2Row'>
            <div class="col-1"></div>
            <div class="col-10" style='margin-top: 0.5rem; margin-bottom: 0.5rem;'>
            <div style="display: block; margin-bottom: 0.3rem !important; margin-top: 0.3rem!important;" id="pagina2Div">
<<<<<<< HEAD
                <p style='margin: 0 0 0 0 !important;'>OPCIONES PÁGINA 2</p>
=======
                <p style='margin: 0 0 0 0 !important;' data-i18n="customizeTemplate:elementPageOptionsTwo">OPCIONES PÁGINA 2</p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
            </div>
            <hr style="border-bottom: 1px solid black; display: none; width: 144px;" class="mt-0 mb-3 p2Desplg">

                <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p2ImgDiv">
<<<<<<< HEAD
                        <p id="p2ImgOption" class='p2Desplg' style=' display:none;margin: 0px;'>IMAGENES <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                        <p id="p2ImgOption" class='p2Desplg' style=' display:none;margin: 0px;'><span data-i18n="customizeTemplate:elementImages">IMAGENES</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1 p2ImgOptionsDesplg" id="p2ImgBtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; margin-top: -5px !important;" class="mt-0 mb-0 p2ImgOptionsDesplg">
                <div class="mt-3 mb-0 p2ImgOptionsDesplg" id="p2ImgOptions" style="display: none; margin-left: 20px;">
                    <div class="mt-0" style="display: flex; justify-content: space-between; align-items: center;" id="p2Img01Div">
<<<<<<< HEAD
                        <p id="p2Img01Option" class='p2ImgOptionsDesplg' style="margin: 0;">IMAGEN 01 </p>
=======
                        <p id="p2Img01Option" class='p2ImgOptionsDesplg' style="margin: 0;" data-i18n="customizeTemplate:elementImageOne">IMAGEN 01 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1 p2Img01OptionsDesplg" id="p2Img01BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                    </div>
                    <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0 p2Img01OptionsDesplg">
                        <div class="my-0" style="display: flex; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                            <label style="display: none; margin-top: 1rem;" class="disabled p2Img01OptionsDesplg">VISIBILIDAD</label>
=======
                            <label style="display: none; margin-top: 1rem;" class="disabled p2Img01OptionsDesplg" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <input type="checkbox" class="p2Img01OptionsDesplg" id="p2Img01Display" checked style="display:none; margin-top: 1rem; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="my-0" style="display: flex; align-items: center; margin-top: 12px;">
                            <a class="btn my-2 pt-0 p2Img01OptionsDesplg" id="p2Img01SizeSm" style="display: none; font-size: 12px;">sm</a>
                            <a class="btn my-2 pt-0 p2Img01OptionsDesplg" id="p2Img01SizeMd" style="display: none; font-size: 12px;">md</a>
                            <a class="btn my-2 pt-0 p2Img01OptionsDesplg" id="p2Img01SizeLg" style="display: none; font-size: 12px;">lg</a>
<<<<<<< HEAD
                            <label style="display: none;" class="disabled p2Img01OptionsDesplg">TAMAÑO</label>
=======
                            <label style="display: none;" class="disabled p2Img01OptionsDesplg" data-i18n="customizeTemplate:elementSize">TAMAÑO</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        </div>
                        <div class="my-0" style="display: flex;">
                            <input type="file" name="imagenes[]"  class="p2Img01OptionsDesplg" id="p2Img01FileInput" style="display:none; border: none;padding-top: 0px;"></input>
                        </div>

                    <div class="mt-0" style="display: flex; justify-content: space-between; align-items: center;" id="p2Img02Div">
<<<<<<< HEAD
                        <p id="p2Img02Option" class='p2ImgOptionsDesplg' style="margin: 0; margin-top: 1em;">IMAGEN 02 </p>
=======
                        <p id="p2Img02Option" class='p2ImgOptionsDesplg' style="margin: 0; margin-top: 1em;" data-i18n="customizeTemplate:elementImageTwo">IMAGEN 02 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1 p2Img02OptionsDesplg" id="p2Img02BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                    </div>
                    <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0 p2Img02OptionsDesplg">
                        <div class="my-0" style="display: flex; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                            <label style="display: none; margin-top: 1rem;" class="disabled p2Img02OptionsDesplg">VISIBILIDAD</label>
=======
                            <label style="display: none; margin-top: 1rem;" class="disabled p2Img02OptionsDesplg" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <input type="checkbox" class="p2Img02OptionsDesplg" id="p2Img02Display" checked style="display:none; margin-top: 1rem; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="my-0" style="display: flex;">
                            <input type="file" name="imagenes[]"  class="p2Img02OptionsDesplg" id="p2Img02FileInput" style="display:none; border: none;"></input>
                        </div>
                    
                    <div class="mt-0" style="display: flex; justify-content: space-between; align-items: center;" id="p2Img03Div">
<<<<<<< HEAD
                        <p id="p2Img03Option" class='p2ImgOptionsDesplg' style="margin: 0; margin-top: 1em;">IMAGEN 03 </p>
=======
                        <p id="p2Img03Option" class='p2ImgOptionsDesplg' style="margin: 0; margin-top: 1em;" data-i18n="customizeTemplate:elementImageThree">IMAGEN 03 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1 p2Img03OptionsDesplg" id="p2Img03BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                    </div>
                    <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0 p2Img03OptionsDesplg">
                        <div class="my-0" style="display: flex; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                            <label style="display: none; margin-top: 1rem;" class="disabled p2Img03OptionsDesplg">VISIBILIDAD</label>
=======
                            <label style="display: none; margin-top: 1rem;" class="disabled p2Img03OptionsDesplg" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <input type="checkbox" class="p2Img03OptionsDesplg" id="p2Img03Display" checked style="display:none; margin-top: 1rem; margin-left: 3mm; margin-bottom: 2px !important;">
                        </div>
                        <div class="my-0" style="display: flex;">
                            <input type="file" name="imagenes[]"  class="p2Img03OptionsDesplg" id="p2Img03FileInput" style="display:none; border: none;"></input>
                        </div>
                </div> 

                <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p2TableDiv">
<<<<<<< HEAD
                        <p id="p2TableOption" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'>TABLA <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                        <p id="p2TableOption" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'><span data-i18n="customizeTemplate:elementTableMayus">TABLA</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1 p2TableOptionsDesplg" id="p2TableBtnClearG" style="display: none; margin-bottom: -6px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; margin-top: 2px !important;" class="mt-0 mb-0 p2TableOptionsDesplg">
                <div class="mt-3 mb-0 p2TableOptionsDesplg" style="display: none; margin-left: 20px;">
<<<<<<< HEAD
                    <p id="p2TableColorOption">COLOR</p>
                        <input type="color" id="p2TableColorPicker" class="p2TableColorDesplg" style="display: none;" value='#ffffff'>
                        <p class="lb2 p2TableColorDesplg" style="display: none; margin-bottom: 0px;">LETRAS</p>
                        <input type="color" id="p2TableColorPicker2" class="p2TableColorDesplg" style="display: none;" value='#213280'>
                        <p class="lb2 p2TableColorDesplg" style="display: none; margin-bottom: 0px;">FONDO</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2TableColorSaveButton" class="my-3 p2TableColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p2TableColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <input type="color" id="p2TableColorPicker" class="p2TableColorDesplg" style="display: none;" value='#ffffff'>
                        <p class="lb2 p2TableColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementLetters">LETRAS</p>
                        <input type="color" id="p2TableColorPicker2" class="p2TableColorDesplg" style="display: none;" value='#213280'>
                        <p class="lb2 p2TableColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementBackground">FONDO</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2TableColorSaveButton" class="my-3 p2TableColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn my-3 p2TableColorDesplg" id="p2TableColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>
                    <!-- <p id="p2TableFontOption" style='margin-bottom: 0px;'>FUENTE</p>
                        <div style="margin-top: 1em;white-space: nowrap; max-height: 120px;">
                            <select class='p2TableFontDesplg' id="p2TableFontPicker1" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="lb2 p2TableFontDesplg" style="display: none;">Título</p>
                            <select class='p2TableFontDesplg' id="p2TableFontPicker2" style="display: none;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="lb2 p2TableFontDesplg" style="display: none;">Cuerpo</p>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <a id="p2TableFontSaveButton" class="my-3 p2TableFontDesplg" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-3 p2TableFontDesplg" id="p2TableFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->
                </div>

                <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p2BillDiv">
<<<<<<< HEAD
                        <p id="p2BillOption" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'>FACTURA <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                        <p id="p2BillOption" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'><span data-i18n="customizeTemplate:elementFactureMayus">FACTURA</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                        <a class="btn my-1 p2BillOptionsDesplg" id="p2BillBtnClearG" style="display: none;margin-bottom: -10px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; margin-top: 5px !important;" class="mt-0 mb-0 p2BillOptionsDesplg">
                <div class="mt-3 mb-0 p2BillOptionsDesplg" style="display: none; margin-left: 20px;">
<<<<<<< HEAD
                    <p id="p2BillColorOption">COLOR</p>
                        <input type="color" id="p2BillColorPicker" class="p2BillColorDesplg" style="display: none;" value='#333333'>
                        <p class="lb2 p2BillColorDesplg" style="display: none; margin-bottom: 0px;">LETRAS</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2BillColorSaveButton" class="my-3 p2BillColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p2BillColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <input type="color" id="p2BillColorPicker" class="p2BillColorDesplg" style="display: none;" value='#333333'>
                        <p class="lb2 p2BillColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementLetters">LETRAS</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2BillColorSaveButton" class="my-3 p2BillColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn my-3 p2BillColorDesplg" id="p2BillColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>
                    <!-- <p id="p2BillFontOption" class='mb-0'>FUENTE</p>
                        <div style="overflow-x: auto; white-space: nowrap; max-height: 120px;">
                            <select class='p2BillFontDesplg' id="p2BillFontPicker" style="display: none;margin-top: 1rem;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                            </select>
                            <p class="lb2 p2BillFontDesplg" style="display: none;">Cuerpo</p>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <a id="p2BillFontSaveButton" class="my-3 p2BillFontDesplg" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-3 p2BillFontDesplg" id="p2BillFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->
                </div>

                <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p2FooterDiv">
<<<<<<< HEAD
                    <p id="p2FooterOption" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'>PIE DE PÁGINA 1<img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                    <p id="p2FooterOption" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'><span data-i18n="customizeTemplate:elementFooterOne">PIE DE PÁGINA 1</span><img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1 p2FooterOptionsDesplg" id="p2FooterBtnClearG" style="display: none; margin-bottom: -6px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; margin-top: 2px !important;" class="mt-0 mb-0 p2FooterOptionsDesplg">
                <div class="mt-3 mb-0 p2FooterOptionsDesplg" style="display: none; margin-left: 20px;">
<<<<<<< HEAD
                    <p id="p2FooterColorOption">COLOR</p>
                        <input type="color" id="p2FooterColorPicker" class="p2FooterColorDesplg" style="display: none;" value='#ffffff'>
                        <p class="lb2 p2FooterColorDesplg" style="display: none; margin-bottom: 0px;">LETRAS</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2FooterColorSaveButton" class="my-3 p2FooterColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p2FooterColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <input type="color" id="p2FooterColorPicker" class="p2FooterColorDesplg" style="display: none;" value='#ffffff'>
                        <p class="lb2 p2FooterColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementLetters">LETRAS</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2FooterColorSaveButton" class="my-3 p2FooterColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn my-3 p2FooterColorDesplg" id="p2FooterColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>
                        
                    <!-- <p id="p2FooterFontOption">FUENTE</p>

                        <select class='p2FooterFontDesplg' id="p2FooterFontPicker" style="display: none;margin-top: 1em;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                        </select>
                        <p class="lb2 p2FooterFontDesplg" style="display: none;">Título</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2FooterFontSaveButton" class="my-3 p2FooterFontDesplg" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-3 p2FooterFontDesplg" id="p2FooterFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->

<<<<<<< HEAD
                    <p id="p2FooterTextOption">TEXTO</p>

                    <label style="display: none;" class="disabled p2FooterTextDesplg">Título 1</label>
                        <textarea id="p2FooterTextPicker1" class="p2FooterTextDesplg" style="display: none; height: 60px;" maxlength="45">Marcado CE: para comprar con tranquilidad</textarea>
                        <p id="p2FooterTextCharCount1" class="p2FooterTextDesplg" style="display: none">41 / 45 caracteres</p>

                        <label style="display: none;" class="disabled p2FooterTextDesplg">PÁRRAFO 1</label>
                        <textarea id="p2FooterTextPicker2" class="p2FooterTextDesplg" style="display: none;height: 100px;" maxlength="111">Todos los equipos Kalstein cumplen los requisitos de la UE, de acuerdo con la normativa pertinente.</textarea>
                        <p id="p2FooterTextCharCount2" class="p2FooterTextDesplg" style="display: none">99 / 111 caracteres</p>

                        <label style="display: none;" class="disabled p2FooterTextDesplg">Título 2</label>
                        <textarea id="p2FooterTextPicker3" class="p2FooterTextDesplg" style="display: none; height: 60px;" maxlength="45">Con la adquisición de un equipo Kalstein</textarea>
                        <p id="p2FooterTextCharCount3" class="p2FooterTextDesplg" style="display: none">40 / 45 caracteres</p>

                        <label style="display: none;" class="disabled p2FooterTextDesplg">PÁRRAFO 2</label>
                        <textarea id="p2FooterTextPicker4" class="p2FooterTextDesplg" style="display: none;height: 100px;" maxlength="111">Realizas una aportación a la Fundación Jacinto Convit, OneTreePlanted, Fundación Humatem y Fundación Maniapure.</textarea>
                        <p id="p2FooterTextCharCount4" class="p2FooterTextDesplg" style="display: none">111 / 111 caracteres</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2FooterTextSaveButton" class="p2FooterTextDesplg mt-0 mb-3" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p2FooterTextOption" data-i18n="customizeTemplate:elementText">TEXTO</p>

                    <label style="display: none;" class="disabled p2FooterTextDesplg" data-i18n="customizeTemplate:elementTitleOne">Título 1</label>
                        <textarea id="p2FooterTextPicker1" class="p2FooterTextDesplg" style="display: none; height: 60px;" maxlength="45" data-i18n="customizeTemplate:elementMercadoCE">Marcado CE: para comprar con tranquilidad</textarea>
                        <p id="p2FooterTextCharCount1" class="p2FooterTextDesplg" style="display: none">41 / 45 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>

                        <label style="display: none;" class="disabled p2FooterTextDesplg" data-i18n="customizeTemplate:elementParagraphOne">PÁRRAFO 1</label>
                        <textarea id="p2FooterTextPicker2" class="p2FooterTextDesplg" style="display: none;height: 100px;" maxlength="111" data-i18n="customizeTemplate:elementEveryEquip">Todos los equipos Kalstein cumplen los requisitos de la UE, de acuerdo con la normativa pertinente.</textarea>
                        <p id="p2FooterTextCharCount2" class="p2FooterTextDesplg" style="display: none">99 / 111 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>

                        <label style="display: none;" class="disabled p2FooterTextDesplg" data-i18n="customizeTemplate:elementTitleTwo">Título 2</label>
                        <textarea id="p2FooterTextPicker3" class="p2FooterTextDesplg" style="display: none; height: 60px;" maxlength="45" data-i18n="customizeTemplate:elementWithAdqEquip">Con la adquisición de un equipo Kalstein</textarea>
                        <p id="p2FooterTextCharCount3" class="p2FooterTextDesplg" style="display: none">40 / 45 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>

                        <label style="display: none;" class="disabled p2FooterTextDesplg" data-i18n="customizeTemplate:elementParagraphTwo">PÁRRAFO 2</label>
                        <textarea id="p2FooterTextPicker4" class="p2FooterTextDesplg" style="display: none;height: 100px;" maxlength="111" data-i18n="customizeTemplate:elementAporteFundac">Realizas un aporte a la Fundación Jacinto Convit, OneTreePlanted, Fundación Humatem y Fundación Maniapure.</textarea>
                        <p id="p2FooterTextCharCount4" class="p2FooterTextDesplg" style="display: none">111 / 111 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2FooterTextSaveButton" class="p2FooterTextDesplg mt-0 mb-3" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn mt-0 mb-3 p2FooterTextDesplg" id="p2FooterTextBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>
                </div>

                <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p2Footer2Div">
<<<<<<< HEAD
                    <p id="p2Footer2Option" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'>PIE DE PÁGINA 2<img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                    <p id="p2Footer2Option" class='p2Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'><span data-i18n="customizeTemplate:elementFooterTwo">PIE DE PÁGINA 2</span><img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1 p2Footer2OptionsDesplg" id="p2Footer2BtnClearG" style="display: none; margin-bottom: -6px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; margin-top: 2px !important;" class="mt-0 mb-0 p2Footer2OptionsDesplg">
                <div class="mt-3 mb-0 p2Footer2OptionsDesplg" style="display: none; margin-left: 20px;">
<<<<<<< HEAD
                    <p id="p2Footer2ColorOption">COLOR</p>
                        <input type="color" id="p2Footer2ColorPicker" class="p2Footer2ColorDesplg" style="display: none;" value='#ffffff'>
                        <p class="lb2 p2Footer2ColorDesplg" style="display: none; margin-bottom: 0px;">LETRAS</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2Footer2ColorSaveButton" class="my-3 p2Footer2ColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p2Footer2ColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                        <input type="color" id="p2Footer2ColorPicker" class="p2Footer2ColorDesplg" style="display: none;" value='#ffffff'>
                        <p class="lb2 p2Footer2ColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementLetters">LETRAS</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2Footer2ColorSaveButton" class="my-3 p2Footer2ColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn my-3 p2Footer2ColorDesplg" id="p2Footer2ColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>
                        
                   <!--  <p id="p2Footer2FontOption">FUENTE</p>

                        <select class='p2Footer2FontDesplg' id="p2Footer2FontPicker" style="display: none;margin-top: 1em;">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Palatino Linotype, serif">Palatino Linotype</option>
                                <option value="Garamond, serif">Garamond</option>
                                <option value="Bookman Old Style, serif">Bookman Old Style</option>
                                <option value="Lucida Bright, serif">Lucida Bright</option>
                                <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                                <option value="Impact, fantasy">Impact</option>
                                <option value="Lucida Console, monospace">Lucida Console</option>
                                <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                                <option value="MS Serif, serif">MS Serif</option>
                        </select>
                        <p class="lb2 p2Footer2FontDesplg" style="display: none;">Fuente</p>
                        <div style="display: flex; align-items: center;">
                            <a id="p2Footer2FontSaveButton" class="my-3 p2Footer2FontDesplg" style="margin-right: 10px; display: none;">Guardar</a>
                            <a class="btn my-3 p2Footer2FontDesplg" id="p2Footer2FontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div> -->

<<<<<<< HEAD
                    <p id="p2Footer2TextOption">TEXTO</p>

                        <label style="display: none;" class="disabled p2Footer2TextDesplg">PÁRRAFO 1</label>
                        <textarea id="p2Footer2TextPicker1" class="p2Footer2TextDesplg" style="display: none;height: 43px;" maxlength="46">KALSTEIN FRANCE S.A.S</textarea>
                        <p id="p2Footer2TextCharCount1" class="p2Footer2TextDesplg" style="display: none">21 / 46 caracteres</p>

                        <label style="display: none;" class="disabled p2Footer2TextDesplg">PÁRRAFO 2</label>
                        <textarea id="p2Footer2TextPicker2" class="p2Footer2TextDesplg" style="display: none;height: 43px;" maxlength="54">• 2 Rue Jean Lantier, • 75001 Paris •</textarea>
                        <p id="p2Footer2TextCharCount2" class="p2Footer2TextDesplg" style="display: none">37 / 54 caracteres</p>

                        <label style="display: none;" class="disabled p2Footer2TextDesplg">PÁRRAFO 3</label>
                        <textarea id="p2Footer2TextPicker3" class="p2Footer2TextDesplg" style="display: none;height: 64px;" maxlength="63">+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://kalstein.eu</textarea>
                        <p id="p2Footer2TextCharCount3" class="p2Footer2TextDesplg" style="display: none">59 / 63 caracteres</p>

                        <div style="display: flex; align-items: center;">
                            <a id="p2Footer2TextSaveButton" class="p2Footer2TextDesplg mt-0 mb-3" style="margin-right: 10px; display: none;">Guardar</a>
=======
                    <p id="p2Footer2TextOption" data-i18n="customizeTemplate:elementText">TEXTO</p>

                        <label style="display: none;" class="disabled p2Footer2TextDesplg" data-i18n="customizeTemplate:elementParagraphOne">PÁRRAFO 1</label>
                        <textarea id="p2Footer2TextPicker1" class="p2Footer2TextDesplg" style="display: none;height: 43px;" maxlength="46">KALSTEIN FRANCE S.A.S</textarea>
                        <p id="p2Footer2TextCharCount1" class="p2Footer2TextDesplg" style="display: none">21 / 46 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>

                        <label style="display: none;" class="disabled p2Footer2TextDesplg" data-i18n="customizeTemplate:elementParagraphTwo">PÁRRAFO 2</label>
                        <textarea id="p2Footer2TextPicker2" class="p2Footer2TextDesplg" style="display: none;height: 43px;" maxlength="54">• 2 Rue Jean Lantier, • 75001 Paris •</textarea>
                        <p id="p2Footer2TextCharCount2" class="p2Footer2TextDesplg" style="display: none">37 / 54 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>

                        <label style="display: none;" class="disabled p2Footer2TextDesplg" data-i18n="customizeTemplate:elementParagraphThree">PÁRRAFO 3</label>
                        <textarea id="p2Footer2TextPicker3" class="p2Footer2TextDesplg" style="display: none;height: 64px;" maxlength="63">+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://kalstein.eu</textarea>
                        <p id="p2Footer2TextCharCount3" class="p2Footer2TextDesplg" style="display: none">59 / 63 <span data-i18n="customizeTemplate:elementAllCaracteres">caracteres</span></p>

                        <div style="display: flex; align-items: center;">
                            <a id="p2Footer2TextSaveButton" class="p2Footer2TextDesplg mt-0 mb-3" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                            <a class="btn mt-0 mb-3 p2Footer2TextDesplg" id="p2Footer2TextBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                        </div>
                </div>

            <!-- FIN OP P2 -->
            </div>
            <div class="col-1"></div>
        </div>
        
        <!-- OPCIONES PAGINA 3 -->
        <div class="row" style='background-color: #fff; border-bottom: 2px solid #E9E9EB;' id='pagina3Row'>
            <div class="col-1"></div>
            <div class="col-10" style='margin-top: 0.5rem; margin-bottom: 0.5rem;'>
            <div style="display: block; margin-bottom: 0.3rem !important; margin-top: 0.3rem!important;" id="pagina3Div">
<<<<<<< HEAD
                <p style='margin: 0 0 0 0 !important;'>OPCIONES PÁGINA 3</p>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; width: 144px;" class="mt-0 mb-3 p3Desplg">
            <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p3ImgDiv">
                <p id="p3ImgOption" class='p3Desplg' style=' display:none;margin: 0px;'>IMAGENES <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                <p style='margin: 0 0 0 0 !important;' data-i18n="customizeTemplate:elementPageOptionsThree">OPCIONES PÁGINA 3</p>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; width: 144px;" class="mt-0 mb-3 p3Desplg">
            <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p3ImgDiv">
                <p id="p3ImgOption" class='p3Desplg' style=' display:none;margin: 0px;'><span data-i18n="customizeTemplate:elementImages">IMAGENES</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                <a class="btn my-1 p3ImgOptionsDesplg" id="p3ImgBtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; margin-top: -5px !important;" class="mt-0 mb-0 p3ImgOptionsDesplg">
            <div class="mt-3 mb-0 p3ImgOptionsDesplg" id="p3ImgOptions" style="display: none; margin-left: 20px;">
                <div class="mt-0" style="display: flex; justify-content: space-between; align-items: center;" id="p3Img01Div">
<<<<<<< HEAD
                    <p id="p3Img01Option" class='p3ImgOptionsDesplg' style="margin: 0;">IMAGEN 01 </p>
=======
                    <p id="p3Img01Option" class='p3ImgOptionsDesplg' style="margin: 0;" data-i18n="customizeTemplate:elementImageOne">IMAGEN 01 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1 p3Img01OptionsDesplg" id="p3Img01BtnClearG" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; width: 239px;" class="mt-0 mb-0 p3Img01OptionsDesplg">
                <div class="my-0" style="display: flex; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                    <label style="display: none; margin-top: 1rem;" class="disabled p3Img01OptionsDesplg">VISIBILIDAD</label>
=======
                    <label style="display: none; margin-top: 1rem;" class="disabled p3Img01OptionsDesplg" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <input type="checkbox" class="p3Img01OptionsDesplg" id="p3Img01Display" checked style="display:none; margin-top: 1rem; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
                <div class="my-0" style="display: flex; align-items: center; margin-top: 12px;">
                    <a class="btn my-2 pt-0 p3Img01OptionsDesplg" id="p3Img01SizeSm" style="display: none; font-size: 12px;">sm</a>
                    <a class="btn my-2 pt-0 p3Img01OptionsDesplg" id="p3Img01SizeMd" style="display: none; font-size: 12px;">md</a>
                    <a class="btn my-2 pt-0 p3Img01OptionsDesplg" id="p3Img01SizeLg" style="display: none; font-size: 12px;">lg</a>
<<<<<<< HEAD
                    <label style="display: none;" class="disabled p3Img01OptionsDesplg">TAMAÑO</label>
=======
                    <label style="display: none;" class="disabled p3Img01OptionsDesplg" data-i18n="customizeTemplate:elementSize">TAMAÑO</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                </div>
                <div class="my-0" style="display: flex;">
                    <input type="file" name="imagenes[]"  class="p3Img01OptionsDesplg" id="p3Img01FileInput" style="display:none; border: none;padding-top: 0px;"></input>
                </div>

                <div class="mt-0" style="display: flex; justify-content: space-between; align-items: center;" id="p3Img02Div">
<<<<<<< HEAD
                    <p id="p3Img02Option" class='p3ImgOptionsDesplg' style="margin: 0; margin-top: 1em;">IMAGEN 02 </p>
=======
                    <p id="p3Img02Option" class='p3ImgOptionsDesplg' style="margin: 0; margin-top: 1em;" data-i18n="customizeTemplate:elementImageTwo">IMAGEN 02 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1 p3Img02OptionsDesplg" id="p3Img02BtnClearG" style="display: none; margin-bottom: 0px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; width: 239px; margin-top: 5px !important;" class="mb-0 p3Img02OptionsDesplg">
                <div class="my-0" style="display: flex; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                    <label style="display: none; margin-top: 1rem;" class="disabled p3Img02OptionsDesplg">VISIBILIDAD</label>
=======
                    <label style="display: none; margin-top: 1rem;" class="disabled p3Img02OptionsDesplg" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <input type="checkbox" class="p3Img02OptionsDesplg" id="p3Img02Display" checked style="display:none; margin-top: 1rem; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
                <div class="my-0" style="display: flex;">
                    <input type="file" name="imagenes[]"  class="p3Img02OptionsDesplg" id="p3Img02FileInput" style="display:none; border: none;"></input>
                </div>

                <div class="mt-0" style="display: flex; justify-content: space-between; align-items: center;" id="p3Img03Div">
<<<<<<< HEAD
                    <p id="p3Img03Option" class='p3ImgOptionsDesplg' style="margin: 0; margin-top: 1em;">IMAGEN 03 </p>
=======
                    <p id="p3Img03Option" class='p3ImgOptionsDesplg' style="margin: 0; margin-top: 1em;" data-i18n="customizeTemplate:elementImageThree">IMAGEN 03 </p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-1 p3Img03OptionsDesplg" id="p3Img03BtnClearG" style="display: none; margin-bottom: 0px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                <hr style="border-bottom: 1px solid black; display: none; width: 239px; margin-top: 5px !important;" class="mb-0 p3Img03OptionsDesplg">
                <div class="my-0" style="display: flex; align-items: center; margin-top: 14px; margin-left: 15px;">
<<<<<<< HEAD
                    <label style="display: none; margin-top: 1rem;" class="disabled p3Img03OptionsDesplg">VISIBILIDAD</label>
=======
                    <label style="display: none; margin-top: 1rem;" class="disabled p3Img03OptionsDesplg" data-i18n="customizeTemplate:elementVisibility">VISIBILIDAD</label>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <input type="checkbox" class="p3Img03OptionsDesplg" id="p3Img03Display" checked style="display:none; margin-top: 1rem; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
                <div class="my-0" style="display: flex;">
                    <input type="file" name="imagenes[]"  class="p3Img03OptionsDesplg" id="p3Img03FileInput" style="display:none; border: none;"></input>
                </div>
            </div>

<!--             <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p3DspDiv">
                <p id="p3DspOption" class='p3Desplg' style=' display:none;margin: 0px; margin-top: 1em;'>DISPOSICION <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
                <button class="btn my-1 p3DspOptionsDesplg" id="p3DspBtnClearG" style="display: none; margin-bottom: -5px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></button>
            </div>
            <hr style="border-bottom: 1px solid black; display: none;  margin-top: 5px !important;" class="mt-0 mb-0 p3DspOptionsDesplg">
            <div class="mt-3 mb-0 p3DspOptionsDesplg" id="p3DspOptions" style="display: none; margin-left: 20px;">

                <div class="my-0" style="display: flex; align-items: center;">
                    <label style="display: none; padding-top: 5px;" class="disabled p3DspOptionsDesplg">ENCABEZADO </label>
                    <button class="btn mt-0 mb-0 pt-0 pb-0 p3DspOptionsDesplg" id="p3SideChange1" style="display: none;"><img src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/arrows.svg" alt="change"></button>
                </div>
                <div class="my-0" style="display: flex; align-items: center;">
                    <label style="display: none; padding-top: 5px;" class="disabled p3DspOptionsDesplg">BODY </label>
                    <button class="btn mt-0 mb-0 pt-0 pb-0 p3DspOptionsDesplg" id="p3SideChange2" style="display: none;"><img src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/svg/arrows.svg" alt="change"></button>
                </div>

            </div> -->

            <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p3TituloDiv">
<<<<<<< HEAD
                <p id="p3TitleOption" class='p3Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'>TITULO <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                <p id="p3TitleOption" class='p3Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;' data-i18n="customizeTemplate:elementTitleMayus">TITULO <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                <a class="btn my-1 p3TitleOptionsDesplg" id="p3TitleBtnClearG" style="display: none; margin-bottom: -6px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; margin-top: 2px !important;" class="mt-0 mb-0 p3TitleOptionsDesplg">
            <div class="mt-3 mb-0 p3TitleOptionsDesplg" style="display: none; margin-left: 20px;">
<<<<<<< HEAD
                <p id="p3TitleColorOption">COLOR</p>
                <input type="color" id="p3TitleColorPicker" class="p3TitleColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3TitleColorDesplg" style="display: none; margin-bottom: 0px;">LETRAS</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3TitleColorSaveButton" class="my-3 p3TitleColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
                <p id="p3TitleColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                <input type="color" id="p3TitleColorPicker" class="p3TitleColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3TitleColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementLetters">LETRAS</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3TitleColorSaveButton" class="my-3 p3TitleColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-3 p3TitleColorDesplg" id="p3TitleColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                
                <!-- <p id="p3TitleFontOption">FUENTE</p>
                    <select class='p3TitleFontDesplg' id="p3TitleFontPicker" style="display: none;margin-top: 1em;">
                            <option value="Arial, sans-serif">Arial</option>
                            <option value="Times New Roman, serif">Times New Roman</option>
                            <option value="Verdana, sans-serif">Verdana</option>
                            <option value="Courier New, monospace">Courier New</option>
                            <option value="Georgia, serif">Georgia</option>
                            <option value="Palatino Linotype, serif">Palatino Linotype</option>
                            <option value="Garamond, serif">Garamond</option>
                            <option value="Bookman Old Style, serif">Bookman Old Style</option>
                            <option value="Lucida Bright, serif">Lucida Bright</option>
                            <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                            <option value="Impact, fantasy">Impact</option>
                            <option value="Lucida Console, monospace">Lucida Console</option>
                            <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                            <option value="Tahoma, sans-serif">Tahoma</option>
                            <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                            <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                            <option value="MS Serif, serif">MS Serif</option>
                    </select>
                <p class="lb2 p3TitleFontDesplg" style="display: none;">Fuente</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3TitleFontSaveButton" class="my-3 p3TitleFontDesplg" style="margin-right: 10px; display: none;">Guardar</a>
                    <a class="btn my-3 p3TitleFontDesplg" id="p3TitleFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div> -->

            </div>

            <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p3TextDiv">
<<<<<<< HEAD
                <p id="p3TextOption" class='p3Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;'>CUERPO <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                <p id="p3TextOption" class='p3Desplg' style=' display:none;margin: 0px;margin-top: 1rem !important;' ><span data-i18n="customizeTemplate:elementBodyMayus">CUERPO</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                <a class="btn my-1 p3TextOptionsDesplg" id="p3TextBtnClearG" style="display: none; margin-bottom: -6px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
            </div>
            <hr style="border-bottom: 1px solid black; display: none; margin-top: 2px !important;" class="mt-0 mb-0 p3TextOptionsDesplg">
            <div class="mt-3 mb-0 p3TextOptionsDesplg" style="display: none; margin-left: 20px;">
<<<<<<< HEAD
                <p id="p3TextColorOption">COLOR</p>
                <input type="color" id="p3TextColorPicker1" class="p3TextColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3TextColorDesplg" style="display: none; margin-bottom: 0px;">Subtitulos</p>
                <input type="color" id="p3TextColorPicker2" class="p3TextColorDesplg" style="display: none;" value='#000000'>
                <p class="lb2 p3TextColorDesplg" style="display: none; margin-bottom: 0px;">Parrafos</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3TextColorSaveButton" class="my-3 p3TextColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
                <p id="p3TextColorOption" data-i18n="customizeTemplate:elementColor">COLOR</p>
                <input type="color" id="p3TextColorPicker1" class="p3TextColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3TextColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementSubtitle">Subtitulos</p>
                <input type="color" id="p3TextColorPicker2" class="p3TextColorDesplg" style="display: none;" value='#000000'>
                <p class="lb2 p3TextColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementParagraph">Parrafos</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3TextColorSaveButton" class="my-3 p3TextColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-3 p3TextColorDesplg" id="p3TextColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>
                
                <!-- <p id="p3TextFontOption">FUENTE</p>
                <select class='p3TextFontDesplg' id="p3TextFontPicker1" style="display: none;margin-top: 1em;">
                    <option value="Arial, sans-serif">Arial</option>
                    <option value="Times New Roman, serif">Times New Roman</option>
                    <option value="Verdana, sans-serif">Verdana</option>
                    <option value="Courier New, monospace">Courier New</option>
                    <option value="Georgia, serif">Georgia</option>
                    <option value="Palatino Linotype, serif">Palatino Linotype</option>
                    <option value="Garamond, serif">Garamond</option>
                    <option value="Bookman Old Style, serif">Bookman Old Style</option>
                    <option value="Lucida Bright, serif">Lucida Bright</option>
                    <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                    <option value="Impact, fantasy">Impact</option>
                    <option value="Lucida Console, monospace">Lucida Console</option>
                    <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                    <option value="Tahoma, sans-serif">Tahoma</option>
                    <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                    <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                    <option value="MS Serif, serif">MS Serif</option>
                </select>
                <p class="lb2 p3TextFontDesplg" style="display: none;">Subtitulos</p>
                <select class='p3TextFontDesplg' id="p3TextFontPicker2" style="display: none;margin-top: 1em;">
                    <option value="Arial, sans-serif">Arial</option>
                    <option value="Times New Roman, serif">Times New Roman</option>
                    <option value="Verdana, sans-serif">Verdana</option>
                    <option value="Courier New, monospace">Courier New</option>
                    <option value="Georgia, serif">Georgia</option>
                    <option value="Palatino Linotype, serif">Palatino Linotype</option>
                    <option value="Garamond, serif">Garamond</option>
                    <option value="Bookman Old Style, serif">Bookman Old Style</option>
                    <option value="Lucida Bright, serif">Lucida Bright</option>
                    <option value="Comic Sans MS, cursive">Comic Sans MS</option>
                    <option value="Impact, fantasy">Impact</option>
                    <option value="Lucida Console, monospace">Lucida Console</option>
                    <option value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                    <option value="Tahoma, sans-serif">Tahoma</option>
                    <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                    <option value="MS Sans Serif, sans-serif">MS Sans Serif</option>
                    <option value="MS Serif, serif">MS Serif</option>
                </select>
                <p class="lb2 p3TextFontDesplg" style="display: none;">Parrafos</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3TextFontSaveButton" class="my-3 p3TextFontDesplg" style="margin-right: 10px; display: none;">Guardar</a>
                    <a class="btn my-3 p3TextFontDesplg" id="p3TextFontBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div> -->
            </div>

            <div class="mt-0 mb-0" style="display: flex; justify-content: space-between; align-items: center; margin-left: 10px;" id="p3StlDiv">
<<<<<<< HEAD
                <p id="p3StlOption" class='p3Desplg' style=' display:none;margin: 0px; margin-top: 1em;'>ESTILO <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
=======
                <p id="p3StlOption" class='p3Desplg' style=' display:none;margin: 0px; margin-top: 1em;'><span data-i18n="customizeTemplate:elementStyleMayus">ESTILO</span> <img class="desplg" src="<?= $image_path ?>" alt="Icon"></p>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                <a class="btn my-1 p3StlOptionsDesplg" id="p3StlBtnClearG" style="display: none; margin-bottom: -5px !important;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
            </div>
            <hr style="border-bottom: 1px solid black; display: none;  margin-top: 5px !important;" class="mt-0 mb-0 p3StlOptionsDesplg">
            <div class="mt-3 mb-0 p3StlOptionsDesplg" id="p3StlOptions" style="display: none; margin-left: 20px;">

<<<<<<< HEAD
            <p id="p3StlDisplayOption" style='margin-bottom: 0px;'>Visualizacion</p>
                <div class="my-0" style="display: flex; align-items: center; margin-left: 10px;">
                    <label style="display: none; padding-top: 5px;" class="disabled p3StlDisplayDesplg">BARRA HEAD </label>
                    <input type="checkbox" class="p3StlDisplayDesplg" id="p3Stl01Display" checked style="display:none; margin-top: 5px; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
                <div class="my-0" style="display: flex; align-items: center; margin-left: 10px;">
                    <label style="display: none; padding-top: 5px;" class="disabled p3StlDisplayDesplg">BARRA FOOTER </label>
                    <input type="checkbox" class="p3StlDisplayDesplg" id="p3Stl02Display" checked style="display:none; margin-top: 5px; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
            
            <p id="p3StlColorOption" style='margin-top: 1em;'>COLOR</p>
                <input type="color" id="p3StlColorPicker1" class="p3StlColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3StlColorDesplg" style="display: none; margin-bottom: 0px;">BARRA HEAD</p>
                <input type="color" id="p3StlColorPicker2" class="p3StlColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3StlColorDesplg" style="display: none; margin-bottom: 0px;">BARRA FOOTER</p>
                <input type="color" id="p3StlColorPicker3" class="p3StlColorDesplg" style="display: none;" value='#ffffff'>
                <p class="lb2 p3StlColorDesplg" style="display: none; margin-bottom: 0px;">LETRAS FOOTER</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3StlColorSaveButton" class="my-3 p3StlColorDesplg" style="margin-right: 10px; display: none;">Guardar</a>
=======
            <p id="p3StlDisplayOption" style='margin-bottom: 0px;' data-i18n="customizeTemplate:elementVisualizacion">Visualizacion</p>
                <div class="my-0" style="display: flex; align-items: center; margin-left: 10px;">
                    <label style="display: none; padding-top: 5px;" class="disabled p3StlDisplayDesplg" data-i18n="customizeTemplate:elementBarraHead">BARRA HEAD </label>
                    <input type="checkbox" class="p3StlDisplayDesplg" id="p3Stl01Display" checked style="display:none; margin-top: 5px; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
                <div class="my-0" style="display: flex; align-items: center; margin-left: 10px;">
                    <label style="display: none; padding-top: 5px;" class="disabled p3StlDisplayDesplg" data-i18n="customizeTemplate:elementBarraFooter">BARRA FOOTER </label>
                    <input type="checkbox" class="p3StlDisplayDesplg" id="p3Stl02Display" checked style="display:none; margin-top: 5px; margin-left: 3mm; margin-bottom: 2px !important;">
                </div>
            
            <p id="p3StlColorOption" style='margin-top: 1em;' data-i18n="customizeTemplate:elementColor">COLOR</p>
                <input type="color" id="p3StlColorPicker1" class="p3StlColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3StlColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementBarraHead">BARRA HEAD</p>
                <input type="color" id="p3StlColorPicker2" class="p3StlColorDesplg" style="display: none;" value='#213280'>
                <p class="lb2 p3StlColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementBarraFooter">BARRA FOOTER</p>
                <input type="color" id="p3StlColorPicker3" class="p3StlColorDesplg" style="display: none;" value='#ffffff'>
                <p class="lb2 p3StlColorDesplg" style="display: none; margin-bottom: 0px;" data-i18n="customizeTemplate:elementBarraLetters">LETRAS FOOTER</p>
                <div style="display: flex; align-items: center;">
                    <a id="p3StlColorSaveButton" class="my-3 p3StlColorDesplg" style="margin-right: 10px; display: none;" data-i18n="customizeTemplate:elementBtnSave">Guardar</a>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
                    <a class="btn my-3 p3StlColorDesplg" id="p3StlColorBtnClear" style="display: none;"><img src="<?= $image_path4 ?>" alt="limpiar"></a>
                </div>

            </div>
            
            </div>


            <div class="col-1"></div>
        </div>   
        <input type="hidden" name="ids_inputs" value="p1Img01FileInput,p1Img02FileInput,p1Img03FileInput,p2Img01FileInput,p2Img02FileInput,p2Img03FileInput,p3Img01FileInput,p3Img02FileInput,p3Img03FileInput">
        <div class="row" style='background-color: #fff; border-bottom: 2px solid #E9E9EB; position: fixed; bottom: 0vh; height: 10%; padding: 0px; margin: 0px; left: 0px;' id='rowGenerar'>
            <div class="col-12 col-md-3">
<<<<<<< HEAD
                <button type="button" class="btn btn-subir" id='submitForm'>Generar Plantilla <img style="width: auto; height: 5mm; margin-bottom: 1px;" src="<?= $image_path15 ?>" alt="Icon"></button>
=======
                <button type="button" class="btn btn-subir" id='submitForm'><span data-i18n="customizeTemplate:elementGenerateP">Generar Plantilla</span> <img style="width: auto; height: 5mm; margin-bottom: 1px;" src="<?= $image_path15 ?>" alt="Icon"></button>
>>>>>>> ee8a70bc9f6c76cca5cb408064a39c117cb4e340
            </div>
        </div>

        </form>
        <!-- cierre div -->
    </div>

    <div class='col-12 col-md-9' id='viewPDF'>
        <div class="row" id="cPDF">
            <div class="col-1" style="height: 100vh;"></div>
            <div class="col-10" style="height: 100vh; display:flex; justify-content: center;">
                <div class="letter" id="pdfContainer">

                </div>
            </div>
            <div class="col-1 d-flex align-items-center" style="height: 100vh;">
                <button class="btn mb-5" id="btnPrev"><img src="<?= $image_path2 ?>" class='ays' alt="Botón 1"></button>
                <button class="btn mb-5" id="btnNext"><img src="<?= $image_path3 ?>" class='ays' alt="Botón 2"></button>
            </div>
        </div>
    </div>

</div>

<div id="templatePDF" style="display:none;" value="">

</div>

<div id="varsPDF" style="display:none;" value="">

</div>
<!-- </div> -->

<script src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/templateOptionsP1.js"></script>
<!-- <script src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/templateOptionsG.js"></script> -->
<script src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/templateOptionsP2.js"></script>
<script src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/templateOptionsP3.js"></script>
<script src="https:///dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/js/templateSubmit.js"></script>

