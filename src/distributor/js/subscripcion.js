const titulos = [
  "Facturación mensual",
  "Membresía 1",
  "Membresía 2",
  "Membresía 3",
];

const botones = [
  // { membresia: "Membresía 1", id: "membresia-1" },
  { membresia: "Membresía 2", id: "membresia-2" },
  { membresia: "Membresía 3", id: "membresia-3" },
];

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
      "Agente de Logística Asignado (Atención Personalizada (Vía Correo/WhastApp/Llamada telefónica)",
      "✅",
      "✅",
      "✅",
    ],
  },
  {
    item: ["Tracking Global de Pedidos", "✅", "✅", "✅"],
  },
  {
    item: ["Seguro de envíos nacionales e internacionales", "✅", "✅", "✅"],
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
    item: ["Dashboard Personalizado", "✅", "✅", "✅"],
  },
  {
    item: ["Acceso de App Móvil Kalstein", "✅", "✅", "✅"],
  },
  {
    item: [
      "Acceso Ilimitado a Contenido (Manuales, Catálogos, Certificados)",
      "✅",
      "✅",
      "✅",
    ],
  },
  {
    item: [
      "Mensajería Directa (Fábrica/Distribuidores/Servicio Técnico/Usuarios)",
      "✅",
      "✅",
      "✅",
    ],
  },
  {
    item: ["Soporte Técnico Online", "✅", "✅", "✅"],
  },
  {
    item: ["1 Hora Gratuita de Inducción Técnica Online", "✅", "✅", "✅"],
  },
  {
    item: ["Recomendación de Modelos por IA", "✅", "✅", "✅"],
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
    item: ["Verificación Kalstein", "✅", "✅", "✅"],
  },
  {
    item: ["Módulo de Cotizaciones Personalizadas", "✅", "✅", "✅"],
  },
  {
    item: ["Descuentos Exclusivos", "18%", "18%", "18% a 41% solo miembros"],
  },
  {
    item: [
      "Servicios de Marketing Estrategia SEO dirigida al país del distribuidor-Creacion de Contenido (Blog) (40 al mes)-Creacion de contenido (Guias informativas) (10)",
      "❌",
      "❌",
      "✅",
    ],
  },
  {
    item: ["Publicidad en Banners de Kalstein", "❌", "❌", "✅"],
  },
  {
    item: ["Productos 3D del Negocio (10)", "❌", "❌", "✅"],
  },
  {
    item: [
      "Créditos Kalstein (Tipo I, II y III. Solo para Europa)",
      "❌",
      "❌",
      "✅",
    ],
  },
  {
    item: [
      "Descuento del 4% sobre todos los tipos de envíos con Kalstein (Avión, Mar, Courier)",
      "❌",
      "❌",
      "✅",
    ],
  },
  {
    item: [
      "Opción de Dropshipping (30 productos al mes, tamaños y pesos estándares)",
      "❌",
      "❌",
      "✅",
    ],
  },
  // Puedes añadir más objetos con la misma estructura para más filas
];

jQuery(document).ready(function ($) {
  let membresia = "";

  function obtenerMembresia() {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0) {
          $.each(botones, function (i, boton) {
            if (membresia == 0) {
              let $btn = $("#tbl-botones").append(
                $("<a>")
                  .text(boton.membresia)
                  .attr("id", boton.id)
                  .addClass("btn-tbl")
              );
            }
          });

          if (respuesta == 2) {
            $("#membresia-2").attr("hidden", true);
          }
          if (respuesta == 3) {
            $("#membresia-3").attr("hidden", true);
          }
        }
        if (Number(membresia) !== 0) {
          $("#tbl-botones").append(
            $("<a>")
              .text("Cancelar")
              .attr("id", "btn-cancelar-subs")
              .addClass("btn-tbl")
          );
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  }

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

  function crearBotones() {
    $.each(botones, function (i, boton) {
      if (membresia == 0) {
        let $btn = $("#tbl-botones").append(
          $("<a>")
            .text(boton.membresia)
            .attr("id", boton.id)
            .addClass("btn-tbl")
        );
      }
    });
    if (membresia !== 0) {
      $("#tbl-botones").append(
        $("<a>")
          .text("boton.membresia")
          .attr("id", "btn-cancelar-subs")
          .addClass("btn-tbl")
      );
    }
  }

  // Llamadas a las funciones
  crearTitulos();
  crearDatos();
  // crearBotones();
  obtenerMembresia();

  $("#membresia-2").click(function () {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0 && respuesta !== 3) {
          updateSubscripcion(2);
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  });

  $("#membresia-3").click(function () {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0 && respuesta !== 2) {
          updateSubscripcion(3);
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  });

  function updateSubscripcion(subs) {
    window.alert(`Datos a actualizar a la subscripcion numero: ${subs}`);
  }
});
