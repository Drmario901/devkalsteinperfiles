/* document.querySelectorAll('#formularioImagenes').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

    });
}); */


document.addEventListener('DOMContentLoaded', function() {
    localStorage.setItem('clickCount', 0);

    document.getElementById('submitForm').addEventListener('click', function(event) {
        alert('Los archivos se están subiendo...');
        jQuery(document).ready(function($) {
            var formulario = document.getElementById('formularioImagenes');
            var formData = new FormData(formulario);
        
            let cNameElement = document.querySelector('.cNameValue');
            let cName = cNameElement.dataset.name;
            formData.append('cName', cName);
        
            // Obtener los IDs de los campos de archivos y agregarlos al formData
            var idsInputs = document.querySelector('input[name="ids_inputs"]').value;
            formData.append('ids_inputs', idsInputs);
        
            var totalArchivos = formData.getAll('imagenes[]').length;
        
            $.ajax({
                url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/templates-php/customize-template/imgUpload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Manejar la respuesta del servidor
                    console.log(response);
                    // Verificar si todos los archivos se han subido o si no hay archivos cargados
                    if (response.includes('Todos los archivos han sido subidos correctamente') || response.includes('No se han seleccionado archivos para subir')) {
                        // Todos los archivos han sido subidos o no hay archivos para subir
                        alert('Todos los archivos han sido subidos');
                        ejecutarRestoDelCodigo();
                    }

                },
                error: function(error) {
                    // Manejar errores
                    console.log(error);
                }
            });
        });
        
        
        
        
        
    function ejecutarRestoDelCodigo() {


    function handleClickCounter() {

        let clickCount = parseInt(localStorage.getItem('clickCount')) + 1;
        localStorage.setItem('clickCount', clickCount);
        console.log(`Contador de clics: ${clickCount}`);
        
        if (clickCount >= 10) {
            const btnSubir = document.querySelector('.btn-subir');
            if (btnSubir) {
            btnSubir.disabled = true;
            }
        }
    }        

    function ImageProperties(id) {
    this.element = document.querySelector(`${id}`);
    this.styles = {};
  
    if (this.element) {
        let computedStyles = window.getComputedStyle(this.element);
        this.styles = {
            right: computedStyles.getPropertyValue('right'),
            top: computedStyles.getPropertyValue('top'),
            display: computedStyles.getPropertyValue('display'),
            width: computedStyles.getPropertyValue('width'),
            height: computedStyles.getPropertyValue('height'),
            left: computedStyles.getPropertyValue('left'),
            bottom: computedStyles.getPropertyValue('bottom'),
            src: this.element.getAttribute('src')
        };
    } else {
        console.error(`Element with ID '${id}' not found.`);
    }
    }

    function TextProperties(id) {
        this.element = document.querySelector(`${id}`);
        this.styles = {};
    
        if (this.element) {
            let computedStyles = window.getComputedStyle(this.element);
            this.styles = {
                display: computedStyles.getPropertyValue('display'),
                color: computedStyles.getPropertyValue('color'),
                backgroundcolor: computedStyles.getPropertyValue('background-color'),
                fontSize: computedStyles.getPropertyValue('font-size'),
                fontFamily: computedStyles.getPropertyValue('font-family'),
                fontWeight: computedStyles.getPropertyValue('font-weight'),
                textAlign: computedStyles.getPropertyValue('text-align'),
                content: this.element.textContent // Obtener el contenido de la cadena de texto
            };
        } else {
            console.error(`Element with ID '${id}' not found.`);
        }
    }

    function ContainerProperties(id) {
        this.element = document.querySelector(`${id}`);
        this.styles = {};
    
        if (this.element) {
            let computedStyles = window.getComputedStyle(this.element);
            this.styles = {
                display: computedStyles.getPropertyValue('display'),
                left: computedStyles.getPropertyValue('left'),
                right: computedStyles.getPropertyValue('right'),
                top: computedStyles.getPropertyValue('top'),
                bottom: computedStyles.getPropertyValue('bottom'),
                height: computedStyles.getPropertyValue('height'),
                width: computedStyles.getPropertyValue('width')
            };
        } else {
            console.error(`Element with ID '${id}' not found.`);
        }
    }

    function HrProperties(id) {
        this.element = document.querySelector(`${id}`);
        this.styles = {};
    
        if (this.element) {
            let computedStyles = window.getComputedStyle(this.element);
            this.styles = {
                display: computedStyles.getPropertyValue('display'),
                left: computedStyles.getPropertyValue('left'),
                right: computedStyles.getPropertyValue('right'),
                top: computedStyles.getPropertyValue('top'),
                bottom: computedStyles.getPropertyValue('bottom'),
            };
        } else {
            console.error(`Element with ID '${id}' not found.`);
        }
    }

    function StlProperties(id) {
        this.element = document.querySelector(`${id}`);
        this.styles = {};
    
        if (this.element) {
            let computedStyles = window.getComputedStyle(this.element);
            this.styles = {
                display: computedStyles.getPropertyValue('display'),
                backgroundColor: computedStyles.getPropertyValue('background-color')
            };
        } else {
            console.error(`Element with ID '${id}' not found.`);
        }
    }

    function aplicarEstiloSiCumpleCondicion(elemento, propiedadCSS, valorCondicion, texto) {
        if (elemento.styles[propiedadCSS] === valorCondicion || elemento.styles[propiedadCSS] == valorCondicion) {
            let templatePDF = document.querySelector('#templatePDF');
            if (templatePDF) {
                templatePDF.insertAdjacentHTML('beforeend', texto);
            } else {
                console.error(`Element with ID 'templatePDF' not found.`);
            }
        }
    } 
    
    function aplicarEstiloSiNoCumpleCondicion(elemento, propiedadCSS, valorCondicion, texto) {
        if (elemento.styles[propiedadCSS] !== valorCondicion) {
            let templatePDF = document.querySelector('#templatePDF');
            if (templatePDF) {
                templatePDF.insertAdjacentHTML('beforeend', texto);
            } else {
                console.error(`Element with ID 'templatePDF' not found.`);
            }
        } else {
            console.log(`No son diferentes`);
        }
    } 
    
    function templateTextContent(elementoEditor, elementoPDF) {
        let templatePDF = document.querySelector('#varsPDF');
        let contenido = document.getElementById(elementoEditor);
    
        if (!contenido) {
            console.error(`Element with ID '${elemento}' not found.`);
            return; // Salir de la función si no se encuentra el elemento.
        }
    
        let texto = contenido.textContent;
        let phpVar = ' $' + elementoPDF + 'Content = \'' + texto + '\'; '; // Generar la variable PHP
    
        if (templatePDF) {
            templatePDF.insertAdjacentHTML('beforeend', phpVar);
        } else {
            console.error(`Element with ID 'varsPDF' not found.`);
        }
    }

    function templateFileLoad(elementoPDF) {
        let templatePDF = document.querySelector('#varsPDF');
        let phpVar = ' $' + elementoPDF + 'FL = true;'; // Generar la variable PHP
    
        if (templatePDF) {
            templatePDF.insertAdjacentHTML('beforeend', phpVar);
        } else {
            console.error(`Element with ID 'varsPDF' not found.`);
        }
    }

    function templateTextFontSize(elementoEditor, elementoPDF) {
        let templatePDF = document.querySelector('#varsPDF');
        let contenido = document.getElementById(elementoEditor);
    
        if (!contenido) {
            console.error(`Element with ID '${elemento}' not found.`);
            return; // Salir de la función si no se encuentra el elemento.
        }
    
        let texto = contenido.fontSize;
        let phpVar = ' $' + elementoPDF + 'Size = \'' + texto + '\'; '; // Generar la variable PHP
    
        if (templatePDF) {
            templatePDF.insertAdjacentHTML('beforeend', phpVar);
        } else {
            console.error(`Element with ID 'varsPDF' not found.`);
        }
    }

    function templateTextFontFamily(elementoEditor, elementoPDF) {
        let templatePDF = document.querySelector('#varsPDF');
        let contenido = document.getElementById(elementoEditor);
    
        if (!contenido) {
            console.error(`Element with ID '${elemento}' not found.`);
            return; // Salir de la función si no se encuentra el elemento.
        }
    
        let texto = contenido.fontFamily;
        let phpVar = ' $' + elementoPDF + 'Family = \'' + texto + '\'; '; // Generar la variable PHP
    
        if (templatePDF) {
            templatePDF.insertAdjacentHTML('beforeend', phpVar);
        } else {
            console.error(`Element with ID 'varsPDF' not found.`);
        }
    }
    
    function verifyInput (inputId,pdfElement){
        var fileInput = document.getElementById(inputId);
        var img01load = false;
    
        // Verificar si el input tiene un archivo cargado
        if (fileInput.files.length > 0) {
            img01load = true;
        } else {
            img01load = false;
        }
    
        // Utilizar img01load según sea necesario, por ejemplo, para mostrar un mensaje
        if (img01load) {
            console.log('El input tiene un archivo cargado');
            templateFileLoad(pdfElement);
        } else {
            console.log('El input no tiene un archivo cargado');
        }
    }
    

    //Estilos computados
    //Estilos computados
    //Estilos computados

    //pagina 1
                                  
    let p1Img01 = new ImageProperties('#p1Img01');

    aplicarEstiloSiCumpleCondicion(p1Img01, 'display', 'none', ' #PDFp1Img01 {position: absolute; top: -9999px;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'right', '94.4882px', ' #PDFp1Img01 {float:right; margin-left:0mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'right', '306.142px', ' #PDFp1Img01 {float:left; margin-left:90mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'right', '521.575px', ' #PDFp1Img01 {float:left; margin-left:20mm;}'); //sm y md
    aplicarEstiloSiCumpleCondicion(p1Img01, 'right', '94.4882px', ' #PDFp1Img01 {float:right; margin-left:0mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'right', '291.024px', ' #PDFp1Img01 {float:left; margin-left:80mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'right', '491.339px', ' #PDFp1Img01 {float:left; margin-left:20mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'width', '140.031px', ' #PDFp1Img01 {width:' + (134.219) + 'px !important; height:' + (134.219) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'width', '172.156px', ' #PDFp1Img01 {width:' + (172.156) + 'px !important; height:' + (165.031) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p1Img01, 'width', '210.047px', ' #PDFp1Img01 {width:' + (210.047) + 'px !important; height:' + (201.359) + 'px;}');

    let p1Img02 = new ImageProperties('#p1Img02');

    aplicarEstiloSiCumpleCondicion(p1Img02, 'display', 'none', ' #PDFlogoP1 {position: absolute; top: -9999px;}.PDFhr{position: absolute; top: -9999px;}');
    aplicarEstiloSiCumpleCondicion(p1Img02, 'top', '610.772px', ' #PDFLogoP1 {margin-top: 58mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img02, 'top', '597.921px', ' #PDFLogoP1 {margin-top: 54mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img02, 'top', '585.071px', ' #PDFLogoP1 {margin-top: 50mm;}'); //md
    aplicarEstiloSiCumpleCondicion(p1Img02, 'width', '233.375px', ' #PDFLogoP1 {width:' + (233.375) + 'px !important; height:' + (70.2188) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p1Img02, 'width', '287.859px', ' #PDFLogoP1 {width:' + (287.859) + 'px !important; height:' + (84.7188) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p1Img02, 'width', '342.297px', ' #PDFLogoP1 {width:' + (342.297) + 'px !important; height:' + (99.2188) + 'px;}');

    let p1TituloP1 = new TextProperties('.co');
    let p1TituloP2 = new TextProperties('.id-title');
    let p1TituloP3 = new TextProperties('.msj');

    templateTextContent('p1T1P1','PDFco');
    templateTextContent('p1T1P2','PDFidTitle');
    templateTextContent('p1T1P3','PDFmsj');
/*     templateTextFontFamily('p1T1P1','PDFco');
    templateTextFontFamily('p1T1P2','PDFidTitle');
    templateTextFontFamily('p1T1P3','PDFmsj');
    templateTextFontSize('p1T1P1','PDFco');
    templateTextFontSize('p1T1P2','PDFidTitle');
    templateTextFontSize('p1T1P3','PDFmsj'); */
    aplicarEstiloSiNoCumpleCondicion(p1TituloP1, 'color', 'rgb(51, 51, 51)', ' .PDFco {color:' + (p1TituloP1.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP2, 'color', 'rgb(33, 50, 128)', ' .PDFid-title , .PDFid-n {color:' + (p1TituloP2.styles.color) + ' !important;}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP3, 'color', 'rgb(51, 51, 51)', ' .PDFmsj {color:' + (p1TituloP3.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP1, 'textAlign', 'left', ' .PDFco {text-align:' + (p1TituloP1.styles.textAlign) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP2, 'textAlign', 'left', ' .PDFid-title , .PDFid-n {text-align:' + (p1TituloP2.styles.textAlign) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP3, 'textAlign', 'left', ' .PDFmsj {text-align:' + (p1TituloP3.styles.textAlign) + ';}');
    aplicarEstiloSiCumpleCondicion(p1TituloP1, 'fontWeight', '700', ' .PDFco {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1TituloP2, 'fontWeight', '700', ' .PDFid-title , .PDFid-n {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1TituloP3, 'fontWeight', '700', ' .PDFmsj {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1TituloP1, 'fontWeight', '400', ' .PDFco {font-weight: lighter;}');
    aplicarEstiloSiCumpleCondicion(p1TituloP2, 'fontWeight', '400', ' .PDFid-title , .PDFid-n {font-weight: lighter;}');
    aplicarEstiloSiCumpleCondicion(p1TituloP3, 'fontWeight', '400', ' .PDFmsj {font-weight: lighter;}');
/*     aplicarEstiloSiNoCumpleCondicion(p1TituloP1, 'fontSize', '18px', ' .PDFco {font-size: ' + (p1TituloP1.styles.fontSize) + ' !important;}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP2, 'fontSize', '45px', ' .PDFid-title , .PDFid-n {font-size: ' + (p1TituloP2.styles.fontSize) + ' !important;}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP3, 'fontSize', '12px', ' .PDFmsj {font-size: ' + (p1TituloP3.styles.fontSize) + ' !important;}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP1, 'fontFamily', 'Arial, Helvetica, sans-serif', ' .PDFco {font-family: ' + (p1TituloP1.styles.fontFamily) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP2, 'fontFamily', 'Arial, Helvetica, sans-serif', ' .PDFid-title {font-family: ' + (p1TituloP2.styles.fontFamily) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1TituloP3, 'fontFamily', 'Arial, Helvetica, sans-serif', ' .PDFmsj {font-family: ' + (p1TituloP3.styles.fontFamily) + ';}');  */
 
/*     let p1Hr01 = new HrProperties('.hr'); */

    let p1Fondo = new ImageProperties('#backgroundCp01');

    aplicarEstiloSiCumpleCondicion(p1Fondo, 'display', 'none', ' .PDFbackground-img {position: absolute; left: -9999px;}');

    let p1Img03Cont = new ContainerProperties('#p1Img03C');
    let p1Img03 = new ImageProperties('#p1Img03');

    aplicarEstiloSiCumpleCondicion(p1Img03, 'display', 'none', ' #PDFLogo2P1 {position: absolute; top: -9999px;}.PDFhr-2{position: absolute; top: -9999px;}');
    aplicarEstiloSiCumpleCondicion(p1Img03Cont, 'top', '1020.47px', ' .PDFimg-logo2 {top: 258mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img03Cont, 'top', '1009.13px', ' .PDFimg-logo2 {top: 256mm;}');
    aplicarEstiloSiCumpleCondicion(p1Img03Cont, 'top', '997.795px', ' .PDFimg-logo2 {top: 252mm;}'); //md
    aplicarEstiloSiCumpleCondicion(p1Img03, 'width', '105.016px', ' #PDFLogo2P1 {width:' + (105.016) + 'px !important; height:' + (92.7656) + 'px;} .PDFimg-logo2 {margin-right: -8mm;padding-top:3mm}');
    aplicarEstiloSiCumpleCondicion(p1Img03, 'width', '136.125px', ' #PDFLogo2P1 {width:' + (136.125) + 'px !important; height:' + (120.266) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p1Img03, 'width', '156px', ' #PDFLogo2P1 {width:' + (156) + 'px !important; height:' + (133) + 'px;} .PDFimg-logo2 {margin-right: 2mm;}');

    let p1FooterP1 = new TextProperties('.l-1');
    let p1FooterP2 = new TextProperties('.l-2');
    let p1FooterP3 = new TextProperties('.l-3');
    let p1FooterP4 = new TextProperties('.l-4');
    let p1FooterP5 = new TextProperties('.l-5');

    templateTextContent('p1FooterP1','PDFp1L1');
    templateTextContent('p1FooterP2','PDFp1L2');
    templateTextContent('p1FooterP3','PDFp1L3');
    templateTextContent('p1FooterP4','PDFp1L4');
    templateTextContent('p1FooterP5','PDFp1L5');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP1, 'color', 'rgb(255, 255, 255)', ' .PDFl-1 {color:' + (p1FooterP1.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP2, 'color', 'rgb(255, 255, 255)', ' .PDFl-2 {color:' + (p1FooterP2.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP3, 'color', 'rgb(255, 255, 255)', ' .PDFl-3 {color:' + (p1FooterP3.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP4, 'color', 'rgb(255, 255, 255)', ' .PDFl-4 {color:' + (p1FooterP4.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP5, 'color', 'rgb(255, 255, 255)', ' .PDFl-5 {color:' + (p1FooterP5.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP1, 'textAlign', 'left', ' .PDFl-1 {text-align:' + (p1FooterP1.styles.textAlign) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP2, 'textAlign', 'left', ' .PDFl-2 {text-align:' + (p1FooterP2.styles.textAlign) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP3, 'textAlign', 'left', ' .PDFl-3 {text-align:' + (p1FooterP3.styles.textAlign) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP4, 'textAlign', 'left', ' .PDFl-4 {text-align:' + (p1FooterP4.styles.textAlign) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p1FooterP5, 'textAlign', 'left', ' .PDFl-5 {text-align:' + (p1FooterP5.styles.textAlign) + ';}');
    aplicarEstiloSiCumpleCondicion(p1FooterP1, 'fontWeight', '700', ' .PDFl-1 {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP2, 'fontWeight', '700', ' .PDFl-2 {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP3, 'fontWeight', '700', ' .PDFl-3 {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP4, 'fontWeight', '700', ' .PDFl-4 {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP5, 'fontWeight', '700', ' .PDFl-5 {font-weight: bold;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP1, 'fontWeight', '400', ' .PDFl-1 {font-weight: lighter;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP2, 'fontWeight', '400', ' .PDFl-2 {font-weight: lighter;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP3, 'fontWeight', '400', ' .PDFl-3 {font-weight: lighter;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP4, 'fontWeight', '400', ' .PDFl-4 {font-weight: lighter;}');
    aplicarEstiloSiCumpleCondicion(p1FooterP5, 'fontWeight', '400', ' .PDFl-5 {font-weight: lighter;}');

    let p1QrF = new ImageProperties('#qrF');

    aplicarEstiloSiCumpleCondicion(p1QrF, 'display', 'none', ' #PDFf-01-img {position: absolute; top: -9999px;}');

    //pagina 2

    let p2logo = new ImageProperties('#logoP2');

    aplicarEstiloSiCumpleCondicion(p2logo, 'display', 'none', ' #PDFlogoP2 {position: absolute; top: -9999px;}');
    aplicarEstiloSiCumpleCondicion(p2logo, 'width', '210px', ' #PDFlogoP2 {width:' + (210) + 'px !important; height:' + (61.7969) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p2logo, 'width', '249px', ' #PDFlogoP2 {width:' + (249) + 'px !important; height:' + (73) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p2logo, 'width', '300px', ' #PDFlogoP2 {width:' + (300) + 'px !important; height:' + (88.2656) + 'px; margin-top: 7mm; margin-left: -12mm;}');

    let p2Tabla = new TextProperties('.td-i'); 

    aplicarEstiloSiNoCumpleCondicion(p2Tabla, 'color', 'rgb(255, 255, 255)', ' .PDFc-table td {color:' + (p2Tabla.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p2Tabla, 'backgroundColor', 'rgb(33, 50, 128)', ' .PDFc-table td {background-color:' + (p2Tabla.styles.backgroundcolor) + ';}');

    let p2Factura = new TextProperties('#p2BillP');

    aplicarEstiloSiNoCumpleCondicion(p2Factura, 'color', 'rgb(51, 51, 51)', ' .PDFbt-02 p {color:' + (p2Factura.styles.color) + ';}');
    
    let p2Img02 = new ImageProperties('#p2Ce');

    aplicarEstiloSiCumpleCondicion(p2Img02, 'display', 'none', ' #PDFimg-ce-img {position: absolute; top: -9999px;}');

    let p2Img03 = new ImageProperties('#p2Img03');

    aplicarEstiloSiCumpleCondicion(p2Img03, 'display', 'none', ' #PDFimg-cora-img {position: absolute; top: -9999px;}');

    let p2Footer1P1 = new TextProperties('.p2P1');
    let p2Footer1P2 = new TextProperties('.p2P2');

    aplicarEstiloSiNoCumpleCondicion(p2Footer1P1, 'color', 'rgb(51, 51, 51)', ' .PDFtext-ce p {color:' + (p2Footer1P1.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p2Footer1P2, 'color', 'rgb(51, 51, 51)', ' .PDFtext-cora p {color:' + (p2Footer1P2.styles.color) + ';}');
    templateTextContent('p2F1P1','PDFtextCeP1');
    templateTextContent('p2F1P2','PDFtextCeP2');
    templateTextContent('p2F1P3','PDFtextCoraP1');
    templateTextContent('p2F1P4','PDFtextCoraP2');

    let p2Footer2P1 = new TextProperties('.p2P5');

    aplicarEstiloSiNoCumpleCondicion(p2Footer2P1, 'color', 'rgb(51, 51, 51)', ' .PDFft-02-text p {color:' + (p2Footer2P1.styles.color) + ';}');
    templateTextContent('p2F2P1','PDFft02TextP1');
    templateTextContent('p2F2P2','PDFft02TextP2');
    templateTextContent('p2F2P3','PDFft02TextP3');

    //pagina 3 

    let p3Logo = new ImageProperties('#logoP3');

    aplicarEstiloSiCumpleCondicion(p3Logo, 'display', 'none', ' #PDFlogo4-02-img {position: absolute; top: -9999px;}');
    aplicarEstiloSiCumpleCondicion(p3Logo, 'width', '210px', ' #PDFlogo4-02-img {width:' + (210) + 'px !important; height:' + (61.7969) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p3Logo, 'width', '241.875px', ' #PDFlogo4-02-img {width:' + (241.875) + 'px !important; height:' + (71.1875) + 'px;}');
    aplicarEstiloSiCumpleCondicion(p3Logo, 'width', '275px', ' #PDFlogo4-02-img {width:' + (275) + 'px !important; height:' + (80.9375) + 'px; margin-top: 8mm}');

    let p3Titulo = new TextProperties('.lt4-01');

    aplicarEstiloSiNoCumpleCondicion(p3Titulo, 'color', 'rgb(33, 50, 128)', ' .PDFlt4-01 {color:' + (p3Titulo.styles.color) + ';}');

    let p3Subtitulos = new TextProperties('.subtitle4');
    let p3Parrafos = new TextProperties('.p3P');

    aplicarEstiloSiNoCumpleCondicion(p3Subtitulos, 'color', 'rgb(33, 50, 128)', ' .PDFp3ST {color:' + (p3Subtitulos.styles.color) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p3Parrafos, 'color', 'rgb(51, 51, 51)', ' .PDFp3P p {color:' + (p3Parrafos.styles.color) + ';} #p3Sub7 {color:' + (p3Parrafos.styles.color) + ';}');

    let p3Img02 = new ImageProperties('#p3P2');

    aplicarEstiloSiCumpleCondicion(p3Img02, 'display', 'none', ' #PDFp2img-02-img {position: absolute; top: -9999px;}');

    let p3Img03 = new ImageProperties('#p3P3');

    aplicarEstiloSiCumpleCondicion(p3Img03, 'display', 'none', ' #PDFp2img-03-img {position: absolute; top: -9999px;}');

    let p3Stl01 = new StlProperties('.style-05');
    let p3Stl02 = new StlProperties('.style-07');
    let p3FooterP = new TextProperties('#footerP');

    aplicarEstiloSiCumpleCondicion(p3Stl01, 'backgroundColor', 'rgb(255, 255, 255)', ' .PDFstyle-05 {background-color: white;}');
    aplicarEstiloSiCumpleCondicion(p3Stl02, 'backgroundColor', 'rgb(255, 255, 255)', ' .PDFstyle-07 {background-color: white;} #PDFstyle-07-p1 {color: black;}');
    aplicarEstiloSiNoCumpleCondicion(p3Stl01, 'backgroundColor', 'rgb(33, 50, 128)', ' .PDFstyle-05 {background-color:' + (p3Stl01.styles.backgroundColor) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p3Stl02, 'backgroundColor', 'rgb(33, 50, 128)', ' .PDFstyle-07 {background-color:' + (p3Stl02.styles.backgroundColor) + ';}');
    aplicarEstiloSiNoCumpleCondicion(p3FooterP, 'color', 'rgb(255, 255, 255)', ' #footerP {color:' + (p3FooterP.styles.color) + ';}');

    //verificar inputs file

    verifyInput('p1Img01FileInput','imagen01');
    verifyInput('p1Img02FileInput','imagen03');
    verifyInput('p1Img03FileInput','imagen05');
    verifyInput('p2Img01FileInput','imagen0303');
    verifyInput('p2Img02FileInput','imagen16');
    verifyInput('p2Img03FileInput','imagen11');
    verifyInput('p3Img01FileInput','imagen0302');
    verifyInput('p3Img02FileInput','imagen07');
    verifyInput('p3Img03FileInput','imagen08');

    // Obtener todo el texto dentro de los contenedores
    let templateHtml = document.getElementById('templatePDF').innerText;
    let varsPhp = document.getElementById('varsPDF').innerText;
    
    // Obtener el valor de emailAcc desde el DOM
    let emailAccElement = document.querySelector('.emailAccValue');
    let emailAcc = emailAccElement.dataset.email;

    let cNameElement = document.querySelector('.cNameValue');
    let cName = cNameElement.dataset.name;


    fetch('https:///plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/customizeTemplateQuerys.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'template_html=' + encodeURIComponent(templateHtml) + '&template_mail=' + encodeURIComponent(emailAcc) + '&template_variables=' + encodeURIComponent(varsPhp) + '&template_user=' + encodeURIComponent(cName)
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Puedes hacer algo con la respuesta si lo deseas

        // Construir la URL con el parámetro emailAcc
        let url = 'https:///plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/classes/createCustomPDF.php';
        // Abrir la URL en una nueva ventana
        window.open(url, '_blank');
    })
    .catch(error => {
        console.error('Error:', error);
    }); 

  // Limpia el contenido de #templatePDF después del tiempo establecido
  const btnSubir = event.target;
  
  // Deshabilitar el botón al hacer clic
  btnSubir.disabled = true;

  handleClickCounter();

  // Limpia el contenido de #templatePDF después de 5 segundos
  setTimeout(function() {

/*     var fileInputIds = 'p1Img01FileInput,p1Img02FileInput,p1Img03FileInput,p2Img01FileInput,p2Img02FileInput,p2Img03FileInput,p3Img01FileInput,p3Img02FileInput,p3Img03FileInput';
    // Separa los IDs por comas y obtiene los elementos correspondientes
    var fileInputIdArray = fileInputIds.split(',');
    fileInputIdArray.forEach(function(id) {
        var fileInput = document.getElementById(id);
        if (fileInput) {
            // Limpia el campo de tipo file estableciendo su valor como vacío
            fileInput.value = '';
        }
    }); */

    let templatePDF = document.querySelector('#templatePDF');
    let varsPDF = document.querySelector('#varsPDF');
    if (templatePDF) {
      templatePDF.innerHTML = '';
      templatePDF.innerText = '';
      varsPDF.innerHTML = '';
      varsPDF.innerText = '';
      // Vuelve a habilitar el botón después de limpiar
      btnSubir.disabled = false;
    } else {
      console.error(`Element with ID 'templatePDF' not found.`);
    }
  }, 5000); //tiempo establecido
}
    });

});




