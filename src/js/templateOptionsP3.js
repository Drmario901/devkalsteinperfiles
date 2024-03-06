
document.body.addEventListener('wheel', function(e) {
    if (e.ctrlKey) {
      e.preventDefault();
    }
  });
  
/* Verificar descendencia */
function isDescendant(element, parentId) {
    while (element !== null) {
        if (element.id === parentId) {
            return true;
        }
        element = element.parentElement;
    }
    return false;
} 

var areElementsVisible = false;
var areElementsVisible2 = false;

function visualizarOpciones(selector, classToToggle) {
    document.querySelector(selector).addEventListener('click', function() {
        let optionDesp = document.querySelectorAll(classToToggle);

        if (areElementsVisible) {
            optionDesp.forEach(function(flex) {
                flex.style.display = 'none';
            });
        } else {
            optionDesp.forEach(function(flex) {
                flex.style.display = 'block';
            });
        }

        areElementsVisible = !areElementsVisible;
    });
}

function desVisualizarOpciones(classToToggle) {
    let optionDesp = document.querySelectorAll(classToToggle);

    optionDesp.forEach(function (element) {
        if (window.getComputedStyle(element).display === 'block') {
            element.style.display = 'none';
        }
    });
    
}

function visualizarOpciones2(selector, classToToggle) {
    document.querySelector(selector).addEventListener('click', function() {
        let optionDesp = document.querySelectorAll(classToToggle);

        if (areElementsVisible2) {
            optionDesp.forEach(function(flex) {
                flex.style.display = 'none';
            });
        } else {
            optionDesp.forEach(function(flex) {
                flex.style.display = 'flex';
            });
        }

        areElementsVisible2 = !areElementsVisible2;
    });
}

document.querySelector('#pagina3Div').addEventListener('click', function() {
    desVisualizarOpciones('.p3Desplg');
    desVisualizarOpciones('.p3TextOptionsDesplg');
    desVisualizarOpciones('.p3TitleOptionsDesplg');
/*     desVisualizarOpciones('.p3DspOptionsDesplg'); */
    desVisualizarOpciones('.p3ImgOptionsDesplg');
    desVisualizarOpciones('.p3StlOptionsDesplg');
});

/* mostrar opciones pagina 2 */
visualizarOpciones('#pagina3Div', '.p3Desplg');

//imagenes

// opciones imagenes
visualizarOpciones('#p3ImgOption', '.p3ImgOptionsDesplg');

// Opciones Imágenes > Imagen 01
visualizarOpciones('#p3Img01Option', '.p3Img01OptionsDesplg');

document.querySelector('#p3Img01Display').addEventListener('change', function() {
    let checkbox = document.getElementById('p3Img01Display');
    let logoP3 = document.getElementById('logoP3');

    if (checkbox.checked) {
        logoP3.style.display = 'block';
    } else {
        logoP3.style.display = 'none';
    }
});

document.querySelector('#p3Img01SizeSm').addEventListener('click', function() {
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    img.style.width = '210px';
    img.style.height = '61.8px';
    cont.style.top = '21mm';
    cont.style.left = '21mm';

/*     if (ladoH === 1) {
        cont.style.top = '21mm';
        cont.style.left = '21mm';
    } else {
        cont.style.top = '22mm';
        cont.style.left = '129mm';
    } */
});

document.querySelector('#p3Img01SizeMd').addEventListener('click', function() {
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    img.style.width = '241.88px';
    img.style.height = '71.19px';
    cont.style.top = '19mm';
    cont.style.left = '13mm';

/*     if (ladoH === 1) {
        cont.style.top = '19mm';
        cont.style.left = '13mm';
    } else {
        cont.style.top = '21mm';
        cont.style.left = '131mm';
    } */
});

document.querySelector('#p3Img01SizeLg').addEventListener('click', function() {
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    img.style.width = '275px';
    img.style.height = '80.94px';

    cont.style.top = '18mm';
    cont.style.left = '6mm';

/*     if (ladoH === 1) {
        cont.style.top = '18mm';
        cont.style.left = '6mm';
    } else {
        cont.style.top = '19mm';
        cont.style.left = '129mm';
    } */
});

document.getElementById('p3Img01FileInput').addEventListener('change', function(event) {
    let file = event.target.files[0];

    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let nuevaImagenSrc = e.target.result;
            let imagenExistente = document.getElementById('logoP3');
            imagenExistente.src = nuevaImagenSrc;
        };

        reader.readAsDataURL(file);
    }
});

