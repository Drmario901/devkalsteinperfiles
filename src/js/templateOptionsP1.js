
function ajustarAnchoRow() {
    let asideWidth = document.querySelector('#aside').getBoundingClientRect().width;
    let rowGenerar = document.querySelector('#rowGenerar');
    rowGenerar.style.width = `${asideWidth}px`;
}

const resizeObserver = new ResizeObserver(ajustarAnchoRow);
resizeObserver.observe(document.querySelector('#aside'));

ajustarAnchoRow();


var areElementsVisible = false;
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

/* OPCIONES PAGINA 1 */
/* OPCIONES PAGINA 1 */
/* OPCIONES PAGINA 1 */

/* mostrar opciones pagina 1 */
document.querySelector('#pagina1Div').addEventListener('click', function() {
    let titleOption = document.querySelector('#titleDiv');
    let p1ImgOption = document.querySelector('#p1ImgDiv');
    let p1FooterOption = document.querySelector('#p1FooterDiv');
    let generalSL = document.querySelector('#pagina1SeparationLine');
    let optionsSL = document.querySelector('#titleSeparationLine');
    let p1ImgOSL = document.querySelector('#p1ImgSeparationLine');
    let p1FooterOSL = document.querySelector('#p1FooterSeparationLine');
    let titleOptions = document.querySelector('#titleOptions');
    let p1ImgOptions = document.querySelector('#p1ImgOptions0');
    let p1FooterOptions = document.querySelector('#p1FooterOptions');
    let titleBtnClearG = document.querySelector('#titleBtnClearG');
    let p1ImgBtnClearG = document.querySelector('#p1ImgBtnClearG');
    let p1FooterBtnClearG = document.querySelector('#p1FooterBtnClearG');
    
    if (areElementsVisible){
        titleOption.style.display = "none";
        p1ImgOption.style.display = "none";
        p1FooterOption.style.display = "none";
        generalSL.style.display = "none";
        if (titleOptions.style.display === "block") {
            titleOptions.style.display = "none";
            optionsSL.style.display = "none";
            titleBtnClearG.style.display = "none";
        }
        if (p1ImgOptions.style.display === "block"){
            p1ImgOptions.style.display = "none";
            p1ImgOSL.style.display = "none";
            p1ImgBtnClearG.style.display = "none";
        }
        if (p1FooterOptions.style.display === "block"){
            p1FooterOptions.style.display = "none";
            p1FooterOSL.style.display = "none";
            p1FooterBtnClearG.style.display = "none";
        }
    } else{
        titleOption.style.display = "flex";
        p1ImgOption.style.display = "flex";
        p1FooterOption.style.display = "flex";
        generalSL.style.display = "block"
    }
 
    areElementsVisible = !areElementsVisible;
    
});

/* PAGINA 1> Titulo */

// visualizar opciones titulo
document.querySelector('#titleDiv').addEventListener('click', function(event) {
    // Verificar si el clic se produjo en #titleBtnClearG
    if (!event.target.closest('#titleBtnClearG')) {
        // Ejecutar la función que se activa al hacer clic en #titleDiv
        let titleBtnClearG = document.querySelector('#titleBtnClearG');
/*         let titleDispositionOption = document.querySelector('#titleDispositionOption'); */
        let titleTextOption = document.querySelector('#titleTextOption');
        let titleColorOption = document.querySelector('#titleColorOption');
        /* let titleSizeOption = document.querySelector('#titleSizeOption'); */
/*         let titleFontOption = document.querySelector('#titleFontOption'); */
        let titleAlignOption = document.querySelector('#titleAlignOption');
        let titleBoldOption = document.querySelector('#titleBoldOption');
        let titleOptions = document.querySelector('#titleOptions');
        let titleSeparationLine = document.querySelector('#titleSeparationLine');

        if (areElementsVisible) {
            titleBtnClearG.style.display = 'none';
            titleTextOption.style.display = 'none';
            titleColorOption.style.display = 'none';
            /* titleSizeOption.style.display = 'none'; */
            /* titleFontOption.style.display = 'none'; */
            titleAlignOption.style.display = 'none';
            titleBoldOption.style.display = 'none';
            titleOptions.style.display = 'none';
            titleSeparationLine.style.display = 'none';
/*             titleDispositionOption = 'none'; */
        } else {
            titleBtnClearG.style.display = 'block';
            titleTextOption.style.display = 'block';
            titleColorOption.style.display = 'block';
            /* titleSizeOption.style.display = 'block'; */
            /* titleFontOption.style.display = 'block'; */
            titleAlignOption.style.display = 'block';
            titleBoldOption.style.display = 'block';
            titleOptions.style.display = 'block';
            titleSeparationLine.style.display = 'block';
/*             titleDispositionOption.style.display = 'block'; */
        }

        areElementsVisible = !areElementsVisible;
    }
});

// default all titulo
document.querySelector('#titleBtnClearG').addEventListener('click', function() {

    let nIdElement = document.querySelector('.n-id');
    let p1Img01 = document.querySelector('#p1Img01');
    let p1Img02 = document.querySelector('#p1Img02');
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    let t4 = document.querySelector('.id-n');
    let titleTextPicker1 = document.querySelector('#titleTextPicker1');
    let charCount1 = document.querySelector('#charCount1');
/*     let titleTextPicker2 = document.querySelector('#titleTextPicker2');
    let charCount2 = document.querySelector('#charCount2'); */
    let titleTextPicker3 = document.querySelector('#titleTextPicker3');
    let charCount3 = document.querySelector('#charCount3');
/*     let titleFontPicker1 = document.querySelector('#titleFontPicker1');
    let titleFontPicker2 = document.querySelector('#titleFontPicker2');
    let titleFontPicker3 = document.querySelector('#titleFontPicker3'); */
/*     let titleSizePicker = document.querySelector('#titleSizePicker');
    let titleSizePicker2 = document.querySelector('#titleSizePicker2');
    let titleSizePicker3 = document.querySelector('#titleSizePicker3'); */
    let titleColorPicker = document.querySelector('#titleColorPicker1');
    let titleColorPicker2 = document.querySelector('#titleColorPicker2');
    let titleColorPicker3 = document.querySelector('#titleColorPicker3');
    let titleBoldPicker = document.querySelector('#titleBoldPicker');
    let titleBoldPicker2 = document.querySelector('#titleBoldPicker2');
    let titleBoldPicker3 = document.querySelector('#titleBoldPicker3');
    let displayCheckboxImg02 = document.querySelector('#p1Img02Display');
/*     let defaultSize = "18";
    let defaultSize2 = "45";
    let defaultSize3 = "12"; */

    // textDefault
    let defaultContent1 = "COTIZACIÓN";
    titleTextPicker1.value = defaultContent1;
    t1.textContent = defaultContent1;
    charCount1.textContent = "10 / 30 caracteres";

    let defaultContent3 = "UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO";
    titleTextPicker3.value = defaultContent3;
    t3.textContent = defaultContent3;
    charCount3.textContent = "42 / 80 caracteres";

    // colorDefault
    t1.style.color = '';
    t2.style.color = '#213280';
    t4.style.color = '#213280';
    t3.style.color = '';
    titleColorPicker.value = '#000';
    titleColorPicker2.value = '#213280';
    titleColorPicker3.value = '#000';

    // fontDefault
/*     titleFontPicker1.value = "Arial, sans-serif";
    titleFontPicker2.value = "Arial, sans-serif";
    titleFontPicker3.value = "Arial, sans-serif";
    t1.style.fontFamily = "Arial, sans-serif";
    t2.style.fontFamily = "Arial, sans-serif";
    t4.style.fontFamily = "Arial, sans-serif";
    t3.style.fontFamily = "Arial, sans-serif"; */

    // sizeDefault
/*     t1.style.fontSize = defaultSize + 'px';
    t2.style.fontSize = defaultSize2 + 'px';
    t4.style.fontSize = defaultSize2 + 'px';
    t3.style.fontSize = defaultSize3 + 'px';
    titleSizePicker.value = defaultSize;
    titleSizePicker2.value = defaultSize2;
    titleSizePicker3.value = defaultSize3; */
    t1.style.marginTop = "";
    t1.style.marginLeft = "";
    t1.style.marginBottom = "";
    t2.style.marginTop = "";
    t2.style.marginLeft = "";
    t2.style.marginBottom = "";
    t4.style.marginTop = "";
    t4.style.marginLeft = "";
    t4.style.marginBottom = "";
    t3.style.marginTop = "";
    t3.style.marginLeft = "";
    t3.style.marginBottom = "";

    // boldDefault
    t1.style.fontWeight = 'normal';
    titleBoldPicker.checked = false; 
    t2.style.fontWeight = 'bold';
    t4.style.fontWeight = 'bold';
    titleBoldPicker2.checked = true; 
    t3.style.fontWeight = 'bold';
    titleBoldPicker3.checked = true; 

    // AlignDefault
    t1.style.textAlign = 'left';
    t2.style.textAlign = 'left';
    t4.style.textAlign = 'left';
    t3.style.textAlign = 'left';

    // Disposition
    originalStyles = {
        sm: { width: '233.39px', height: '70.22px',  left: '130px', position: 'absolute', top: '158.2mm' },
        md: { width: '287.86px', height: '84.72px', left: '90px', position: 'absolute', top: '158.2mm' },
        lg: { width: '342.31px', height: '99.22px', left: '34px', position: 'absolute', top: '158.2mm' },
        up1: { top: '161.6mm' },
        up2: { top: '158.2mm' },
        up3: { top: '154.8mm' }
    };

    /* lado = 1; */
/*     nIdElement.style.left = '54%';
    p1Img02.style.display = 'block';
    p1Img02.style.left = '90px';
    p1Img02.style.width = '37%';
    p1Img02.style.top = '159mm'; */
    /* checkbox0.checked = true;
    checkbox1.checked = false;
    checkbox2.checked = false;
    checkbox0.disabled = true;
    checkbox1.disabled = false;
    checkbox2.disabled = false;
    toggleSideChangeHandler(true); */
    displayCheckboxImg02.checked = true;
});

