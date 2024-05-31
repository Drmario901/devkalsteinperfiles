document.addEventListener("DOMContentLoaded", () => {
  let todos = [];
  let paginaActual = 1;
  let itemsPorPagina = 10; // Define cuántos items quieres por página
  let paginas = 0;

  const historialButtons = document.querySelectorAll(".btnHistorial");

  historialButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const idAccount = this.previousElementSibling.value;
      openPaymentModal(idAccount);
    });
  });

  function openPaymentModal(idAccount) {
    $.ajax({
      type: "POST",
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/getSuscripcionData.php",
      data: { idAccount: idAccount },
      dataType: "json",
      success: function (response) {
        todos = response; // Asigna la respuesta a la variable todos
        paginas = Math.ceil(todos.length / itemsPorPagina);
        actualizarVista();
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: " + status + error);
      },
    });
  }

  function actualizarVista() {
    let datosPagina = paginar(todos, paginaActual, itemsPorPagina);
    $("#paymentTableBody").html(generarTabla(datosPagina));
    generarPaginado(paginas);
    $("#paymentModal").modal("show");
  }

  function paginar(items, paginaActual, itemsPorPagina) {
    let inicio = (paginaActual - 1) * itemsPorPagina;
    let fin = inicio + itemsPorPagina;
    return items.slice(inicio, fin);
  }

  function generarTabla(datos) {
    let tablaHtml = "";
    datos.forEach((payment) => {
      let codeRetourStatus =
        payment.code_retour === "paiement" || payment.code_retour === "payetest"
          ? "Exitoso"
          : payment.code_retour === "annulation"
          ? "Rechazado"
          : payment.code_retour;
      let estadoMembresiaStatus;
      switch (payment.estado_membresia) {
        case "1":
          estadoMembresiaStatus = "Activa";
          break;
        case "2":
          estadoMembresiaStatus = "Pendiente de cancelar";
          break;
        case "3":
          estadoMembresiaStatus = "Finalizada";
          break;
        default:
          estadoMembresiaStatus = payment.estado_membresia;
      }
      tablaHtml += `
        <tr>
          <td>${payment.id}</td>
          <td>${codeRetourStatus}</td>
          <td>${payment.fecha_inicio}</td>
          <td>${payment.fecha_final}</td>
          <td>${payment.referencia_pago}</td>
          <td>${estadoMembresiaStatus}</td>
          <td>${payment.monto}</td>
          <td>${payment.fechahora}</td>
          <td>${payment.dominio}</td>
        </tr>
      `;
    });
    return tablaHtml;
  }

  function generarPaginado(paginas) {
    let botonesPagina = "";
    for (let i = 1; i <= paginas; i++) {
      let claseActiva = i === paginaActual ? "active" : "";
      botonesPagina += `<li class="page-item ${claseActiva}"><button class="page-link" data-pagina="${i}">${i}</button></li>`;
    }
    $("#paginado").html(botonesPagina);
  }

  $(document).on("click", "#paginado .page-link", function () {
    let paginaSeleccionada = parseInt($(this).attr("data-pagina")); // Asegúrate de convertir a número
    paginaActual = paginaSeleccionada;
    actualizarVista(); // Esto regenerará los botones y aplicará correctamente la clase `active`
  });
});

function closeModal() {
  $("#paymentModal").modal("hide");
}