document.getElementById('p3Img01BtnClearG').addEventListener('click', function(){
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    let checkbox = document.getElementById('p3Img01Display');
    img.style.display = 'block';
    img.style.width = '241.88px';
    img.style.height = '71.19px';
    cont.style.top = '19mm';
    cont.style.left = '13mm';
/*     if (ladoH === 1){
        cont.style.top = '19mm';
        cont.style.left = '13mm';
    } else {
        cont.style.top = '21mm';
        cont.style.left = '131mm';
    } */
    img.src = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/LogoActualizado2.png';
    checkbox.checked = true;
});

// Opciones Imágenes > Imagen 02
visualizarOpciones('#p3Img02Option', '.p3Img02OptionsDesplg');

document.querySelector('#p3Img02Display').addEventListener('change', function() {
    let checkbox = document.getElementById('p3Img02Display');
    let p3Img02 = document.getElementById('p3P2');
    let p3Img03 = document.querySelector('.p2img-03');

    if (checkbox.checked) {
        p3Img02.style.display = 'block';
        if (window.getComputedStyle(p3Img03).display === 'block'){
            p3Img03.style.bottom = '3mm';
        }
    } else {
        p3Img02.style.display = 'none';
        if (window.getComputedStyle(p3Img03).display === 'block'){
            p3Img03.style.bottom = '38mm';
        }
    }
});


document.getElementById('p3Img02FileInput').addEventListener('change', function(event) {
    let file = event.target.files[0];

    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let nuevaImagenSrc = e.target.result;
            let imagenExistente = document.getElementById('p3P2');
            imagenExistente.src = nuevaImagenSrc;
        };

        reader.readAsDataURL(file);
    }
});

document.getElementById('p3Img02BtnClearG').addEventListener('click', function(){
    let img = document.getElementById('p3P2');
    let checkbox = document.getElementById('p3Img02Display');
    let p3Img03 = document.querySelector('.p2img-03');
    img.style.display = 'block';
    img.src = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/img2p.png';
    checkbox.checked = true;
    p3Img03.style.bottom = '3mm';
});

// Opciones Imágenes > Imagen 03
visualizarOpciones('#p3Img03Option', '.p3Img03OptionsDesplg');

document.querySelector('#p3Img03Display').addEventListener('change', function() {
    let checkbox = document.getElementById('p3Img03Display');
    let p3Img03 = document.getElementById('p3P3');
    let p3Img02 = document.querySelector('.p2img-02');

    if (checkbox.checked) {
        p3Img03.style.display = 'block';
        if (window.getComputedStyle(p3Img02).display === 'block'){
            p3Img02.style.top = '79.9mm';
        }
    } else {
        p3Img03.style.display = 'none';
        if (window.getComputedStyle(p3Img02).display === 'block'){
            p3Img02.style.top = '116mm';
        }
    }
});


document.getElementById('p3Img03FileInput').addEventListener('change', function(event) {
    let file = event.target.files[0];

    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let nuevaImagenSrc = e.target.result;
            let imagenExistente = document.getElementById('p3P3');
            imagenExistente.src = nuevaImagenSrc;
        };

        reader.readAsDataURL(file);
    }
});

document.getElementById('p3Img03BtnClearG').addEventListener('click', function(){
    let img = document.getElementById('p3P3');
    let p3Img02 = document.querySelector('.p2img-02');
    let checkbox = document.getElementById('p3Img03Display');
    img.style.display = 'block';
    img.src = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/img1p.png';
    checkbox.checked = true;
    p3Img02.style.top = '79.9mm';
});

// Default General Imágenes
document.querySelector('#p3ImgBtnClearG').addEventListener('click', function(){

    // IMG01
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    let checkbox = document.getElementById('p3Img01Display');
    img.style.display = 'block';
    img.style.width = '241.88px';
    img.style.height = '71.19px';
    cont.style.top = '19mm';
    cont.style.left = '13mm';
/*     if (ladoH === 1){
        cont.style.top = '19mm';
        cont.style.left = '13mm';
    } else {
        cont.style.top = '21mm';
        cont.style.left = '131mm';
    } */
    img.src = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/LogoActualizado2.png';
    checkbox.checked = true;

    // IMG02
    let img2 = document.getElementById('p3P2');
    let checkbox2 = document.getElementById('p3Img02Display');
    img2.style.display = 'block';
    img2.src = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/img2p.png';
    checkbox2.checked = true;
    let p3Img02 = document.querySelector('.p2img-02');
    p3Img02.style.top = '79.9mm';

    // IMG03
    let img3 = document.getElementById('p3P3');
    let checkbox3 = document.getElementById('p3Img03Display');
    img3.style.display = 'block';
    img3.src = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/img1p.png';
    checkbox3.checked = true;
    let p3Img03 = document.querySelector('.p2img-03');
    p3Img03.style.bottom = '3mm';
});