// opciones disposicion
/* document.querySelector('#titleDispositionOption').addEventListener('click', function(){
    
    let p1ImgOptionsFlexList = document.querySelectorAll('.p1TitleOptionsFlex');
    let labelList = document.querySelectorAll('.p1TitleDisplayLabel');
    let p1TitleDisplay0 = document.querySelector('#p1TitleDisplay0');
    let p1TitleDisplay1 = document.querySelector('#p1TitleDisplay1');
    let p1TitleDisplay2 = document.querySelector('#p1TitleDisplay2');
    let p1SideChange = document.querySelector('#p1SideChange');

    if(areElementsVisible) {
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        labelList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        p1TitleDisplay0.style.display = 'none';
        p1TitleDisplay1.style.display = 'none';
        p1TitleDisplay2.style.display = 'none';
        p1SideChange.style.display = 'none';
    } else {
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'flex';
        });
        labelList.forEach(function(flex) {
            flex.style.display = 'block';
        });
        p1TitleDisplay0.style.display = 'block';
        p1TitleDisplay1.style.display = 'block';
        p1TitleDisplay2.style.display = 'block';
        p1SideChange.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

});

//selecionar un solo checkbox
const checkbox0 = document.getElementById('p1TitleDisplay0');
const checkbox1 = document.getElementById('p1TitleDisplay1');
const checkbox2 = document.getElementById('p1TitleDisplay2');
let disp = 0;
//Cambiar lado
let lado = 1;
let originalStyles;
if(disp === 0){
originalStyles = {
     sm: { width: '233.39px', height: '70.22px', left: '130px', position: 'absolute', top: '158.2mm' },
     md: { width: '287.86px', height: '84.72px', left: '90px', position: 'absolute', top: '158.2mm' },
     lg: { width: '342.31px', height: '99.22px', left: '34px', position: 'absolute', top: '158.2mm' },
     up1: { top: '161.6mm' },
     up2: { top: '158.2mm' },
     up3: { top: '154.8mm' }
};

} else if (disp ===1){
    originalStyles = {
        sm: { width: '233.39px', height: '70.22px', left: '276px', position: 'absolute', top: '158.2mm' },
        md: { width: '287.86px', height: '84.72px', left: '256px;', position: 'absolute', top: '158.2mm' },
        lg: { width: '342.31px', height: '99.22px', left: '214px', position: 'absolute', top: '158.2mm' },
        up1: { top: '161.6mm' },
        up2: { top: '158.2mm' },
        up3: { top: '154.8mm' }
   };
} else if (disp ===2) {
    originalStyles = "";
}

const sideChangeHandler = function() {
        let nIdElement = document.querySelector('.n-id');
        let img = document.querySelector('#p1Img02');
        let currentWidth = img.style.width;
        let t1 = document.querySelector('.co');
        let t2 = document.querySelector('.id-title');
        let t3 = document.querySelector('.msj');

        if(disp === 0){
        if (lado === 1) {
            lado = 2;
            nIdElement.style.left = '6%';
            if (currentWidth === '233.39px') {
                img.style.left = '410px';
            } else {
                img.style.left = '415px';
            }
            originalStyles = {
                sm: { width: '233.39px', height: '70.22px', left: '410px', position: 'absolute', top: '158.2mm' },
                md: { width: '287.86px', height: '84.72px', left: '415px', position: 'absolute', top: '158.2mm' },
                lg: { width: '342.31px', height: '99.22px', left: '415px', position: 'absolute', top: '158.2mm' },
                up1: { top: '161.6mm' },
                up2: { top: '158.2mm' },
                up3: { top: '154.8mm' }
            };

            t1.style.textAlign = 'right';
            t2.style.textAlign = 'right';
            t3.style.textAlign = 'right';
        } else {
            lado = 1;

            nIdElement.style.left = '54%';

            if (currentWidth === '233.39px') {
                img.style.left = '130px';
            } else if (currentWidth === '287.86px') {
                img.style.left = '90px';
            } else if (currentWidth === '342.31px') {
                img.style.left = '34px';
            }
            
            img.style.width = currentWidth;
            originalStyles = {
                sm: { width: '233.39px', height: '70.22px', left: '130px', position: 'absolute', top: '158.2mm' },
                md: { width: '287.86px', height: '84.72px', left: '90px', position: 'absolute', top: '158.2mm' },
                lg: { width: '342.31px', height: '99.22px', left: '34px', position: 'absolute', top: '158.2mm' },
                up1: { top: '161.6mm' },
                up2: { top: '158.2mm' },
                up3: { top: '154.8mm' }
            };

            t1.style.textAlign = 'left';
            t2.style.textAlign = 'left';
            t3.style.textAlign = 'left';
        }
        }
};

const toggleSideChangeHandler = function(enabled) {
    document.querySelectorAll('.p1SideChange1').forEach(function(element) {
        if (enabled) {
            element.addEventListener('click', sideChangeHandler);
        } else {
            element.removeEventListener('click', sideChangeHandler);
        }
    });
};

checkbox0.addEventListener('change', function() {
    if (this.checked) {
        checkbox1.checked = false;
        checkbox2.checked = false;
        checkbox0.disabled = true;
        checkbox1.disabled = false;
        checkbox2.disabled = false;
        toggleSideChangeHandler(true);

        let checkimg02 = document.querySelector('#p1Img02Display');
        checkimg02.checked = true;
        checkimg02.disabled = false;
        disp = 0;
    }
});

checkbox1.addEventListener('change', function() {
    if (this.checked) {
        checkbox0.checked = false;
        checkbox2.checked = false;
        checkbox1.disabled = true;
        checkbox0.disabled = false;
        checkbox2.disabled = false;
        toggleSideChangeHandler(false);

        let checkimg02 = document.querySelector('#p1Img02Display');
        checkimg02.checked = true;
        checkimg02.disabled = false;
        disp = 1;
    }
});

checkbox2.addEventListener('change', function() {
    if (this.checked) {
        checkbox0.checked = false;
        checkbox1.checked = false;
        checkbox2.disabled = true;
        checkbox0.disabled = false;
        checkbox1.disabled = false;
        toggleSideChangeHandler(false);

        let checkimg02 = document.querySelector('#p1Img02Display');
        checkimg02.checked = false;
        checkimg02.disabled = true;
        disp = 2;
    }
});

if (checkbox0.checked) {
    toggleSideChangeHandler(true);
} else {
    toggleSideChangeHandler(false);
}

checkbox0.addEventListener('click', function(){
    let nIdElement = document.querySelector('.n-id');
    let img = document.querySelector('#p1Img02');
    let currentWidth = img.style.width;
    let hr = document.querySelector('.hr');
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    disp = 0;
    img.style.display = 'block';
    nIdElement.style.display = 'block';
    hr.style.display = 'block';
    if(disp === 0){
    if (lado === 2) {
        nIdElement.style.left = '6%';
        if (currentWidth === '233.39px') {
            img.style.left = '410px';
        } else {
            img.style.left = '415px';
        }
        originalStyles = {
            sm: { width: '233.39px', height: '70.22px', left: '410px', position: 'absolute', top: '158.2mm' },
            md: { width: '287.86px', height: '84.72px', left: '415px', position: 'absolute', top: '158.2mm' },
            lg: { width: '342.31px', height: '99.22px', left: '415px', position: 'absolute', top: '158.2mm' },
            up1: { top: '161.6mm' },
            up2: { top: '158.2mm' },
            up3: { top: '154.8mm' }
        };
    
        t1.style.textAlign = 'right';
        t2.style.textAlign = 'right';
        t3.style.textAlign = 'right';
    } else {
        nIdElement.style.left = '54%';

        if (currentWidth === '233.39px') {
            img.style.left = '130px';
        } else if (currentWidth === '287.86px') {
            img.style.left = '90px';
        } else if (currentWidth === '342.31px') {
            img.style.left = '34px';
        }
        
        img.style.width = currentWidth;
        originalStyles = {
            sm: { width: '233.39px', height: '70.22px', left: '130px', position: 'absolute', top: '158.2mm' },
            md: { width: '287.86px', height: '84.72px', left: '90px', position: 'absolute', top: '158.2mm' },
            lg: { width: '342.31px', height: '99.22px', left: '34px', position: 'absolute', top: '158.2mm' },
            up1: { top: '161.6mm' },
            up2: { top: '158.2mm' },
            up3: { top: '154.8mm' }
        };

        t1.style.textAlign = 'left';
        t2.style.textAlign = 'left';
        t3.style.textAlign = 'left';
    }
    }
});

checkbox1.addEventListener('click',function(){
    let nIdElement = document.querySelector('.n-id');
    let img = document.querySelector('#p1Img02');
    let currentWidth = img.style.width;
    let hr = document.querySelector('.hr');
    disp = 1;
    img.style.display = 'block';
    nIdElement.style.display = 'none';
    hr.style.display = 'none';

    if (currentWidth === '233.39px') {
        img.style.left = '276px';
    } else if (currentWidth === '287.86px') {
        img.style.left = '256px';
    } else if (currentWidth === '342.31px') {
        img.style.left = '214px';
    } 

    originalStyles = {
        sm: { width: '233.39px', height: '70.22px', left: '276px', position: 'absolute', top: '158.2mm' },
        md: { width: '287.86px', height: '84.72px', left: '256px', position: 'absolute', top: '158.2mm' },
        lg: { width: '342.31px', height: '99.22px', left: '214px', position: 'absolute', top: '158.2mm' },
        up1: { top: '161.6mm' },
        up2: { top: '158.2mm' },
        up3: { top: '154.8mm' }
    };

    
});

checkbox2.addEventListener('click',function(){
    let nIdElement = document.querySelector('.n-id');
    let img = document.querySelector('#p1Img02');
    let hr = document.querySelector('.hr');
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    disp = 2;
    img.style.display = 'none';
    nIdElement.style.display = 'block';
    hr.style.display = 'none';

    nIdElement.style.left = '242px';
    t1.style.textAlign = 'center';
    t2.style.textAlign = 'center';
    t3.style.textAlign = 'center';
}); */

