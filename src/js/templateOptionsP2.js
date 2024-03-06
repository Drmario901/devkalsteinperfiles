document.body.addEventListener("wheel", function (e) {
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
  document.querySelector(selector).addEventListener("click", function () {
    let optionDesp = document.querySelectorAll(classToToggle);

    if (areElementsVisible) {
      optionDesp.forEach(function (flex) {
        flex.style.display = "none";
      });
    } else {
      optionDesp.forEach(function (flex) {
        flex.style.display = "block";
      });
    }

    areElementsVisible = !areElementsVisible;
  });
}

function desVisualizarOpciones(classToToggle) {
  let optionDesp = document.querySelectorAll(classToToggle);

  optionDesp.forEach(function (element) {
    if (window.getComputedStyle(element).display === "block") {
      element.style.display = "none";
    }
  });
}

function visualizarOpciones2(selector, classToToggle) {
  document.querySelector(selector).addEventListener("click", function () {
    let optionDesp = document.querySelectorAll(classToToggle);

    if (areElementsVisible2) {
      optionDesp.forEach(function (flex) {
        flex.style.display = "none";
      });
    } else {
      optionDesp.forEach(function (flex) {
        flex.style.display = "flex";
      });
    }

    areElementsVisible2 = !areElementsVisible2;
  });
}

document.querySelector("#pagina2Div").addEventListener("click", function () {
  desVisualizarOpciones(".p2Desplg");
  desVisualizarOpciones(".p2ImgOptionsDesplg");
  desVisualizarOpciones(".p2TableOptionsDesplg");
  desVisualizarOpciones(".p2BillOptionsDesplg");
  desVisualizarOpciones(".p2FooterOptionsDesplg");
  desVisualizarOpciones(".p2Footer2OptionsDesplg");
});

/* OPCIONES PAGINA 2 */
/* OPCIONES PAGINA 2 */
/* OPCIONES PAGINA 2 */

/* mostrar opciones pagina 2 */
visualizarOpciones("#pagina2Div", ".p2Desplg");

//imagenes

// opciones imagenes
visualizarOpciones("#p2ImgOption", ".p2ImgOptionsDesplg");
// opciones imagenes > imagen 01
visualizarOpciones("#p2Img01Option", ".p2Img01OptionsDesplg");

document
  .querySelector("#p2Img01Display")
  .addEventListener("change", function () {
    let checkbox = document.getElementById("p2Img01Display");
    let logoP2 = document.getElementById("logoP2");

    if (checkbox.checked) {
      logoP2.style.display = "block";
    } else {
      logoP2.style.display = "none";
    }
  });

document.querySelector("#p2Img01SizeSm").addEventListener("click", function () {
  let img = document.getElementById("logoP2");
  let cont = document.querySelector(".logo-03");

  img.style.width = "210px";
  img.style.height = "61.8px";
  cont.style.top = "18.5mm";
  cont.style.left = "20mm";
});

document.querySelector("#p2Img01SizeMd").addEventListener("click", function () {
  let img = document.getElementById("logoP2");
  let cont = document.querySelector(".logo-03");

  img.style.width = "249px";
  img.style.height = "73.28px";
  cont.style.top = "16mm";
  cont.style.left = "11mm";
});

document.querySelector("#p2Img01SizeLg").addEventListener("click", function () {
  let img = document.getElementById("logoP2");
  let cont = document.querySelector(".logo-03");

  img.style.width = "300px";
  img.style.height = "88.28px";
  cont.style.top = "12mm";
  cont.style.left = "11mm";
});

document
  .getElementById("p2Img01FileInput")
  .addEventListener("change", function (event) {
    let file = event.target.files[0];

    if (file) {
      let reader = new FileReader();

      reader.onload = function (e) {
        let nuevaImagenSrc = e.target.result;
        let imagenExistente = document.getElementById("logoP2");
        imagenExistente.src = nuevaImagenSrc;
      };

      reader.readAsDataURL(file);
    }
  });

document
  .getElementById("p2Img01BtnClearG")
  .addEventListener("click", function () {
    let img = document.getElementById("logoP2");
    let cont = document.querySelector(".logo-03");
    let checkbox = document.getElementById("p2Img01Display");
    img.style.display = "block";
    img.style.width = "249px";
    img.style.height = "73.28px";
    cont.style.top = "16mm";
    img.src =
      "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/LogoActualizado2.png";
    checkbox.checked = true;
  });

// opciones imagenes > imagen 02
visualizarOpciones("#p2Img02Option", ".p2Img02OptionsDesplg");

document
  .querySelector("#p2Img02Display")
  .addEventListener("change", function () {
    let checkbox = document.getElementById("p2Img02Display");
    let logoP2 = document.getElementById("p2Ce");

    if (checkbox.checked) {
      logoP2.style.display = "block";
    } else {
      logoP2.style.display = "none";
    }
  });

document
  .getElementById("p2Img02FileInput")
  .addEventListener("change", function (event) {
    let file = event.target.files[0];

    if (file) {
      let reader = new FileReader();

      reader.onload = function (e) {
        let nuevaImagenSrc = e.target.result;
        let imagenExistente = document.getElementById("p2Ce");
        imagenExistente.src = nuevaImagenSrc;
      };

      reader.readAsDataURL(file);
    }
  });

document
  .getElementById("p2Img02BtnClearG")
  .addEventListener("click", function () {
    let img = document.getElementById("p2Ce");
    let checkbox = document.getElementById("p2Img02Display");
    img.style.display = "block";
    img.src =
      "https://dev.kalstein.plus/wp-content/plugins/kalsteinCotizacion/assets/images/img-ce.jpg";
    checkbox.checked = true;
  });

// opciones imagenes > imagen 03
visualizarOpciones("#p2Img03Option", ".p2Img03OptionsDesplg");

document
  .querySelector("#p2Img03Display")
  .addEventListener("change", function () {
    let checkbox = document.getElementById("p2Img03Display");
    let logoP2 = document.getElementById("p2Img03");

    if (checkbox.checked) {
      logoP2.style.display = "block";
    } else {
      logoP2.style.display = "none";
    }
  });

document
  .getElementById("p2Img03FileInput")
  .addEventListener("change", function (event) {
    let file = event.target.files[0];

    if (file) {
      let reader = new FileReader();

      reader.onload = function (e) {
        let nuevaImagenSrc = e.target.result;
        let imagenExistente = document.getElementById("p2Img03");
        imagenExistente.src = nuevaImagenSrc;
      };

      reader.readAsDataURL(file);
    }
  });

document
  .getElementById("p2Img03BtnClearG")
  .addEventListener("click", function () {
    let img = document.getElementById("p2Img03");
    let checkbox = document.getElementById("p2Img03Display");
    img.style.display = "block";
    img.src =
      "https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono3.png";
    checkbox.checked = true;
  });

//Default General Imagenes

document
  .querySelector("#p2ImgBtnClearG")
  .addEventListener("click", function () {
    //IMG01
    let img = document.getElementById("logoP2");
    let cont = document.querySelector(".logo-03");
    let checkbox = document.getElementById("p2Img01Display");
    img.style.display = "block";
    img.style.width = "249px";
    img.style.height = "73.28px";
    cont.style.top = "16mm";
    img.src =
      "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/LogoActualizado2.png";
    checkbox.checked = true;

    //IMG02
    let img2 = document.getElementById("p2Ce");
    let checkbox2 = document.getElementById("p2Img02Display");
    img2.style.display = "block";
    img2.src =
      "https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/img-ce.jpg";
    checkbox2.checked = true;

    // IMG03
    let img3 = document.getElementById("p2Img03");
    let checkbox3 = document.getElementById("p2Img03Display");
    img3.style.display = "block";
    img3.src =
      "https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono3.png";
    checkbox3.checked = true;
  });

//tabla

// opciones tabla
visualizarOpciones("#p2TableOption", ".p2TableOptionsDesplg");
// opciones tabla > color
visualizarOpciones("#p2TableColorOption", ".p2TableColorDesplg");

document
  .querySelector("#p2TableColorSaveButton")
  .addEventListener("click", function () {
    let textColor = document.querySelector("#p2TableColorPicker").value;
    let backgroundColor = document.querySelector("#p2TableColorPicker2").value;
    let tableCells = document.querySelectorAll("#fTable td");

    tableCells.forEach((td) => {
      td.style.color = textColor;
      td.style.backgroundColor = backgroundColor;
    });
  });

document
  .querySelector("#p2TableColorBtnClear")
  .addEventListener("click", function () {
    document.querySelector("#p2TableColorPicker").value = "#ffffff";
    document.querySelector("#p2TableColorPicker2").value = "#213280";
    let textColor = "#ffffff";
    let backgroundColor = "#213280";
    let tableCells = document.querySelectorAll("#fTable td");

    tableCells.forEach((td) => {
      td.style.color = textColor;
      td.style.backgroundColor = backgroundColor;
    });
  });

//opciones tabla > fuente
/* visualizarOpciones('#p2TableFontOption','.p2TableFontDesplg');

document.querySelector('#p2TableFontSaveButton').addEventListener('click', function(){

    let headFont = document.querySelector('#p2TableFontPicker1').value;
    let bodyFont = document.querySelector('#p2TableFontPicker2').value;
    let headCells = document.querySelectorAll('#fTable td');
    let bodyCells = document.querySelectorAll('.fTableB td');
    headCells.forEach(td => {
      td.style.fontFamily = headFont;
    });
    bodyCells.forEach(td => {
        td.style.fontFamily = bodyFont;
    });
});

document.querySelector('#p2TableFontBtnClear').addEventListener('click', function(){
    let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2TableFontPicker1').value = defaultFont;
    document.querySelector('#p2TableFontPicker2').value = defaultFont;
    let headCells = document.querySelectorAll('#fTable td');
    let bodyCells = document.querySelectorAll('.fTableB td');

    headCells.forEach(td => {
        td.style.fontFamily = defaultFont;
    });
    bodyCells.forEach(td => {
        td.style.fontFamily = defaultFont;
    });
}); */

//Default General Tabla

document
  .querySelector("#p2TableBtnClearG")
  .addEventListener("click", function () {
    //color
    document.querySelector("#p2TableColorPicker").value = "#ffffff";
    document.querySelector("#p2TableColorPicker2").value = "#213280";
    let textColor = "#ffffff";
    let backgroundColor = "#213280";
    let tableCells = document.querySelectorAll("#fTable td");

    tableCells.forEach((td) => {
      td.style.color = textColor;
      td.style.backgroundColor = backgroundColor;
    });

    //fuente
    /*     let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2TableFontPicker1').value = defaultFont;
    document.querySelector('#p2TableFontPicker2').value = defaultFont;
    let headCells = document.querySelectorAll('#fTable td');
    let bodyCells = document.querySelectorAll('.fTableB td');

    headCells.forEach(td => {
        td.style.fontFamily = defaultFont;
    });
    bodyCells.forEach(td => {
        td.style.fontFamily = defaultFont;
    }); */
  });

//Factura

// opciones factura
visualizarOpciones("#p2BillOption", ".p2BillOptionsDesplg");
// opciones factura > color
visualizarOpciones("#p2BillColorOption", ".p2BillColorDesplg");

document
  .querySelector("#p2BillColorSaveButton")
  .addEventListener("click", function () {
    let textColor = document.querySelector("#p2BillColorPicker").value;
    let textElements = document.querySelectorAll(".bt-02 p");

    // Iterar sobre los elementos y cambiar su color
    textElements.forEach(function (element) {
      element.style.color = textColor;
    });
  });

document
  .querySelector("#p2BillColorBtnClear")
  .addEventListener("click", function () {
    let defaultColor = "";
    let textElements = document.querySelectorAll(".bt-02 p");

    textElements.forEach(function (element) {
      element.style.color = defaultColor;
    });

    document.querySelector("#p2BillColorPicker").value = defaultColor;
  });

//opciones factura > fuente
/* visualizarOpciones('#p2BillFontOption','.p2BillFontDesplg');

document.querySelector('#p2BillFontSaveButton').addEventListener('click', function(){

    let font = document.querySelector('#p2BillFontPicker').value;
    let textElements = document.querySelectorAll('.bt-02 p');

    textElements.forEach(function(element) {
        element.style.fontFamily = font;
    });
});

document.querySelector('#p2BillFontBtnClear').addEventListener('click', function(){
    let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2BillFontPicker').value = defaultFont;
    let textElements = document.querySelectorAll('.bt-02 p');
    
    textElements.forEach(function(element) {
        element.style.fontFamily = defaultFont;
    });
}); */

//Default General Factura

document
  .querySelector("#p2BillBtnClearG")
  .addEventListener("click", function () {
    //Color
    let defaultColor = "";
    let textElements = document.querySelectorAll(".bt-02 p");

    textElements.forEach(function (element) {
      element.style.color = defaultColor;
    });

    document.querySelector("#p2BillColorPicker").value = defaultColor;

    //Fuente
    /*     let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2BillFontPicker').value = defaultFont;
    
    textElements.forEach(function(element) {
        element.style.fontFamily = defaultFont;
    }); */
  });

//Footer

// opciones footer
visualizarOpciones("#p2FooterOption", ".p2FooterOptionsDesplg");
// opciones footer > color
visualizarOpciones("#p2FooterColorOption", ".p2FooterColorDesplg");

document
  .querySelector("#p2FooterColorSaveButton")
  .addEventListener("click", function () {
    let color = document.querySelector("#p2FooterColorPicker").value;
    let text = document.querySelectorAll(".ft-01 p");

    text.forEach((p) => {
      p.style.color = color;
    });
  });

document
  .querySelector("#p2FooterColorBtnClear")
  .addEventListener("click", function () {
    document.querySelector("#p2FooterColorPicker").value = "#000000";
    let color = "";
    let text = document.querySelectorAll(".ft-01 p");

    text.forEach((p) => {
      p.style.color = color;
    });
  });

// opciones Footer > fuente
/* visualizarOpciones('#p2FooterFontOption','.p2FooterFontDesplg');

document.querySelector('#p2FooterFontSaveButton').addEventListener('click', function(){

    let font = document.querySelector('#p2FooterFontPicker').value;
    let text = document.querySelectorAll('.ft-01 p');
  
    text.forEach(p => {
        p.style.fontFamily = font;
      });
});

document.querySelector('#p2FooterFontBtnClear').addEventListener('click', function(){
    let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2FooterFontPicker').value = defaultFont;
    let text = document.querySelectorAll('.ft-01 p');

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
    });
}); */

// opciones Footer > texto
visualizarOpciones("#p2FooterTextOption", ".p2FooterTextDesplg");
let t1Empty;
let t2Empty;
let t3Empty;
let t4Empty;

let texto1 = document.querySelector(".p2P1");
let texto2 = document.querySelector(".p2P2");
let texto3 = document.querySelector(".p2P3");
let texto4 = document.querySelector(".p2P4");

let p2TextPicker1 = document.querySelector("#p2FooterTextPicker1");
let p2TextPicker2 = document.querySelector("#p2FooterTextPicker2");
let p2TextPicker3 = document.querySelector("#p2FooterTextPicker3");
let p2TextPicker4 = document.querySelector("#p2FooterTextPicker4");

let charCount1 = document.querySelector("#p2FooterTextCharCount1");
let charCount2 = document.querySelector("#p2FooterTextCharCount2");
let charCount3 = document.querySelector("#p2FooterTextCharCount3");
let charCount4 = document.querySelector("#p2FooterTextCharCount4");

document
  .querySelector("#p2FooterTextSaveButton")
  .addEventListener("click", function () {
    let texto1 = document.querySelector(".p2P1");
    let texto2 = document.querySelector(".p2P2");
    let texto3 = document.querySelector(".p2P3");
    let texto4 = document.querySelector(".p2P4");

    let p2TextPicker1 = document.querySelector("#p2FooterTextPicker1");
    let p2TextPicker2 = document.querySelector("#p2FooterTextPicker2");
    let p2TextPicker3 = document.querySelector("#p2FooterTextPicker3");
    let p2TextPicker4 = document.querySelector("#p2FooterTextPicker4");

    texto1.textContent = p2TextPicker1.value;
    texto2.textContent = p2TextPicker2.value;
    texto3.textContent = p2TextPicker3.value;
    texto4.textContent = p2TextPicker4.value;

    if (t1Empty === true) {
      texto2.style.marginTop = "5mm";
    }

    if (t3Empty === true) {
      texto4.style.marginTop = "5mm";
    }

    if (t2Empty === true) {
      texto1.style.marginTop = "3mm";
    }

    if (t4Empty === true) {
      texto3.style.marginTop = "3mm";
    }
  });

document
  .querySelector("#p2FooterTextBtnClear")
  .addEventListener("click", function () {
    let texto1 = document.querySelector(".p2P1");
    let texto2 = document.querySelector(".p2P2");
    let texto3 = document.querySelector(".p2P3");
    let texto4 = document.querySelector(".p2P4");

    let p2TextPicker1 = document.querySelector("#p2FooterTextPicker1");
    let p2TextPicker2 = document.querySelector("#p2FooterTextPicker2");
    let p2TextPicker3 = document.querySelector("#p2FooterTextPicker3");
    let p2TextPicker4 = document.querySelector("#p2FooterTextPicker4");

    let defaultContent1 = "Marcado CE: para comprar con tranquilidad";
    p2TextPicker1.value = defaultContent1;
    texto1.textContent = defaultContent1;
    charCount1.textContent = "41 / 45 caracteres";

    let defaultContent2 =
      "Todos los equipos Kalstein cumplen los requisitos de la UE, de acuerdo con la normativa pertinente.";
    p2TextPicker2.value = defaultContent2;
    texto2.textContent = defaultContent2;
    charCount2.textContent = "99 / 111 caracteres";

    let defaultContent3 = "Con la adquisición de un equipo Kalstein";
    p2TextPicker3.value = defaultContent3;
    texto3.textContent = defaultContent3;
    charCount3.textContent = "40 / 45 caracteres";

    let defaultContent4 =
      "Realizas una aportación a la Fundación Jacinto Convit, OneTreePlanted, Fundación Humatem y Fundación Maniapure.";
    p2TextPicker4.value = defaultContent4;
    texto4.textContent = defaultContent4;
    charCount4.textContent = "111 / 111 caracteres";

    if (p2TextPicker1.value.trim().length === 0) {
      t1Empty = true;
    } else {
      t1Empty = false;
    }

    if (p2TextPicker2.value.trim().length === 0) {
      t2Empty = true;
    } else {
      t2Empty = false;
    }

    if (p2TextPicker3.value.trim().length === 0) {
      t3Empty = true;
    } else {
      t3Empty = false;
    }

    if (p2TextPicker4.value.trim().length === 0) {
      t4Empty = true;
    } else {
      t4Empty = false;
    }

    texto1.style.marginTop = "0mm";
    texto2.style.marginTop = "1mm";
    texto3.style.marginTop = "0mm";
    texto4.style.marginTop = "1mm";
  });

document
  .querySelector("#p2FooterTextPicker1")
  .addEventListener("input", function () {
    let texto1 = p2TextPicker1.value;
    let charLimit1 = 45;
    let remainingChars1 = charLimit1 - texto1.length;

    if (remainingChars1 >= 0) {
      charCount1.textContent = `${texto1.length} / 45 caracteres`;
    } else {
      p2TextPicker1.value = texto1.substring(0, charLimit1);
      charCount1.textContent = `0 / 45 caracteres`;
    }
    if (texto1.trim().length === 0) {
      t1Empty = true;
    } else {
      t1Empty = false;
    }
  });

document
  .querySelector("#p2FooterTextPicker2")
  .addEventListener("input", function () {
    let texto2 = p2TextPicker2.value;
    let charLimit2 = 111;
    let remainingChars2 = charLimit2 - texto2.length;
    if (remainingChars2 >= 0) {
      charCount2.textContent = `${texto2.length} / 111 caracteres`;
    } else {
      p2TextPicker2.value = texto2.substring(0, charLimit2);
      charCount2.textContent = `0 / 111 caracteres`;
    }
    if (texto2.trim().length === 0) {
      t2Empty = true;
    } else {
      t2Empty = false;
    }
  });

document
  .querySelector("#p2FooterTextPicker3")
  .addEventListener("input", function () {
    let texto3 = p2TextPicker3.value;
    let charLimit3 = 45;
    let remainingChars3 = charLimit3 - texto3.length;
    if (remainingChars3 >= 0) {
      charCount3.textContent = `${texto3.length} / 45 caracteres`;
    } else {
      p2TextPicker3.value = texto3.substring(0, charLimit3);
      charCount3.textContent = `0 / 45 caracteres`;
    }
    if (texto3.trim().length === 0) {
      t3Empty = true;
    } else {
      t3Empty = false;
    }
  });

document
  .querySelector("#p2FooterTextPicker4")
  .addEventListener("input", function () {
    let texto4 = p2TextPicker4.value;
    let charLimit4 = 111;
    let remainingChars4 = charLimit4 - texto4.length;
    if (remainingChars4 >= 0) {
      charCount4.textContent = `${texto4.length} / 111 caracteres`;
    } else {
      p2TextPicker4.value = texto4.substring(0, charLimit4);
      charCount4.textContent = `0 / 111 caracteres`;
    }
    if (texto4.trim().length === 0) {
      t4Empty = true;
    } else {
      t4Empty = false;
    }
  });

//Default General Footer

document
  .querySelector("#p2FooterBtnClearG")
  .addEventListener("click", function () {
    //color
    document.querySelector("#p2FooterColorPicker").value = "#000000";
    let color = "";
    let text = document.querySelectorAll(".ft-01 p");

    text.forEach((p) => {
      p.style.color = color;
    });

    //fuente
    /*     let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2FooterFontPicker').value = defaultFont;

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
    }); */

    //texto
    let texto1 = document.querySelector(".p2P1");
    let texto2 = document.querySelector(".p2P2");
    let texto3 = document.querySelector(".p2P3");
    let texto4 = document.querySelector(".p2P4");

    let p2TextPicker1 = document.querySelector("#p2FooterTextPicker1");
    let p2TextPicker2 = document.querySelector("#p2FooterTextPicker2");
    let p2TextPicker3 = document.querySelector("#p2FooterTextPicker3");
    let p2TextPicker4 = document.querySelector("#p2FooterTextPicker4");

    let defaultContent1 = "Marcado CE: para comprar con tranquilidad";
    p2TextPicker1.value = defaultContent1;
    texto1.textContent = defaultContent1;
    charCount1.textContent = "41 / 45 caracteres";

    let defaultContent2 =
      "Todos los equipos Kalstein cumplen los requisitos de la UE, de acuerdo con la normativa pertinente.";
    p2TextPicker2.value = defaultContent2;
    texto2.textContent = defaultContent2;
    charCount2.textContent = "99 / 111 caracteres";

    let defaultContent3 = "Con la adquisición de un equipo Kalstein";
    p2TextPicker3.value = defaultContent3;
    texto3.textContent = defaultContent3;
    charCount3.textContent = "40 / 45 caracteres";

    let defaultContent4 =
      "Realizas una aportación a la Fundación Jacinto Convit, OneTreePlanted, Fundación Humatem y Fundación Maniapure.";
    p2TextPicker4.value = defaultContent4;
    texto4.textContent = defaultContent4;
    charCount4.textContent = "111 / 111 caracteres";

    if (p2TextPicker1.value.trim().length === 0) {
      t1Empty = true;
    } else {
      t1Empty = false;
    }

    if (p2TextPicker2.value.trim().length === 0) {
      t2Empty = true;
    } else {
      t2Empty = false;
    }

    if (p2TextPicker3.value.trim().length === 0) {
      t3Empty = true;
    } else {
      t3Empty = false;
    }

    if (p2TextPicker4.value.trim().length === 0) {
      t4Empty = true;
    } else {
      t4Empty = false;
    }

    texto1.style.marginTop = "0mm";
    texto2.style.marginTop = "1mm";
    texto3.style.marginTop = "0mm";
    texto4.style.marginTop = "1mm";
  });

//Footer2

// opciones footer2
visualizarOpciones("#p2Footer2Option", ".p2Footer2OptionsDesplg");
// opciones footer2 > color
visualizarOpciones("#p2Footer2ColorOption", ".p2Footer2ColorDesplg");

document
  .querySelector("#p2Footer2ColorSaveButton")
  .addEventListener("click", function () {
    let color = document.querySelector("#p2Footer2ColorPicker").value;
    let text = document.querySelectorAll(".ft-02-text p");

    text.forEach((p) => {
      p.style.color = color;
    });
  });

document
  .querySelector("#p2Footer2ColorBtnClear")
  .addEventListener("click", function () {
    document.querySelector("#p2Footer2ColorPicker").value = "#000000";
    let color = "";
    let text = document.querySelectorAll(".ft-02-text p");

    text.forEach((p) => {
      p.style.color = color;
    });
  });

/* // opciones Footer > fuente
visualizarOpciones('#p2Footer2FontOption','.p2Footer2FontDesplg');

document.querySelector('#p2Footer2FontSaveButton').addEventListener('click', function(){

    let font = document.querySelector('#p2Footer2FontPicker').value;
    let text = document.querySelectorAll('.ft-02-text p');
  
    text.forEach(p => {
        p.style.fontFamily = font;
      });
});

document.querySelector('#p2Footer2FontBtnClear').addEventListener('click', function(){
    let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2Footer2FontPicker').value = defaultFont;
    let text = document.querySelectorAll('.ft-02-text p');

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
      });
}); */

// opciones Footer2 > texto
visualizarOpciones("#p2Footer2TextOption", ".p2Footer2TextDesplg");
let t1Empty2;
let t2Empty2;
let t3Empty2;

let p2texto1 = document.querySelector(".p2P5");
let p2texto2 = document.querySelector(".p2P6");
let p2texto3 = document.querySelector(".p2P7");

let p2p2TextPicker1 = document.querySelector("#p2Footer2TextPicker1");
let p2p2TextPicker2 = document.querySelector("#p2Footer2TextPicker2");
let p2p2TextPicker3 = document.querySelector("#p2Footer2TextPicker3");

let p2charCount1 = document.querySelector("#p2Footer2TextCharCount1");
let p2charCount2 = document.querySelector("#p2Footer2TextCharCount2");
let p2charCount3 = document.querySelector("#p2Footer2TextCharCount3");

document
  .querySelector("#p2Footer2TextSaveButton")
  .addEventListener("click", function () {
    let p2texto1 = document.querySelector(".p2P5");
    let p2texto2 = document.querySelector(".p2P6");
    let p2texto3 = document.querySelector(".p2P7");

    let p2p2TextPicker1 = document.querySelector("#p2Footer2TextPicker1");
    let p2p2TextPicker2 = document.querySelector("#p2Footer2TextPicker2");
    let p2p2TextPicker3 = document.querySelector("#p2Footer2TextPicker3");

    p2texto1.textContent = p2p2TextPicker1.value;
    p2texto2.textContent = p2p2TextPicker2.value;
    p2texto3.textContent = p2p2TextPicker3.value;
  });

document
  .querySelector("#p2Footer2TextBtnClear")
  .addEventListener("click", function () {
    let p2texto1 = document.querySelector(".p2P5");
    let p2texto2 = document.querySelector(".p2P6");
    let p2texto3 = document.querySelector(".p2P7");

    let p2p2TextPicker1 = document.querySelector("#p2Footer2TextPicker1");
    let p2p2TextPicker2 = document.querySelector("#p2Footer2TextPicker2");
    let p2p2TextPicker3 = document.querySelector("#p2Footer2TextPicker3");

    let defaultContent1 = "KALSTEIN FRANCE S.A.S";
    p2p2TextPicker1.value = defaultContent1;
    p2texto1.textContent = defaultContent1;
    p2charCount1.textContent = "21 / 46 caracteres";

    let defaultContent2 = "• 2 Rue Jean Lantier, • 75001 Paris •";
    p2p2TextPicker2.value = defaultContent2;
    p2texto2.textContent = defaultContent2;
    p2charCount2.textContent = "37 / 54 caracteres";

    let defaultContent3 =
      "+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://dev.kalstein.plus";
    p2p2TextPicker3.value = defaultContent3;
    p2texto3.textContent = defaultContent3;
    p2charCount3.textContent = "59 / 63 caracteres";

    if (p2p2TextPicker1.value.trim().length === 0) {
      t1Empty2 = true;
    } else {
      t1Empty2 = false;
    }

    if (p2p2TextPicker2.value.trim().length === 0) {
      t2Empty2 = true;
    } else {
      t2Empty2 = false;
    }

    if (p2p2TextPicker3.value.trim().length === 0) {
      t3Empty2 = true;
    } else {
      t3Empty2 = false;
    }
  });

document
  .querySelector("#p2Footer2TextPicker1")
  .addEventListener("input", function () {
    let p2texto1 = p2p2TextPicker1.value;
    let p2charLimit1 = 46;
    let remainingChars1 = p2charLimit1 - p2texto1.length;

    if (remainingChars1 >= 0) {
      p2charCount1.textContent = `${p2texto1.length} / 46 caracteres`;
    } else {
      p2p2TextPicker1.value = p2texto1.substring(0, p2charLimit1);
      p2charCount1.textContent = `0 / 46 caracteres`;
    }
    if (p2texto1.trim().length === 0) {
      t1Empty2 = true;
    } else {
      t1Empty2 = false;
    }
  });

document
  .querySelector("#p2Footer2TextPicker2")
  .addEventListener("input", function () {
    let p2texto2 = p2p2TextPicker2.value;
    let charLimit2 = 54;
    let remainingChars2 = charLimit2 - p2texto2.length;
    if (remainingChars2 >= 0) {
      p2charCount2.textContent = `${p2texto2.length} / 54 caracteres`;
    } else {
      p2p2TextPicker2.value = p2texto2.substring(0, charLimit2);
      p2charCount2.textContent = `0 / 54 caracteres`;
    }
    if (p2texto2.trim().length === 0) {
      t2Empty2 = true;
    } else {
      t2Empty2 = false;
    }
  });

document
  .querySelector("#p2Footer2TextPicker3")
  .addEventListener("input", function () {
    let p2texto3 = p2p2TextPicker3.value;
    let charLimit3 = 63;
    let remainingChars3 = charLimit3 - p2texto3.length;
    if (remainingChars3 >= 0) {
      p2charCount3.textContent = `${p2texto3.length} / 63 caracteres`;
    } else {
      p2p2TextPicker3.value = p2texto3.substring(0, charLimit3);
      p2charCount3.textContent = `0 / 63 caracteres`;
    }
    if (p2texto3.trim().length === 0) {
      t3Empty2 = true;
    } else {
      t3Empty2 = false;
    }
  });

//Default General Footer2

document
  .querySelector("#p2Footer2BtnClearG")
  .addEventListener("click", function () {
    //color
    document.querySelector("#p2Footer2ColorPicker").value = "#000000";
    let color = "";
    let text = document.querySelectorAll(".ft-02-text p");

    text.forEach((p) => {
      p.style.color = color;
    });

    //fuente
    /*     let defaultFont = "Arial, sans-serif";
    document.querySelector('#p2Footer2FontPicker').value = defaultFont;

    text.forEach(p => {
        p.style.fontFamily = defaultFont;
      });
 */
    //texto
    let p2texto1 = document.querySelector(".p2P5");
    let p2texto2 = document.querySelector(".p2P6");
    let p2texto3 = document.querySelector(".p2P7");

    let p2p2TextPicker1 = document.querySelector("#p2Footer2TextPicker1");
    let p2p2TextPicker2 = document.querySelector("#p2Footer2TextPicker2");
    let p2p2TextPicker3 = document.querySelector("#p2Footer2TextPicker3");

    let defaultContent1 = "KALSTEIN FRANCE S.A.S";
    p2p2TextPicker1.value = defaultContent1;
    p2texto1.textContent = defaultContent1;
    p2charCount1.textContent = "21 / 46 caracteres";

    let defaultContent2 = "• 2 Rue Jean Lantier, • 75001 Paris •";
    p2p2TextPicker2.value = defaultContent2;
    p2texto2.textContent = defaultContent2;
    p2charCount2.textContent = "37 / 54 caracteres";

    let defaultContent3 =
      "+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://kalstein.eu";
    p2p2TextPicker3.value = defaultContent3;
    p2texto3.textContent = defaultContent3;
    p2charCount3.textContent = "59 / 63 caracteres";

    if (p2p2TextPicker1.value.trim().length === 0) {
      t1Empty2 = true;
    } else {
      t1Empty2 = false;
    }

    if (p2p2TextPicker2.value.trim().length === 0) {
      t2Empty2 = true;
    } else {
      t2Empty2 = false;
    }

    if (p2p2TextPicker3.value.trim().length === 0) {
      t3Empty2 = true;
    } else {
      t3Empty2 = false;
    }
  });