// opciones disposicion
/* visualizarOpciones('#p3DspOption', '.p3DspOptionsDesplg'); */

/* let ladoH = 1;

document.querySelector('#p3SideChange1').addEventListener('click', function () {
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    let contTexto = document.querySelector('.h4-text-02');
    let hr = document.querySelector('.hr4-02');

    if (img.style.width && img.style.height) {
        currentSize = {
            width: img.style.width,
            height: img.style.height
        };
    }

    if (ladoH === 1) {
        ladoH = 2;
        contTexto.style.left = '26mm';
        hr.style.left = '125mm';

        img.style.width = currentSize.width;
        img.style.height = currentSize.height;

        if (currentSize.width === '210px') {
            cont.style.top = '22mm';
            cont.style.left = '129mm';
        } else if (currentSize.width === '241.88px') {
            cont.style.top = '21mm';
            cont.style.left = '131mm';
        } else if (currentSize.width === '275px') {
            cont.style.top = '19mm';
            cont.style.left = '129mm';
        }

    } else {
        ladoH = 1;
        contTexto.style.left = '84mm';
        hr.style.left = '81mm';

        img.style.width = currentSize.width;
        img.style.height = currentSize.height;

        if (currentSize.width === '210px') {
            cont.style.top = '21mm';
            cont.style.left = '21mm';
        } else if (currentSize.width === '241.88px') {
            cont.style.top = '19mm';
            cont.style.left = '13mm';
        } else if (currentSize.width === '275px') {
            cont.style.top = '18mm';
            cont.style.left = '6mm';
        }
    }
});

let ladoB = 1;

document.querySelector('#p3SideChange2').addEventListener('click',function(){
    
    let contTexto2 = document.querySelector('.main-text');
    let img01 = document.querySelector('.p2img-02');
    let img02 = document.querySelector('.p2img-03');

    if (ladoB === 1) {
        ladoB = 2;
        contTexto2.style.left = '87mm';
        img01.style.right = '132.8mm';
        img02.style.right = '132.8mm';

    } else {
        ladoB = 1;
        contTexto2.style.left = '10mm';
        img01.style.right = '0mm';
        img02.style.right = '0mm';

    }

});

document.querySelector('#p3DspBtnClearG').addEventListener('click',function(){

    //header
    let img = document.getElementById('logoP3');
    let cont = document.querySelector('.logo4-02');
    let contTexto = document.querySelector('.h4-text-02');
    let hr = document.querySelector('.hr4-02');

    if (img.style.width && img.style.height) {
        currentSize = {
            width: img.style.width,
            height: img.style.height
        };
    }

    ladoH = 1;
    contTexto.style.left = '84mm';
    hr.style.left = '81mm';

    img.style.width = currentSize.width;
    img.style.height = currentSize.height;

    if (currentSize.width === '210px') {
        cont.style.top = '21mm';
        cont.style.left = '21mm';
    } else if (currentSize.width === '241.88px') {
        cont.style.top = '19mm';
        cont.style.left = '13mm';
    } else if (currentSize.width === '275px') {
        cont.style.top = '18mm';
        cont.style.left = '6mm';
    }

    //body
    let contTexto2 = document.querySelector('.main-text');
    let img01 = document.querySelector('.p2img-02');
    let img02 = document.querySelector('.p2img-03');

    ladoB = 1;
    contTexto2.style.left = '10mm';
    img01.style.right = '0mm';
    img02.style.right = '0mm';

});
 */
// opciones titulo
visualizarOpciones('#p3TitleOption', '.p3TitleOptionsDesplg');

// default all titulo
document.querySelector('#p3TitleBtnClearG').addEventListener('click', function(){

    //Color
    document.querySelector('#p3TitleColorPicker').value = '#213280';
    let color = '';
    let text = document.querySelectorAll('.lt4-01');

    text.forEach(p => {
        p.style.color = color;
    });
    //Fuente
/*     let defaultFont = "Arial, sans-serif";
    document.querySelector('#p3TitleFontPicker').value = defaultFont;

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
    }); */
});