// opciones texto del titulo
document.querySelector('#titleTextOption').addEventListener('click', function() {
    let t1 = document.querySelector('.co');
    let t3 = document.querySelector('.msj');
    let t1Empty = false;
    let t3Empty = false;  
    let titleSaveButton = document.querySelector('#titleSaveButton');
    let titleBtnClear = document.querySelector('#titleBtnClear');
    let label1 = document.querySelector('#p1TitleTextLabel1');
    let titleTextPicker1 = document.querySelector('#titleTextPicker1');
    let charCount1 = document.querySelector('#charCount1');
    let label3 = document.querySelector('#p1TitleTextLabel3');
    let titleTextPicker3 = document.querySelector('#titleTextPicker3');
    let charCount3 = document.querySelector('#charCount3');
    
    if (areElementsVisible) {
        titleSaveButton.style.display = 'none';
        titleBtnClear.style.display = 'none';
        label1.style.display = 'none';
        titleTextPicker1.style.display = 'none';
        charCount1.style.display = 'none';
        label3.style.display = 'none';
        titleTextPicker3.style.display = 'none';
        charCount3.style.display = 'none';
    } else {
        titleSaveButton.style.display = 'block';
        titleBtnClear.style.display = 'block';
        label1.style.display = 'block';
        titleTextPicker1.style.display = 'block';
        charCount1.style.display = 'block';
        label3.style.display = 'block';
        titleTextPicker3.style.display = 'block';
        charCount3.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

    titleSaveButton.addEventListener('click', function() {
        
        t1.textContent = titleTextPicker1.value;
        t3.textContent = titleTextPicker3.value;

/*         if (t1Empty === true) {
            t1.style.marginBottom = '10px';
            if (t3Empty === true) {
                t1.style.marginTop = '20px'; 
            }
        } else if (t1Empty === false) {
            t1.style.marginTop = '46px';
            if (t3Empty === true) {
                t1.style.marginTop = '45px'; 
            }
        } else if (t1Empty === true) {
            t1.style.marginBottom = '10px';
            if (t3Empty === true) {
                t1.style.marginTop = '50px'; 
            }
        } else if (t1Empty === false) {
            t1.style.marginBottom = '-23px';
            if (t3Empty === true) {
                t1.style.marginTop = '12px'; 
            }
        } */

/*         if (t1Empty === true && t2Empty === false) {
            t1.style.marginBottom = '10px';
            t2.style.marginBottom = '-15px';
            if (t3Empty === true) {
                t1.style.marginTop = '20px'; 
            }
        } else if (t1Empty === false && t2Empty === true) {
            t2.style.marginBottom = '20px';
            t1.style.marginTop = '46px';
            if (t3Empty === true) {
                t1.style.marginTop = '45px'; 
            }
        } else if (t1Empty === true && t2Empty === true) {
            t2.style.marginBottom = '10px';
            t1.style.marginBottom = '10px';
            if (t3Empty === true) {
                t1.style.marginTop = '50px'; 
            }
        } else if (t1Empty === false && t2Empty === false) {
            t2.style.marginBottom = '-15px';
            t1.style.marginBottom = '-23px';
            if (t3Empty === true) {
                t1.style.marginTop = '12px'; 
            }
        } */
        
    });

    titleBtnClear.addEventListener('click', function() {
        
        let defaultContent1 = "COTIZACIÓN";
        titleTextPicker1.value = defaultContent1;
        t1.textContent = defaultContent1;
        charCount1.textContent = "10 / 30 caracteres";

        let defaultContent3 = "UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO";
        titleTextPicker3.value = defaultContent3;
        t3.textContent = defaultContent3;
        charCount3.textContent = "42 / 80 caracteres";

        if (titleTextPicker1.value.trim().length === 0) {
            t1Empty = true;
        } else {
            t1Empty = false;
        }

        if (titleTextPicker3.value.trim().length === 0) {
            t3Empty = true;
        } else {
            t3Empty = false;
        }

        t1.style.marginTop = "";
        t1.style.marginLeft = "";
        t1.style.marginBottom = "";
        t3.style.marginTop = "";
        t3.style.marginLeft = "";
        t3.style.marginBottom = "";
    });

    titleTextPicker1.addEventListener('input', function() {

        let text1 = titleTextPicker1.value;
        let charLimit1 = 30;
        let remainingChars1 = charLimit1 - text1.length;
        
        if (remainingChars1 >= 0) {
            charCount1.textContent = `${text1.length} / 30 caracteres`;
        } else {
            titleTextPicker1.value = text1.substring(0, charLimit1);
            charCount1.textContent = `10 / 30 caracteres`;
        }
        if (text1.trim().length === 0) {
            t1Empty = true;
        } else {
            t1Empty = false;
        }
    });

    titleTextPicker3.addEventListener('input', function() {

        let text3 = titleTextPicker3.value;
        let charLimit3 = 80;
        let remainingChars3 = charLimit3 - text3.length;
        if (remainingChars3 >= 0) {
            charCount3.textContent = `${text3.length} / 80 caracteres`;
        } else {
            titleTextPicker3.value = text3.substring(0, charLimit3);
            charCount3.textContent = `80 / 80 caracteres`;
        }
        if (text3.trim().length === 0) {
            t3Empty = true;
        } else {
            t3Empty = false;
        }
    });
});

/* opciones color titulo */
document.querySelector('#titleColorOption').addEventListener('click', function() {
let t1 = document.querySelector('.co');
let t2 = document.querySelector('.id-title');
let t3 = document.querySelector('.msj');
let t4 = document.querySelector('.id-n');

let titleColorPicker1 = document.querySelector('#titleColorPicker1');
let titleColorPicker2 = document.querySelector('#titleColorPicker2');
let titleColorPicker3 = document.querySelector('#titleColorPicker3');
let colorSaveButton = document.querySelector('#colorSaveButton');
let colorBtnClear = document.querySelector('#colorBtnClear');
let container = this.parentElement; 
let labelElements = container.querySelectorAll('.labelColorOption'); 

if (areElementsVisible) {

    titleColorPicker1.style.display = 'none';
    titleColorPicker2.style.display = 'none';
    titleColorPicker3.style.display = 'none';
    colorSaveButton.style.display = 'none';
    colorBtnClear.style.display = 'none';
    labelElements.forEach(function(label) {
        label.style.display = 'none'; 
    }); 
} else {
    
    titleColorPicker1.style.display = 'block';
    titleColorPicker2.style.display = 'block';
    titleColorPicker3.style.display = 'block';
    colorSaveButton.style.display = 'block';
    colorBtnClear.style.display = 'block';
    labelElements.forEach(function(label) {
        label.style.display = 'block'; 
    }); 
}

areElementsVisible = !areElementsVisible;

colorSaveButton.addEventListener('click', function() {
    
    t1.style.color = titleColorPicker1.value;
    t2.style.color = titleColorPicker2.value;
    t3.style.color = titleColorPicker3.value;
    t4.style.color = titleColorPicker2.value;
});

colorBtnClear.addEventListener('click', function() {
    titleColorPicker1.value = '#000';
    titleColorPicker2.value = '#213280';
    titleColorPicker3.value = '#000';
    t1.style.color = '';
    t2.style.color = '#213280';
    t3.style.color = '';
    t4.style.color = '#213280';
});

});

/* opciones fuente del titulo */
/* document.querySelector('#titleFontOption').addEventListener('click', function() {
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    let t4 = document.querySelector('.id-n');
    let titleFontPicker1 = document.querySelector('#titleFontPicker1');
    let titleFontPicker2 = document.querySelector('#titleFontPicker2');
    let titleFontPicker3 = document.querySelector('#titleFontPicker3');
    let fontSaveButton = document.querySelector('#fontSaveButton');
    let fontBtnClear = document.querySelector('#fontBtnClear');
    let container = this.nextElementSibling; 
    let labelElements = container.querySelectorAll('.labelFontOption');

    let defaultFont = "Arial, sans-serif";

    if (areElementsVisible) {
        titleFontPicker1.style.display = 'none';
        titleFontPicker2.style.display = 'none';
        titleFontPicker3.style.display = 'none';
        fontSaveButton.style.display = 'none';
        fontBtnClear.style.display = 'none';
        labelElements.forEach(function(label) {
            label.style.display = 'none';
        });
    } else {
        titleFontPicker1.style.display = 'block';
        titleFontPicker2.style.display = 'block';
        titleFontPicker3.style.display = 'block';
        fontSaveButton.style.display = 'block';
        fontBtnClear.style.display = 'block';
        labelElements.forEach(function(label) {
            label.style.display = 'block';
        });
    }

    areElementsVisible = !areElementsVisible;

    fontSaveButton.addEventListener('click', function() {
        let selectedFont = titleFontPicker1.value;
        let selectedFont2 = titleFontPicker2.value;
        let selectedFont3 = titleFontPicker3.value;
        t1.style.fontFamily = selectedFont;
        t2.style.fontFamily = selectedFont2;
        t4.style.fontFamily = selectedFont2;
        t3.style.fontFamily = selectedFont3;
    });

    fontBtnClear.addEventListener('click', function() {
        titleFontPicker1.value = defaultFont;
        titleFontPicker2.value = defaultFont;
        titleFontPicker3.value = defaultFont;
        t1.style.fontFamily = defaultFont;
        t2.style.fontFamily = defaultFont;
        t4.style.fontFamily = defaultFont;
        t3.style.fontFamily = defaultFont;
    });
}); */


/* negritas titulo */
document.querySelector('#titleBoldOption').addEventListener('click', function() {
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    let t4 = document.querySelector('.id-n');
    let titleBoldPicker = document.querySelector('#titleBoldPicker');
    let titleBoldLabel = document.querySelector('#titleBoldLabel');
    let titleBoldPicker2 = document.querySelector('#titleBoldPicker2');
    let titleBoldLabel2 = document.querySelector('#titleBoldLabel2');
    let titleBoldPicker3 = document.querySelector('#titleBoldPicker3');
    let titleBoldLabel3 = document.querySelector('#titleBoldLabel3');
 
    if (areElementsVisible) {
        titleBoldPicker.style.display = 'none';
        titleBoldLabel.style.display = 'none';
        titleBoldPicker2.style.display = 'none';
        titleBoldLabel2.style.display = 'none';
        titleBoldPicker3.style.display = 'none';
        titleBoldLabel3.style.display = 'none';
    } else {  
        titleBoldPicker.style.display = 'block';
        titleBoldLabel.style.display = 'block';
        titleBoldPicker2.style.display = 'block';
        titleBoldLabel2.style.display = 'block';
        titleBoldPicker3.style.display = 'block';
        titleBoldLabel3.style.display = 'block';
    }
    
    areElementsVisible = !areElementsVisible;

    titleBoldPicker.addEventListener('change', function() {

        if (titleBoldPicker.checked) {
            t1.style.fontWeight = 'bold';
        } else {
            t1.style.fontWeight = 'normal';
        }
    });
    titleBoldPicker2.addEventListener('change', function() {

        if (titleBoldPicker2.checked) {
            t2.style.fontWeight = 'bold';
            t4.style.fontWeight = 'bold';
        } else {
            t2.style.fontWeight = 'normal';
            t4.style.fontWeight = 'normal';
        }
    });
    titleBoldPicker3.addEventListener('change', function() {

        if (titleBoldPicker3.checked) {
            t3.style.fontWeight = 'bold';
        } else {
            t3.style.fontWeight = 'normal';
        }
    });

});


/* opciones tamaño fuente del titulo */
/* document.querySelector('#titleSizeOption').addEventListener('click', function() {
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    let t4 = document.querySelector('.id-n');
    let titleSizePicker = document.querySelector('#titleSizePicker');
    let titleSizePicker2 = document.querySelector('#titleSizePicker2');
    let titleSizePicker3 = document.querySelector('#titleSizePicker3');
    let sizeSaveButton = document.querySelector('#sizeSaveButton');
    let sizeBtnClear = document.querySelector('#sizeBtnClear');
    let container = this.parentElement; 
    let labelElements = container.querySelectorAll('.labelSizeOption'); 

    const defaultSize = "18";
    const defaultSize2 = "45";
    const defaultSize3 = "12";

    if (areElementsVisible) {
        titleSizePicker.style.display = 'none';
        titleSizePicker2.style.display = 'none';
        titleSizePicker3.style.display = 'none';
        sizeSaveButton.style.display = 'none';
        sizeBtnClear.style.display = 'none';
        labelElements.forEach(function(label) {
            label.style.display = 'none'; 
        });
    } else {
        titleSizePicker.style.display = 'block';
        titleSizePicker2.style.display = 'block';
        titleSizePicker3.style.display = 'block';
        sizeSaveButton.style.display = 'block';
        sizeBtnClear.style.display = 'block';
        labelElements.forEach(function(label) {
            label.style.display = 'block'; 
        });
    }

    areElementsVisible = !areElementsVisible;

    sizeSaveButton.addEventListener('click', function() {
        let selectedSize = titleSizePicker.value;
        let selectedSize2 = titleSizePicker2.value;
        let selectedSize3 = titleSizePicker3.value;

        t1.style.fontSize = selectedSize + 'px';
        t2.style.fontSize = selectedSize2 + 'px';
        t4.style.fontSize = selectedSize2 + 'px';
        t3.style.fontSize = selectedSize3 + 'px';

        const size1 = parseInt(selectedSize);
        const size2 = parseInt(selectedSize2);
        const size3 = parseInt(selectedSize3);

        switch (true) {
            case size2 >= 30 && size2 <= 40 :
                t2.style.marginTop = "6px !important";
                t2.style.marginLeft = "-5px";
                t2.style.marginBottom = "";
                break;
                case size2 >= 20 && size2 <= 30 :
                    t2.style.marginTop = "8px !important";
                    t2.style.marginLeft = "-5px";
                    t2.style.marginBottom = "";
                    break;
                    case size2 >= 10 && size2 <= 20 :
                        t2.style.marginTop = "8px !important";
                        t2.style.marginLeft = "-5px";
                        t2.style.marginBottom = "";
                        break;
            default:
                t2.style.marginTop = "";
                t2.style.marginLeft = "";
                t2.style.marginBottom = "";
                break;
        } 

    });

    sizeBtnClear.addEventListener('click', function() {
        t1.style.fontSize = defaultSize + 'px';
        t2.style.fontSize = defaultSize2 + 'px';
        t4.style.fontSize = defaultSize2 + 'px';
        t3.style.fontSize = defaultSize3 + 'px';
        titleSizePicker.value = defaultSize;
        titleSizePicker2.value = defaultSize2;
        titleSizePicker3.value = defaultSize3;
        t1.style.marginTop = "";
        t1.style.marginLeft = "";
        t1.style.marginBottom = "";
        t2.style.marginTop = "";
        t2.style.marginLeft = "";
        t2.style.marginBottom = "";
        t4.style.marginTop = "";
        t4.style.marginLeft = "";
        t4.style.marginBottom = "";
        t3.style.marginTop = "";
        t3.style.marginLeft = "";
        t3.style.marginBottom = "";
    });
}); */

/* opciones alineacion del titulo */
document.querySelector('#titleAlignOption').addEventListener('click', function() {
    let t1 = document.querySelector('.co');
    let t2 = document.querySelector('.id-title');
    let t3 = document.querySelector('.msj');
    let t4 = document.querySelector('.id-n');
    let alignBtnLeft = document.querySelector('#alignBtnLeft');
    let alignBtnCenter = document.querySelector('#alignBtnCenter');
    let alignBtnRight = document.querySelector('#alignBtnRight');
    let alignBtnJustify = document.querySelector('#alignBtnJustify');
 
    if (areElementsVisible) {
        alignBtnLeft.style.display = 'none';
        alignBtnCenter.style.display = 'none';
        alignBtnRight.style.display = 'none';
        alignBtnJustify.style.display = 'none';
    } else {  
        alignBtnLeft.style.display = 'block';
        alignBtnCenter.style.display = 'block';
        alignBtnRight.style.display = 'block';
        alignBtnJustify.style.display = 'block';
    }
    
    alignBtnLeft.addEventListener('click', function() {
        t1.style.textAlign = 'left';
        t2.style.textAlign = 'left';
        t4.style.textAlign = 'left';
        t3.style.textAlign = 'left';
    });

    alignBtnCenter.addEventListener('click', function() {
        t1.style.textAlign = 'center';
        t2.style.textAlign = 'center';
        t4.style.textAlign = 'center';
        t3.style.textAlign = 'center';
    });

    alignBtnRight.addEventListener('click', function() {
        t1.style.textAlign = 'right';
        t2.style.textAlign = 'right';
        t4.style.textAlign = 'right';
        t3.style.textAlign = 'right';
    });

    alignBtnJustify.addEventListener('click', function() {
        t1.style.textAlign = 'justify';
        t2.style.textAlign = 'justify';
        t4.style.textAlign = 'justify';
        t3.style.textAlign = 'justify';
    });

    areElementsVisible = !areElementsVisible;

});

/* FIN OPCIONES DEL TITULO */

/* PAGINA 1 > IMAGENES */

// visualizar opciones imagenes
document.querySelector('#p1ImgDiv').addEventListener('click', function(event) {
    if (!event.target.closest('#p1Img01BtnClearG') && !event.target.closest('#p1Img02BtnClearG') && !event.target.closest('#p1Img03BtnClearG')) {
    let p1BackgroundOptions = document.querySelector('#p1BackgroundOptions');
    let p1QROptions = document.querySelector('#p1QROptions');
    let p1ImgOptions = document.querySelector('#p1ImgOptions');
    let p1ImgOptions0 = document.querySelector('#p1ImgOptions0');
    let p1ImgOptions02 = document.querySelector('#p1ImgOptions02');
    let p1ImgOptions03 = document.querySelector('#p1ImgOptions03');
    let p1ImgSeparationLine = document.querySelector('#p1ImgSeparationLine');
    let p1BackgroundDiv = document.querySelector('#p1BackgroundDiv');
    let p1QRDiv = document.querySelector('#p1QRDiv');
    let p1Img01Div = document.querySelector('#p1Img01Div');
    let p1Img02Div = document.querySelector('#p1Img02Div');
    let p1Img03Div = document.querySelector('#p1Img03Div');

    if (areElementsVisible) {
        p1ImgOptions.style.display = 'none';
        p1ImgSeparationLine.style.display = 'none';
        p1Img01Div.style.display = 'none';
        p1ImgOptions02.style.display = 'none';
        p1Img02Div.style.display = 'none';
        p1QROptions.style.display = 'none';
        p1BackgroundDiv.style.display = 'none';
        p1QRDiv.style.display = 'none';
        p1ImgOptions0.style.display = 'none';
        p1Img03Div.style.display = 'none';
        p1ImgOptions03.style.display = 'none';
    } else {
        p1ImgOptions.style.display = 'block';
        p1ImgSeparationLine.style.display = 'block';
        p1Img01Div.style.display = 'flex';
        p1ImgOptions02.style.display = 'block';
        p1Img02Div.style.display = 'flex';
        p1BackgroundOptions.style.display = 'block';
        p1QROptions.style.display = 'block';
        p1BackgroundDiv.style.display = 'flex';
        p1QRDiv.style.display = 'flex';
        p1ImgOptions0.style.display = 'block';
        p1Img03Div.style.display = 'flex';
        p1ImgOptions03.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

    }
});

/* Fondo */
document.querySelector('#p1BackgroundCheck').addEventListener('change', function() {
    let checkbox = document.querySelector('#p1BackgroundCheck');
    let elementToShowHide = document.querySelector('#backgroundCp01');
    let texto = document.querySelector('.f-text');
    let img = document.querySelector('#p1Img03');

    if (checkbox.checked) {
        elementToShowHide.style.display = 'block';
        texto.style.color = 'white';
        img.src = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/k+blanco.png';
    } else {
        elementToShowHide.style.display = 'none';
        texto.style.color = '#333';
        img.src = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/k+azul.png';
    }
});

/* qr */
document.querySelector('#p1QRCheck').addEventListener('change', function() {
    let checkbox = document.querySelector('#p1QRCheck');
    let elementToShowHide = document.querySelector('#qrF');

    if (checkbox.checked) {
        elementToShowHide.style.display = 'block';
    } else {
        elementToShowHide.style.display = 'none';
    }
});

/* p1Img01 */
document.querySelector('#p1Img01Div').addEventListener('click', function(event){
    if (!event.target.closest('#p1Img01BtnClearG')) {
    let img = document.querySelector('#p1Img01');

    let OSL = document.querySelector('#p1Img01OSL');
    let label1 = document.querySelector('#p1Img01AlignLabel');
    let alignBtnLeft = document.querySelector('#p1Img01AlignLeft');
    let alignBtnCenter = document.querySelector('#p1Img01AlignCenter');
    let alignBtnRight = document.querySelector('#p1Img01AlignRight');
    let label2 = document.querySelector('#p1Img01SizeLabel');
    let sizeBtnSM = document.querySelector('#p1Img01SizeSm');
    let sizeBtnMD = document.querySelector('#p1Img01SizeMd');
    let sizeBtnLG = document.querySelector('#p1Img01SizeLg');
    let insert = document.querySelector('#p1Img01FileInput');
    let p1ImgOptionsFlexList = document.querySelectorAll('.p1ImgOptionsFlex');
    let btnClear = document.querySelector('#p1Img01BtnClearG');
    let displayLabel = document.querySelector('#p1Img01DisplayLabel');
    let displayCheckbox = document.querySelector('#p1Img01Display');
 
    if (areElementsVisible) {
        OSL.style.display = 'none';
        label1.style.display = 'none';
        label2.style.display = 'none';
        alignBtnLeft.style.display = 'none';
        alignBtnCenter.style.display = 'none';
        alignBtnRight.style.display = 'none';
        sizeBtnSM.style.display = 'none';
        sizeBtnMD.style.display = 'none';
        sizeBtnLG.style.display = 'none';
        insert.style.display = 'none';
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        btnClear.style.display = 'none';
        displayLabel.style.display = 'none';
        displayCheckbox.style.display = 'none';
    } else {  
        OSL.style.display = 'block';
        label1.style.display = 'block';
        label2.style.display = 'block';
        alignBtnLeft.style.display = 'block';
        alignBtnCenter.style.display = 'block';
        alignBtnRight.style.display = 'block';
        sizeBtnSM.style.display = 'block';
        sizeBtnMD.style.display = 'block';
        sizeBtnLG.style.display = 'block';
        insert.style.display = 'block';
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'flex';
        });
        btnClear.style.display = 'block';
        displayLabel.style.display = 'block';
        displayCheckbox.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

    displayCheckbox.addEventListener('click',function(){  
          
        if (displayCheckbox.checked) {
            img.style.display = 'block';
            displayCheckbox.checked = true;
        } else {
            img.style.display = 'none';
            displayCheckbox.checked = false;
        }
    });

    let Alignment = 'right';
    
    let originalAlignmentStyles = {
        position: img.style.position,
        top: img.style.top,
        right: img.style.right
    };

    let currentAlignmentStyles = { ...originalAlignmentStyles }; // Copia inicial

    let originalSizeStyles = {
        width: img.style.width,
        right: img.style.right
    };

    let currentSizeStyles = { ...originalSizeStyles }; // Copia inicial

    function applyStyles() {
        img.style.cssText = `position:${currentAlignmentStyles.position}; top:${currentAlignmentStyles.top}; right:${currentAlignmentStyles.right}; width:${currentSizeStyles.width};`;
    }

    alignBtnLeft.addEventListener('click', function() {
        currentAlignmentStyles = { ...originalAlignmentStyles };
        currentAlignmentStyles.right = '138mm'; // Valor predeterminado
        if (currentSizeStyles.width === '172.156px') { // MD
            currentAlignmentStyles.right = '138mm';
        } else if (currentSizeStyles.width === '210.047px') { // LG
            currentAlignmentStyles.right = '130mm';
        }
        Alignment = 'left';
        applyStyles();
    });

    alignBtnCenter.addEventListener('click', function() {
        currentAlignmentStyles = { ...originalAlignmentStyles };
        currentAlignmentStyles.right = '81mm'; // Valor predeterminado
        if (currentSizeStyles.width === '172.156px') { // MD
            currentAlignmentStyles.right = '81mm';
        } else if (currentSizeStyles.width === '210.047px') { // LG
            currentAlignmentStyles.right = '77mm';
        }
        Alignment = 'center';
        applyStyles();
    });

    alignBtnRight.addEventListener('click', function() {
        currentAlignmentStyles = { ...originalAlignmentStyles };
        currentAlignmentStyles.right = '25mm';
        Alignment = 'right'; 
        applyStyles();
    });

    sizeBtnSM.addEventListener('click', function(){
        currentAlignmentStyles = { ...originalAlignmentStyles};
        currentSizeStyles = { ...originalSizeStyles };
        currentSizeStyles.width = '140.031px';
        if (Alignment === 'left'){
            currentAlignmentStyles.right = '138mm';
        }   else { if (Alignment === 'center'){
                    currentAlignmentStyles.right = '81mm';
        }   else { if (Alignment === 'right'){
                    currentAlignmentStyles.right = '25mm';
                }
            }
        }
        applyStyles();
    });

    sizeBtnMD.addEventListener('click', function(){
        currentAlignmentStyles = { ...originalAlignmentStyles};
        currentSizeStyles = { ...originalSizeStyles };
        currentSizeStyles.width = '172.156px';
        if (Alignment === 'left'){
            currentAlignmentStyles.right = '138mm';
        }   else { if (Alignment === 'center'){
                    currentAlignmentStyles.right = '81mm';
        }   else { if (Alignment === 'right'){
                    currentAlignmentStyles.right = '25mm';
                }
            }
        }
        applyStyles();
    });

    sizeBtnLG.addEventListener('click', function(){
        currentAlignmentStyles = { ...originalAlignmentStyles};
        currentSizeStyles = { ...originalSizeStyles };
        currentSizeStyles.width = '210.047px';
        if (Alignment === 'left'){
            currentAlignmentStyles.right = '130mm';
        }   else { if (Alignment === 'center'){
                    currentAlignmentStyles.right = '77mm';
        }   else { if (Alignment === 'right'){
                    currentAlignmentStyles.right = '25mm';
                }
            }
        }
        applyStyles();
    });
    }
});
/* Cambiar imagen 01 */
document.getElementById('p1Img01FileInput').addEventListener('change', function(event) {
    let file = event.target.files[0]; 

    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let nuevaImagenSrc = e.target.result; 
            let imagenExistente = document.getElementById('p1Img01');
            imagenExistente.src = nuevaImagenSrc; 
        };

        reader.readAsDataURL(file); 
    }
});

