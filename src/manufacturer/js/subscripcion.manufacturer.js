// const titulos = [
//   "Facturación mensual",
//   "Membresía 1",
//   "Membresía 2",
//   "Membresía 3",
// ];

// const botones = [
//   // { membresia: "Membresía 1", id: "membresia-1" },
//   { membresia: "Membresía 2", id: "membresia-2" },
//   { membresia: "Membresía 3", id: "membresia-3" },
// ];

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
      "Mensajería Directa (Fábrica/Distribuidores/Servicio Técnico/Usuarios)",
      "✅",
      "✅",
      "✅",
    ],
  },
  {
    item: ["Licencia Kalstein", "❌", "❌", "✅"],
  },
  {
    item: ["Módulo de Cotizaciones Personalizadas", "✅", "✅", "✅"],
  },
  {
    item: ["Publicidad en Banners de Kalstein", "❌", "❌", "✅"],
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
    item: [
      "Descuento del 4% sobre todos los tipos de envíos con Kalstein (Avión, Mar, Courier)",
      "❌",
      "❌",
      "✅",
    ],
  },
  {
    item: [
      "Opciones de envio (30 productos al mes, tamaños y pesos estándares)",
      "❌",
      "❌",
      "✅",
    ],
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
    item: ["Recomendación de Modelos por IA", "✅", "✅", "✅"],
  },
  {
    item: ["Productos 3D del Negocio (10)", "❌", "❌", "✅"],
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
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0 && respuesta !== 2) {
          updateSubscripcion(1);
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  });

  $("#membresia-2").click(function () {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/getMembresiaAjax.php",
      type: "GET",
      data: {},
    })
      .done(function (respuesta) {
        console.log("la respuesta", respuesta);
        if (respuesta == 0 && respuesta !== 1) {
          updateSubscripcion(2);
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