// Opciones de título > color
visualizarOpciones('#p3TitleColorOption', '.p3TitleColorDesplg');

document.querySelector('#p3TitleColorSaveButton').addEventListener('click', function(){
    let color = document.querySelector('#p3TitleColorPicker').value;
    let text = document.querySelectorAll('.lt4-01');

    text.forEach(p => {
        p.style.color = color;
    });
});

document.querySelector('#p3TitleColorBtnClear').addEventListener('click', function(){
    document.querySelector('#p3TitleColorPicker').value = '#213280';
    let color = '';
    let text = document.querySelectorAll('.lt4-01');

    text.forEach(p => {
        p.style.color = color;
    });
});

// Opciones de título > fuente
/* visualizarOpciones('#p3TitleFontOption','.p3TitleFontDesplg');

document.querySelector('#p3TitleFontSaveButton').addEventListener('click', function(){
    let font = document.querySelector('#p3TitleFontPicker').value;
    let text = document.querySelectorAll('.lt4-01');

    text.forEach(p => {
        p.style.fontFamily = font;
    });
});

document.querySelector('#p3TitleFontBtnClear').addEventListener('click', function(){
    let defaultFont = "Arial, sans-serif";
    document.querySelector('#p3TitleFontPicker').value = defaultFont;
    let text = document.querySelectorAll('.lt4-01');

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
    });
}); */

// Opciones de texto
visualizarOpciones('#p3TextOption', '.p3TextOptionsDesplg');

//Default all de texto

document.querySelector('#p3TextBtnClearG').addEventListener('click', function(){

    //color
    document.querySelector('#p3TextColorPicker1').value = '#213280';
    document.querySelector('#p3TextColorPicker2').value = '';
    let color = '#213280';
    let color2 = '';
    let text = document.querySelectorAll('.subtitle4');
    let text2 = document.querySelectorAll('.i-list p, .i-txt p, .i-txt2 p, .i-txt3 p, .i-txt4 p, .i-txt5 p, .i-txt6 p');

    text.forEach(p => {
        p.style.color = color;
    });

    text2.forEach(p => {
        p.style.color = color2;
    });
    //fuente
/*     let defaultFont = "Roboto, Arial, sans-serif";
    document.querySelector('#p3TextFontPicker1').value = defaultFont;
    document.querySelector('#p3TextFontPicker2').value = defaultFont;

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
    });
    text2.forEach(p => {
        p.style.fontFamily = defaultFont;
    }); */
});

// Opciones de texto > color
visualizarOpciones('#p3TextColorOption', '.p3TextColorDesplg');

document.querySelector('#p3TextColorSaveButton').addEventListener('click', function(){
    let color = document.querySelector('#p3TextColorPicker1').value;
    let text = document.querySelectorAll('.subtitle4');
    let color2 = document.querySelector('#p3TextColorPicker2').value;
    let text2 = document.querySelectorAll('.i-list p, .i-txt p, .i-txt2 p, .i-txt3 p, .i-txt4 p, .i-txt5 p, .i-txt6');

    text.forEach(p => {
        p.style.color = color;
    });

    text2.forEach(p => {
        p.style.color = color2;
    });
});

document.querySelector('#p3TextColorBtnClear').addEventListener('click', function(){
    document.querySelector('#p3TextColorPicker1').value = '#213280';
    document.querySelector('#p3TextColorPicker2').value = '';
    let color = '#213280';
    let color2 = '';
    let text = document.querySelectorAll('.subtitle4');
    let text2 = document.querySelectorAll('.i-list p, .i-txt p, .i-txt2 p, .i-txt3 p, .i-txt4 p, .i-txt5 p, .i-txt6');

    text.forEach(p => {
        p.style.color = color;
    });

    text2.forEach(p => {
        p.style.color = color2;
    });
});