/* Default all p1Img01 */
document.querySelector('#p1Img01BtnClearG').addEventListener('click', function() {

    let displayCheckbox = document.querySelector('#p1Img01Display');
    let imagenPredeterminadaSrc = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/francia-pais.jpg';
    let imagenExistente = document.getElementById('p1Img01');
    imagenExistente.src = imagenPredeterminadaSrc;
    let defaultStyles = {
        position: 'absolute',
        width: '140.031px',
        top: '25mm',
        right: '25mm'
    };
    displayCheckbox.checked = true;

    imagenExistente.style.cssText = `position:${defaultStyles.position}; width:${defaultStyles.width}; top:${defaultStyles.top}; right:${defaultStyles.right};`;
});

/* p1Img02 */

originalStyles = {
    sm: { width: '233.39px', height: '70.22px', left: '130px', position: 'absolute', top: '158.2mm' },
    md: { width: '287.86px', height: '84.72px', left: '90px', position: 'absolute', top: '158.2mm' },
    lg: { width: '342.31px', height: '99.22px', left: '34px', position: 'absolute', top: '158.2mm' },
    up1: { top: '161.6mm' },
    up2: { top: '158.2mm' },
    up3: { top: '154.8mm' }
};

/* mostrar elementos opciones img 02 */
document.querySelector('#p1Img02Div').addEventListener('click', function(event){
    if (!event.target.closest('#p1Img02BtnClearG')) {
    let img = document.querySelector('#p1Img02');
    let hr = document.querySelector('.hr');
    let OSL = document.querySelector('#p1Img02OSL');
    let label1 = document.querySelector('#p1Img02AlignLabel');
    let alignBtnUp1 = document.querySelector('#p1Img02AlignUp1');
    let alignBtnUp2 = document.querySelector('#p1Img02AlignUp2');
    let alignBtnUp3 = document.querySelector('#p1Img02AlignUp3');
    let label2 = document.querySelector('#p1Img02SizeLabel');
    let sizeBtnSM = document.querySelector('#p1Img02SizeSm');
    let sizeBtnMD = document.querySelector('#p1Img02SizeMd');
    let sizeBtnLG = document.querySelector('#p1Img02SizeLg');
    let insert = document.querySelector('#p1Img02FileInput');
    let p1ImgOptionsFlexList = document.querySelectorAll('.p1ImgOptionsFlex02');
    let btnClear2 = document.querySelector('#p1Img02BtnClearG');
    let displayLabelImg02 = document.querySelector('#p1Img02DisplayLabel');
    let displayCheckboxImg02 = document.querySelector('#p1Img02Display');

    if (areElementsVisible) {
        OSL.style.display = 'none';
        label1.style.display = 'none';
        label2.style.display = 'none';
        alignBtnUp1.style.display = 'none';
        alignBtnUp2.style.display = 'none';
        alignBtnUp3.style.display = 'none';
        sizeBtnSM.style.display = 'none';
        sizeBtnMD.style.display = 'none';
        sizeBtnLG.style.display = 'none';
        insert.style.display = 'none';
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        btnClear2.style.display = 'none';
        displayLabelImg02.style.display = 'none';
        displayCheckboxImg02.style.display = 'none';
    } else {  
        OSL.style.display = 'block';
        label1.style.display = 'block';
        label2.style.display = 'block';
        alignBtnUp1.style.display = 'block';
        alignBtnUp2.style.display = 'block';
        alignBtnUp3.style.display = 'block';
        sizeBtnSM.style.display = 'block';
        sizeBtnMD.style.display = 'block';
        sizeBtnLG.style.display = 'block';
        insert.style.display = 'block';
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'flex';
        });
        btnClear2.style.display = 'block';
        displayLabelImg02.style.display = 'block';
        displayCheckboxImg02.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

    displayCheckboxImg02.addEventListener('click',function(){  
    

        if (displayCheckboxImg02.checked) {
            img.style.display = 'block';
/*             if(disp === 0) { */
                hr.style.display = 'block';
/*             } */
            displayCheckboxImg02.checked = true;
        } else {
            img.style.display = 'none';
            hr.style.display = 'none';
            displayCheckboxImg02.checked = false;
        }
    });

    function applyAlignment(style) {
        img.style.top = style.top;
    }
    
    // Esta función manejará los estilos de tamaño
    function applySize(style) {
        img.style.width = style.width;
        img.style.height = style.height;
        img.style.left = style.left;
        img.style.position = style.position;
    }
    
  /*   if (disp !== 2) { */
    alignBtnUp1.addEventListener('click', function() {
        applyAlignment(originalStyles.up1);
    });

    alignBtnUp2.addEventListener('click', function() {
        applyAlignment(originalStyles.up2);
    });

    alignBtnUp3.addEventListener('click', function() {
        applyAlignment(originalStyles.up3);
    });

    sizeBtnSM.addEventListener('click', function() {
        applySize(originalStyles.sm);
    });

    sizeBtnMD.addEventListener('click', function() {
        applySize(originalStyles.md);
    });

    sizeBtnLG.addEventListener('click', function() {
        applySize(originalStyles.lg);
    });
 /*    } */
    } 
});
/* Cambiar imagen 02 */
document.getElementById('p1Img02FileInput').addEventListener('change', function(event) {
/* if (disp !== 2){ */
    let file = event.target.files[0]; // Obtener el archivo de la entrada de archivos

    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let nuevaImagenSrc = e.target.result; // Obtener la URL de la imagen cargada

            let imagenExistente = document.getElementById('p1Img02');
            imagenExistente.src = nuevaImagenSrc; 
        };

        reader.readAsDataURL(file); // Leer el archivo como datos URL
    }
