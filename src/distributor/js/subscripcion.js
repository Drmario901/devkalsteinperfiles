const datos = [
  {
    item: [
      "Soporte Multilingüe en 10 idiomas",
      "1 Idiomas",
      "2 Idiomas",
      "Todos",
    ],
  },
  {
    item: [
      "Agente de Logística Asignado<br>Atención Personalizada (Vía Correo/WhastApp/Llamada telefónica)",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  {
    item: ["Tracking Global de Pedidos", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["Seguro de envíos nacionales e internacionales", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: [
      "Presencia territorial SEO en 26 Países",
      "1 Pais",
      "3 Países",
      "Todos",
    ],
  },
  {
    item: ["Dashboard Personalizado", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["Acceso de App Móvil Kalstein", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: [
      "Acceso Ilimitado a Contenido (Manuales, Catálogos, Certificados)",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  {
    item: [
      "Mensajería Directa (Fábrica/Distribuidores/Servicio Técnico/Usuarios)",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  {
    item: ["Soporte Técnico Online", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["1 Hora Gratuita de Inducción Técnica Online", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["Recomendación de Modelos por IA", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: [
      "Creación de Tienda con Subdominio Kalstein",
      "5 Productos",
      "10 Productos",
      "Ilimitados",
    ],
  },
  {
    item: ["Verificación Kalstein", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["Módulo de Cotizaciones Personalizadas", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["Descuentos Exclusivos", "18%", "18%", "18% a 41% solo miembros"],
  },
  {
    item: [
      "Servicios de Marketing Estrategia SEO dirigida al país del distribuidor<br>-Creacion de Contenido (Blog) (40 al mes)<br>-Creacion de contenido (Guias informativas) (10)",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  {
    item: ["Publicidad en Banners de Kalstein", "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>", "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: ["Productos 3D del Negocio (10)", "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>", "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>", "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>"],
  },
  {
    item: [
      "Créditos Kalstein (Tipo I, II y III. Solo para Europa)",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  {
    item: [
      "Descuento del 4% sobre todos los tipos de envíos con Kalstein (Avión, Mar, Courier)",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  {
    item: [
      "Opción de Dropshipping (30 productos al mes, tamaños y pesos estándares)",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-xmark' style='color: #de3a46;'></i>",
      "<i class='fa-solid fa-circle-check' style='color: #4abd13;'></i>",
    ],
  },
  // Puedes añadir más objetos con la misma estructura para más filas
];

jQuery(document).ready(function ($) {
  function crearTitulos() {
    $.each(titulos, function (i, titulo) {
      $("#tr-titles").append($("<th>").text(titulo));
    });
  }

  // Función para crear las filas de datos
  function crearDatos() {
    $.each(datos, function (i, objeto) {
      const $tr = $("<tr>");
      $.each(objeto.item, function (j, dato) {
        $tr.append($("<td>").html(dato)); // Se utiliza .html() para permitir el uso de HTML dentro de la celda
      });
      $("#tr-data").append($tr);
    });
  }

  // Llamadas a las funciones
  // crearTitulos();
  crearDatos();

  $("#membresia-1").click(function () {
    let atributo = $("#membresia-1").attr("user");
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0 && respuesta !== 2) {
          updateSubscripcion(1, atributo);
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  });

  $("#membresia-2").click(function () {
    let atributo = $("#membresia-2").attr("user");
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0 && respuesta !== 1) {
          updateSubscripcion(2, atributo);
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  });

  $("#btn-cancelar-subs").click(function () {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/testPayRecurrentCancel.php",
      type: "POST",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        // const res = JSON.parse(respuesta);

        if (respuesta.response == "error") {
          iziToast.error({
            title: "Error",
            message: "Su subscripcion ya se encuentra cancelada",
            position: "center",
            timeout: false,
            closeOnClick: true,
            progressBar: false,
          });
        } else {
          iziToast.success({
            title: "Exito",
            message: "Su subscripcion a sido cancelada",
            position: "center",
            timeout: false,
            closeOnClick: true,
            progressBar: false,
          });
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  });

  function updateSubscripcion(subs, user) {
    window.location.replace(
      `https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/testPayRecurrent.php?idMembership=SUB${subs}&user=${user}`
    );
    // alert(`aqui van ${subs} y ${user}`);
  }
});