// Opciones de texto > fuente
/* visualizarOpciones('#p3TextFontOption','.p3TextFontDesplg');

document.querySelector('#p3TextFontSaveButton').addEventListener('click', function(){
    let font = document.querySelector('#p3TextFontPicker1').value;
    let text = document.querySelectorAll('.subtitle4');
    let font2 = document.querySelector('#p3TextFontPicker2').value;
    let text2 = document.querySelectorAll('.i-list p, .i-txt p, .i-txt2 p, .i-txt3 p, .i-txt4 p, .i-txt5 p, .i-txt6 p');

    text.forEach(p => {
        p.style.fontFamily = font;
    });
    text2.forEach(p => {
        p.style.fontFamily = font2;
    });
});

document.querySelector('#p3TextFontBtnClear').addEventListener('click', function(){
    let defaultFont = "Roboto, Arial, sans-serif";
    document.querySelector('#p3TextFontPicker1').value = defaultFont;
    let text = document.querySelectorAll('.subtitle4');
    document.querySelector('#p3TextFontPicker2').value = defaultFont;
    let text2 = document.querySelectorAll('.i-list p, .i-txt p, .i-txt2 p, .i-txt3 p, .i-txt4 p, .i-txt5 p, .i-txt6 p');

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
    });
    text2.forEach(p => {
        p.style.fontFamily = defaultFont;
    });
}); */

// Opciones de ESTILOS
visualizarOpciones('#p3StlOption', '.p3StlOptionsDesplg');

// Default all estilos
document.querySelector('#p3StlBtnClearG').addEventListener('click', function() {

    //Stl01 Display
    let checkbox = document.getElementById('p3Stl01Display');
    let stl01 = document.querySelector('.style-05');
    stl01.style.backgroundColor = '#213280';
    checkbox.checked = true
    //Stl02 Display
    let checkbox2 = document.getElementById('p3Stl02Display');
    let stl02 = document.querySelector('.style-07');
    let texto = document.querySelector('#footerP');
    stl02.style.backgroundColor = '#213280';
    texto.style.color = 'white';
    checkbox2.checked = true
    //Colores 
    let color = '#213280';
    let stl = document.querySelector('.style-05');
    let color2 = '#ffffff';
    let stl2 = document.querySelector('.style-07');
    document.querySelector('#p3StlColorPicker1').value = color;
    document.querySelector('#p3StlColorPicker2').value = color;
    document.querySelector('#p3StlColorPicker3').value = color2;
    stl.style.backgroundColor = color;
    stl2.style.backgroundColor = color;
    texto.style.color = color2;
});

// visualizacion de estilos 
visualizarOpciones('#p3StlDisplayOption', '.p3StlDisplayDesplg');

document.querySelector('#p3Stl01Display').addEventListener('change', function() {
    let checkbox = document.getElementById('p3Stl01Display');
    let stl01 = document.querySelector('.style-05');

    if (checkbox.checked) {
        stl01.style.backgroundColor = '#213280';
    } else {
        stl01.style.backgroundColor = 'white';
    }
});

document.querySelector('#p3Stl02Display').addEventListener('change', function() {
    let checkbox2 = document.getElementById('p3Stl02Display');
    let stl02 = document.querySelector('.style-07');
    let texto = document.querySelector('#footerP');

    if (checkbox2.checked) {
        stl02.style.backgroundColor = '#213280';
        texto.style.color = 'white';
    } else {
        stl02.style.backgroundColor = 'white';
        texto.style.color = 'black';
    }
});

// Opciones de estilos > color
visualizarOpciones('#p3StlColorOption', '.p3StlColorDesplg');

document.querySelector('#p3StlColorSaveButton').addEventListener('click', function(){
    let color = document.querySelector('#p3StlColorPicker1').value;
    let stl = document.querySelector('.style-05');
    let color2 = document.querySelector('#p3StlColorPicker2').value;
    let stl2 = document.querySelector('.style-07');
    let color3 = document.querySelector('#p3StlColorPicker3').value;
    let texto = document.querySelector('#footerP');

    stl.style.backgroundColor = color;
    stl2.style.backgroundColor = color2;
    texto.style.color = color3;
});

document.querySelector('#p3StlColorBtnClear').addEventListener('click', function(){

    let color = '#213280';
    let stl = document.querySelector('.style-05');
    let color2 = '#ffffff';
    let stl2 = document.querySelector('.style-07');
    let texto = document.querySelector('#footerP');

    document.querySelector('#p3StlColorPicker1').value = color;
    document.querySelector('#p3StlColorPicker2').value = color;
    document.querySelector('#p3StlColorPicker3').value = color2;

    stl.style.backgroundColor = color;
    stl2.style.backgroundColor = color;
    texto.style.color = color2;
});