/* } */
});

/* Default all p1Img02 */
document.querySelector('#p1Img02BtnClearG').addEventListener('click', function() {
/* if (disp !== 2){ */
    let displayCheckboxImg02 = document.querySelector('#p1Img02Display');
    let imagenPredeterminadaSrc = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/LogoActualizado2.png';
    let imagenExistente = document.getElementById('p1Img02');
    imagenExistente.src = imagenPredeterminadaSrc;

/*     if (disp === 0){ */
        if(lado === 1){
            leftActual = '90px';
        }
/*         if(lado === 2){
            leftActual = '415px';
        } */
 /*    } */

 /*    if (disp === 1){ */
        leftActual = '256px';
 /*    } */

    let defaultStyles = {
        position: 'absolute',
        width: '287.86px', height: '84.72px',
        top: '158.2mm',
        left: leftActual
    };

    displayCheckboxImg02.checked = true;
    imagenExistente.style.cssText = `position:${defaultStyles.position}; width:${defaultStyles.width}; height:${defaultStyles.height}; top:${defaultStyles.top};  left:${defaultStyles.left};`;
/* } */
});

/* P1IMG03 */
/* p1Img03 */

let originalStyles2 = {
    sm: { width: '105.02px', height: '92.78px', right: '73mm', position: 'absolute', top: '270mm' },
    md: { width: '136.14px', height: '120.28px', right: '80mm', position: 'absolute', top: '267mm' },
    lg: { width: '156px', height: '133px', right: '86mm', position: 'absolute', top: '264mm' },
    up1: { top: '270mm' },
    up2: { top: '267mm' },
    up3: { top: '264mm' }
};


/* mostrar elementos opciones img 03 */
document.querySelector('#p1Img03Div').addEventListener('click', function(event){
    if (!event.target.closest('#p1Img03BtnClearG')) {
    let img = document.querySelector('#p1Img03');
    let contImg = document.querySelector('.img-logo2');
    let OSL = document.querySelector('#p1Img03OSL');
    let label1 = document.querySelector('#p1Img03AlignLabel');
    let alignBtnUp1 = document.querySelector('#p1Img03AlignUp1');
    let alignBtnUp2 = document.querySelector('#p1Img03AlignUp2');
    let alignBtnUp3 = document.querySelector('#p1Img03AlignUp3');
    let label2 = document.querySelector('#p1Img03SizeLabel');
    let sizeBtnSM = document.querySelector('#p1Img03SizeSm');
    let sizeBtnMD = document.querySelector('#p1Img03SizeMd');
    let sizeBtnLG = document.querySelector('#p1Img03SizeLg');
    let insert = document.querySelector('#p1Img03FileInput');
    let p1ImgOptionsFlexList = document.querySelectorAll('.p1ImgOptionsFlex03');
    let btnClear3 = document.querySelector('#p1Img03BtnClearG');
    let displayLabelImg = document.querySelector('#p1Img03DisplayLabel');
    let displayCheckboxImg = document.querySelector('#p1Img03Display');
    let hr = document.querySelector('.hr-2');

    if (areElementsVisible) {
        OSL.style.display = 'none';
        label1.style.display = 'none';
        label2.style.display = 'none';
        alignBtnUp1.style.display = 'none';
        alignBtnUp2.style.display = 'none';
        alignBtnUp3.style.display = 'none';
        sizeBtnSM.style.display = 'none';
        sizeBtnMD.style.display = 'none';
        sizeBtnLG.style.display = 'none';
        insert.style.display = 'none';
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        btnClear3.style.display = 'none';
        displayLabelImg.style.display = 'none';
        displayCheckboxImg.style.display = 'none';
    } else {  
        OSL.style.display = 'block';
        label1.style.display = 'block';
        label2.style.display = 'block';
        alignBtnUp1.style.display = 'block';
        alignBtnUp2.style.display = 'block';
        alignBtnUp3.style.display = 'block';
        sizeBtnSM.style.display = 'block';
        sizeBtnMD.style.display = 'block';
        sizeBtnLG.style.display = 'block';
        insert.style.display = 'block';
        p1ImgOptionsFlexList.forEach(function(flex) {
            flex.style.display = 'flex';
        });
        btnClear3.style.display = 'block';
        displayLabelImg.style.display = 'block';
        displayCheckboxImg.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

    displayCheckboxImg.addEventListener('click',function(){  
    

        if (displayCheckboxImg.checked) {
            img.style.display = 'block';
            hr.style.display = 'block';
            displayCheckboxImg.checked = true;
        } else {
            img.style.display = 'none';
            hr.style.display = 'none';
            displayCheckboxImg.checked = false;
        }
    });

    function applyAlignment(style) {
        contImg.style.top = style.top;
    }
    
    // Esta función manejará los estilos de tamaño
    function applySize(style) {
        img.style.width = style.width;
        img.style.height = style.height;
        contImg.style.right = style.right;
        contImg.style.position = style.position;
    }

    alignBtnUp1.addEventListener('click', function() {
        applyAlignment(originalStyles2.up1);
    });

    alignBtnUp2.addEventListener('click', function() {
        applyAlignment(originalStyles2.up2);
    });

    alignBtnUp3.addEventListener('click', function() {
        applyAlignment(originalStyles2.up3);
    });

    sizeBtnSM.addEventListener('click', function() {
        applySize(originalStyles2.sm);
    });

    sizeBtnMD.addEventListener('click', function() {
        applySize(originalStyles2.md);
    });

    sizeBtnLG.addEventListener('click', function() {
        applySize(originalStyles2.lg);
    });

    } 
});
/* Cambiar imagen 03 */
document.getElementById('p1Img03FileInput').addEventListener('change', function(event) {
    let file = event.target.files[0]; // Obtener el archivo de la entrada de archivos

    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let nuevaImagenSrc = e.target.result; // Obtener la URL de la imagen cargada

            let imagenExistente = document.getElementById('p1Img03');
            imagenExistente.src = nuevaImagenSrc; 
        };

        reader.readAsDataURL(file); // Leer el archivo como datos URL
    }
});

/* Default all p1Img03 */
document.querySelector('#p1Img03BtnClearG').addEventListener('click', function() {
    let displayCheckboxImg02 = document.querySelector('#p1Img03Display');
    let bgCheckbox = document.querySelector('#p1BackgroundCheck');
/*     let bgCheckbox2 = document.querySelector('#p1QRCheck');
    let qr = document.querySelector('#qrF');
    qr.style.display = 'block';
    bgCheckbox.checked = true;
    bgCheckbox2.checked = true; */
    let imagenPredeterminadaSrc;
    if (bgCheckbox.checked){
        imagenPredeterminadaSrc = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/k+blanco.png';
    } else {
        imagenPredeterminadaSrc = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/k+azul.png';
    }


    let imagenExistente = document.getElementById('p1Img03');
    imagenExistente.src = imagenPredeterminadaSrc;
    displayCheckboxImg02.checked = true;
    imagenExistente.style.display = 'block';
    
    let hr = document.querySelector('.hr-2');
    let imgf = document.querySelector(".img-logo2");

    hr.style.display = 'block';
    imgf.style.display = 'block';
    let defaultStyles2;

        defaultStyles2 = {
            position: 'absolute',
            top: '267mm',
            right: '78mm',
            width: '136.14px',
            height: '120.28px'
        };

/*         defaultStyles2 = {
            position: 'absolute',
            top: '267mm',
            right: '16mm',
            width: '136.14px',
            height: '120.28px'
        }; */
    

    imgf.style.cssText = `position:${defaultStyles2.position}; top:${defaultStyles2.top};  right:${defaultStyles2.right}; width: 35%;`; 
    imagenExistente.style.cssText = `width:${defaultStyles2.width}; height:${defaultStyles2.height};`; 
});

/* PAGINA 1 > FOOTER */

// visualizar opciones footer
document.querySelector('#p1FooterDiv').addEventListener('click', function(event) {
    // Verificar si el clic se produjo en #titleBtnClearG
    if (!event.target.closest('#p1FooterBtnClearG')) {
        // Ejecutar la función que se activa al hacer clic en #titleDiv
        let btnClearG = document.querySelector('#p1FooterBtnClearG');
        let optionDesp = document.querySelectorAll('.p1FooterOptionDesp');
/*         let dispositionOption = document.querySelector('#p1FooterDispositionOption'); */
        let options = document.querySelector('#p1FooterOptions');
        let separationLine = document.querySelector('#p1FooterSeparationLine');

        if (areElementsVisible) {
            btnClearG.style.display = 'none';
            optionDesp.forEach(function(flex) {
                flex.style.display = 'none';
            });
            options.style.display = 'none';
            separationLine.style.display = 'none';
/*             dispositionOption = 'none'; */
        } else {
            btnClearG.style.display = 'block';
            optionDesp.forEach(function(flex) {
                flex.style.display = 'block';
            });
            options.style.display = 'block';
            separationLine.style.display = 'block';
           /*  dispositionOption.style.display = 'block'; */
        }

        areElementsVisible = !areElementsVisible;
    }
});

// visualizacion
/* document.querySelector('#p1FooterDispositionOption').addEventListener('click', function(){
    
    let optionsFlexList = document.querySelectorAll('.p1FootersOptionsFlex');
    let labelList = document.querySelectorAll('.p1FooterDispLabel');
    let sideChange = document.querySelector('#p1SideChange2');
    let qrDisplay = document.querySelector('#p1QRDisplay');
    let qr = document.querySelector('#qrF');

    if(areElementsVisible) {
        optionsFlexList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        labelList.forEach(function(flex) {
            flex.style.display = 'none';
        });
        sideChange.style.display = 'none';
        qrDisplay.style.display = 'none';
    } else {
        optionsFlexList.forEach(function(flex) {
            flex.style.display = 'flex';
        });
        labelList.forEach(function(flex) {
            flex.style.display = 'block';
        });
        sideChange.style.display = 'block';
        qrDisplay.style.display = 'block';
    }

    areElementsVisible = !areElementsVisible;

    qrDisplay.addEventListener('click',function(){  
          
        if (qrDisplay.checked) {
            qr.style.display = 'block';
            qrDisplay.checked = true;
        } else {
            qr.style.display = 'none';
            qrDisplay.checked = false;
        }
    });

}); */

visualizarOpciones('#p1FooterTextOption', '.p1FooterTextOptionDesp');
visualizarOpciones('#p1FooterColorOption', '.p1FooterColorOptionDesp');
/* visualizarOpciones('#p1FooterFontOption', '.p1FooterFontOptionDesp'); */
visualizarOpciones('#p1FooterAlignOption', '.p1FooterAlignOptionDesp');
visualizarOpciones('#p1FooterBoldOption', '.p1FooterBoldOptionDesp');

// funcionalidad

//texto
document.querySelector('#p1FooterTextOption').addEventListener('click', function(){

    function TextPickerHandler(textPicker, charCount, charLimit, pElement) {
        textPicker.addEventListener('input', function() {
            let text = textPicker.value;
            let remainingChars = charLimit - text.length;
            
            if (remainingChars >= 0) {
                charCount.textContent = `${text.length} / ${charLimit} caracteres`;
            } else {
                textPicker.value = text.substring(0, charLimit);
                charCount.textContent = `0 / ${charLimit} caracteres`;
            }
            
            if (text.trim().length === 0) {
                pElement = true;
            } else {
                pElement = false;
            }
        });
    }

    let p1 = document.querySelector('.l-1');
    let p2 = document.querySelector('.l-2');
    let p3 = document.querySelector('.l-3');
    let p4 = document.querySelector('.l-4');
    let p5 = document.querySelector('.l-5');
    let p1Empty = false;
    let p2Empty = false;
    let p3Empty = false;  
    let p4Empty = false;  
    let p5Empty = false;  
    let saveButton = document.querySelector('#p1FooterTextSaveButton');
    let btnClear = document.querySelector('#p1FooterTextBtnClear');

    let textPicker1 = document.querySelector('#p1FooterTextPicker1');
    let charCount1 = document.querySelector('#p1FooterCharCount1');
    let textPicker2 = document.querySelector('#p1FooterTextPicker2');
    let charCount2 = document.querySelector('#p1FooterCharCount2');
    let textPicker3 = document.querySelector('#p1FooterTextPicker3');
    let charCount3 = document.querySelector('#p1FooterCharCount3');
    let textPicker4 = document.querySelector('#p1FooterTextPicker4');
    let charCount4 = document.querySelector('#p1FooterCharCount4');
    let textPicker5 = document.querySelector('#p1FooterTextPicker5');
    let charCount5 = document.querySelector('#p1FooterCharCount5');

    TextPickerHandler(textPicker1, charCount1, 56, p1Empty);
    TextPickerHandler(textPicker2, charCount2, 50, p2Empty);
    TextPickerHandler(textPicker3, charCount3, 50, p3Empty);
    TextPickerHandler(textPicker4, charCount4, 50, p4Empty);
    TextPickerHandler(textPicker5, charCount5, 50, p5Empty);

    saveButton.addEventListener('click', function() {
        
        p1.textContent = textPicker1.value;
        p2.textContent = textPicker2.value;
        p3.textContent = textPicker3.value;
        p4.textContent = textPicker4.value;
        p5.textContent = textPicker5.value;
        
    });

    btnClear.addEventListener('click', function() {
        
        let defaultContent1 = "Todos los derechos reservados ® KALSTEIN France S. A. S.";
        textPicker1.value = defaultContent1;
        p1.textContent = defaultContent1;
        charCount1.textContent = "56 / 56 caracteres";

        let defaultContent2 = "2 Rue Jean Lantier •  75001 Paris •";
        textPicker2.value = defaultContent2;
        p2.textContent = defaultContent2;
        charCount2.textContent = "35 / 50 caracteres";

        let defaultContent3 = "+33 1 78 95 87 89 / +33 6 80 76 07 10 •";
        textPicker3.value = defaultContent3;
        p3.textContent = defaultContent3;
        charCount3.textContent = "39 / 50 caracteres";

        let defaultContent4 = "https://kalstein.eu";
        textPicker4.value = defaultContent4;
        p4.textContent = defaultContent4;
        charCount4.textContent = "19 / 50 caracteres";

        let defaultContent5 = "KALSTEIN FRANCE, S. A. S";
        textPicker5.value = defaultContent5;
        p5.textContent = defaultContent5;
        charCount5.textContent = "24 / 50 caracteres";

        if (textPicker1.value.trim().length === 0) {
            p1Empty = true;
        } else {
            p1Empty = false;
        }
    
        if (textPicker2.value.trim().length === 0) {
            p2Empty = true;
        } else {
            p2Empty = false;
        }

        if (textPicker3.value.trim().length === 0) {
            p3Empty = true;
        } else {
            p3Empty = false;
        }

        if (textPicker4.value.trim().length === 0) {
            p4Empty = true;
        } else {
            p4Empty = false;
        }

        if (textPicker5.value.trim().length === 0) {
            p5Empty = true;
        } else {
            p5Empty = false;
        }
    });

});
//color
document.querySelector('#p1FooterColorOption').addEventListener('click', function(){
    let p1 = document.querySelector('.l-1');
    let p2 = document.querySelector('.l-2');
    let p3 = document.querySelector('.l-3');
    let p4 = document.querySelector('.l-4');
    let p5 = document.querySelector('.l-5');

    let saveButton = document.querySelector('#p1FooterColorSaveButton');
    let btnClear = document.querySelector('#p1FooterColorBtnClear');
    let colorPicker = document.querySelector('#p1FooterColorPicker');

    saveButton.addEventListener('click', function() {
    
        p1.style.color = colorPicker.value;
        p2.style.color = colorPicker.value;
        p3.style.color = colorPicker.value;
        p4.style.color = colorPicker.value;
        p5.style.color = colorPicker.value;
    });
    
    btnClear.addEventListener('click', function() {
        colorPicker.value = '#000';
        p1.style.color = '';
        p2.style.color = '';
        p3.style.color = '';
        p4.style.color = '';
        p5.style.color = '';
    });
});
/* //fuente
document.querySelector('#p1FooterFontOption').addEventListener('click', function(){
    let p1 = document.querySelector('.l-1');
    let p2 = document.querySelector('.l-2');
    let p3 = document.querySelector('.l-3');
    let p4 = document.querySelector('.l-4');
    let p5 = document.querySelector('.l-5');
    let fontPicker = document.querySelector('#p1FooterFontPicker');
    let saveButton = document.querySelector('#p1FooterFontSaveButton');
    let btnClear = document.querySelector('#p1FooterFontBtnClear');
    let defaultFont = "Arial, sans-serif";

    saveButton.addEventListener('click', function() {
        let selectedFont = fontPicker.value;
        p1.style.fontFamily = selectedFont;
        p2.style.fontFamily = selectedFont;
        p3.style.fontFamily = selectedFont;
        p4.style.fontFamily = selectedFont;
        p5.style.fontFamily = selectedFont;
    });
    
    btnClear.addEventListener('click', function() {
        p1.style.fontFamily = defaultFont;
        p2.style.fontFamily = defaultFont;
        p3.style.fontFamily = defaultFont;
        p4.style.fontFamily = defaultFont;
        p5.style.fontFamily = defaultFont;
        fontPicker.value = defaultFont;
    });

}); */

// alineacion
document.querySelector('#p1FooterAlignOption').addEventListener('click', function(){

    let texto = document.querySelectorAll('.p1FooterP');
    let alignBtnLeft = document.querySelector('#p1FooterAlignBtnLeft');
    let alignBtnCenter = document.querySelector('#p1FooterAlignBtnCenter');
    let alignBtnRight = document.querySelector('#p1FooterAlignBtnRight');
    let alignBtnJustify = document.querySelector('#p1FooterAlignBtnJustify');

    alignBtnLeft.addEventListener('click', function() {
        texto.forEach(function(align) {
            align.style.textAlign = 'left';
        });
    });

    alignBtnCenter.addEventListener('click', function() {
        texto.forEach(function(align) {
            align.style.textAlign = 'center';
        });
    });

    alignBtnRight.addEventListener('click', function() {
        texto.forEach(function(align) {
            align.style.textAlign = 'right';
        });
    });

    alignBtnJustify.addEventListener('click', function() {
        texto.forEach(function(align) {
            align.style.textAlign = 'justify';
        });
    });
}); 

// negritas
document.querySelector('#p1FooterBoldPicker').addEventListener('click', function(){
    let texto = document.querySelectorAll('.p1FooterP');
    let boldPicker = document.querySelector('#p1FooterBoldPicker');

    boldPicker.addEventListener('change', function() {
        if(boldPicker.checked){
            texto.forEach(function(bold){
                bold.style.fontWeight = 'bold';
            });
        } else {
            texto.forEach(function(bold){
                bold.style.fontWeight = 'normal';
            });
        }
    });
});


/* 
/* Cambio de lado footer*/
/* let lado2 = 2;
let currentWidth2; */
// cambio de lado footer
/* document.querySelector('#p1SideChange2').addEventListener('click',function(){
        let qr = document.querySelector('.qr');
        let hr = document.querySelector('.hr-2');
        let textContainer = document.querySelector('.f-text');
        let p1 = document.querySelector('.l-1');
        let p2 = document.querySelector('.l-2');
        let p3 = document.querySelector('.l-3');
        let p4 = document.querySelector('.l-4');
        let p5 = document.querySelector('.l-5');
        let imgf = document.querySelector(".img-logo2");
        let img = document.querySelector('#p1Img03');
        currentWidth2 = img.style.width;

        if (lado2 === 1) {
            lado2 = 2;
            textContainer.style.right = '37mm';
            hr.style.right = '114mm';
            qr.style.right = '8mm';
            textContainer.style.left = '';
            hr.style.left = '';
            qr.style.left = '';
            let value;

            if (img.style.width === '105.02px') {
                value = '71mm';
            } else if (img.style.width === '136.14px') {
                value = '78mm';
            } else if (img.style.width === '156px') {
                value = '84mm';
            }
            imgf.style.right = value;
            
            originalStyles2 = {
                sm: { width: '105.02px', height: '92.78px', right: '71mm', position: 'absolute', top: '270mm' },
                md: { width: '136.14px', height: '120.28px', right: '78mm', position: 'absolute', top: '267mm' },
                lg: { width: '156px', height: '133px', right: '84mm', position: 'absolute', top: '264mm' },
                up1: { top: '270mm' },
                up2: { top: '267mm' },
                up3: { top: '264mm' }
            };

            p1.style.textAlign = 'left';
            p2.style.textAlign = 'left';
            p3.style.textAlign = 'left';
            p4.style.textAlign = 'left';
            p5.style.textAlign = 'left';
        } else {
            lado2 = 1;
            textContainer.style.left = '37mm';
            hr.style.left = '117mm';
            qr.style.left = '8mm';
            textContainer.style.right = '';
            hr.style.right = '';
            qr.style.right = '';

            imgf.style.right = '16mm';
            img.style.width = currentWidth2;

            originalStyles2 = {
                sm: { width: '105.02px', height: '92.78px', right: '16mm', position: 'absolute', top: '270mm' },
                md: { width: '136.14px', height: '120.28px', right: '16mm', position: 'absolute', top: '267mm' },
                lg: { width: '156px', height: '133px', right: '16mm', position: 'absolute', top: '264mm' },
                up1: { top: '270mm' },
                up2: { top: '267mm' },
                up3: { top: '264mm' }
            };

            p1.style.textAlign = 'left';
            p2.style.textAlign = 'left';
            p3.style.textAlign = 'left';
            p4.style.textAlign = 'left';
            p5.style.textAlign = 'left';
        }
});  */

// default all Footer
document.querySelector('#p1FooterBtnClearG').addEventListener('click', function() {
    let qr = document.querySelector('.qr');
    let hr = document.querySelector('.hr-2');
    let textContainer = document.querySelector('.f-text');
    let p1 = document.querySelector('.l-1');
    let p2 = document.querySelector('.l-2');
    let p3 = document.querySelector('.l-3');
    let p4 = document.querySelector('.l-4');
    let p5 = document.querySelector('.l-5');
    let imgf = document.querySelector(".img-logo2");
    let displayCheckboxImg02 = document.querySelector('#p1Img03Display');
    let imagenPredeterminadaSrc;
    let imagenExistente = document.getElementById('p1Img03');
    let texto = document.querySelectorAll('.p1FooterP');
    let boldPicker = document.querySelector('#p1FooterBoldPicker');
/*     let fontPicker = document.querySelector('#p1FooterFontPicker'); */
    let defaultFont = "Arial, sans-serif";
    let colorPicker = document.querySelector('#p1FooterColorPicker');
    let textPicker1 = document.querySelector('#p1FooterTextPicker1');
    let charCount1 = document.querySelector('#p1FooterCharCount1');
    let textPicker2 = document.querySelector('#p1FooterTextPicker2');
    let charCount2 = document.querySelector('#p1FooterCharCount2');
    let textPicker3 = document.querySelector('#p1FooterTextPicker3');
    let charCount3 = document.querySelector('#p1FooterCharCount3');
    let textPicker4 = document.querySelector('#p1FooterTextPicker4');
    let charCount4 = document.querySelector('#p1FooterCharCount4');
    let textPicker5 = document.querySelector('#p1FooterTextPicker5');
    let charCount5 = document.querySelector('#p1FooterCharCount5');
    let qrDisplay = document.querySelector('#p1QRDisplay');
    let qrF = document.querySelector('#qrF');

    //imagen 03 default

    let bgCheckbox = document.querySelector('#p1BackgroundCheck');
/*     let bgCheckbox2 = document.querySelector('#p1QRCheck');
    qrF.style.display = 'block';
    bgCheckbox.checked = true;
    bgCheckbox2.checked = true; */
    if (bgCheckbox.checked){
        imagenPredeterminadaSrc = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/k+blanco.png';
    } else {
        imagenPredeterminadaSrc = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/assets/images/k+azul.png';
    }

    imagenExistente.src = imagenPredeterminadaSrc;
    displayCheckboxImg02.checked = true;
    imagenExistente.style.display = 'block';

    hr.style.display = 'block';
    imgf.style.display = 'block';
    let defaultStyles2;
    defaultStyles2 = {
        position: 'absolute',
        top: '267mm',
        right: '78mm',
        width: '136.14px',
        height: '120.28px'
    };
    imgf.style.cssText = `position:${defaultStyles2.position}; top:${defaultStyles2.top};  right:${defaultStyles2.right}; width: 35%;`; 
    imagenExistente.style.cssText = `width:${defaultStyles2.width}; height:${defaultStyles2.height};`; 
    
    //lado default
/*     lado2 = 2; */
    qrF.style.display = 'block';
    qr.style.display = 'block';
    textContainer.style.width = '35%';
    textContainer.style.right = '37mm';
    hr.style.right = '114mm';
    qr.style.right = '8mm';
    textContainer.style.left = '';
    hr.style.left = '';
    qr.style.left = '';
    originalStyles2 = {
        sm: { width: '105.02px', height: '92.78px', right: '72mm', position: 'absolute', top: '270mm' },
        md: { width: '136.14px', height: '120.28px', right: '80mm', position: 'absolute', top: '267mm' },
        lg: { width: '156px', height: '133px', right: '86mm', position: 'absolute', top: '264mm' },
        up1: { top: '270mm' },
        up2: { top: '267mm' },
        up3: { top: '264mm' }
    };

    //texto
    let defaultContent1 = "Todos los derechos reservados ® KALSTEIN France S. A. S.";
    textPicker1.value = defaultContent1;
    p1.textContent = defaultContent1;
    charCount1.textContent = "56 / 56 caracteres";

    let defaultContent2 = "2 Rue Jean Lantier •  75001 Paris •";
    textPicker2.value = defaultContent2;
    p2.textContent = defaultContent2;
    charCount2.textContent = "35 / 50 caracteres";

    let defaultContent3 = "+33 1 78 95 87 89 / +33 6 80 76 07 10 •";
    textPicker3.value = defaultContent3;
    p3.textContent = defaultContent3;
    charCount3.textContent = "39 / 50 caracteres";

    let defaultContent4 = "https://kalstein.eu";
    textPicker4.value = defaultContent4;
    p4.textContent = defaultContent4;
    charCount4.textContent = "19 / 50 caracteres";

    let defaultContent5 = "KALSTEIN FRANCE, S. A. S";
    textPicker5.value = defaultContent5;
    p5.textContent = defaultContent5;
    charCount5.textContent = "24 / 50 caracteres";

    //color
    colorPicker.value = '#000';
    texto.forEach(function(color) {
        color.style.color = '';
    });
    
    //fuente
/*     fontPicker.value = defaultFont;
    texto.forEach(function(font) {
        font.style.fontFamily = defaultFont;
    }); */

    //alineacion
    texto.forEach(function(align) {
        align.style.textAlign = 'left';
    }); 

    //negritas
    boldPicker.checked = false;
    texto.forEach(function(bold){
        bold.style.fontWeight = 'normal';
    });
    
});
/* FIN OPCIONES PAGINA 1 */