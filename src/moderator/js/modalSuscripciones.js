document.addEventListener("DOMContentLoaded", () => {
  const historialButtons = document.querySelectorAll(".btnHistorial");

  historialButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const idAccount = this.previousElementSibling.value;
      openPaymentModal(idAccount);
    });
  });
});

function openPaymentModal(idAccount) {
  $.ajax({
    type: "POST",
    url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/getSuscripcionData.php",
    data: { idAccount: idAccount },
    dataType: "json",
    success: function (response) {
      const paymentTableBody = document.getElementById("paymentTableBody");
      paymentTableBody.innerHTML = ""; // Clear previous data

      response.forEach((payment) => {
        let codeRetourStatus;
        let estadoMembresiaStatus;

        // Determine codeRetourStatus
        if (payment.code_retour === 'paiement' || payment.code_retour === 'payetest') {
          codeRetourStatus = 'Pago Exitoso';
        } else if (payment.code_retour === 'annulation') {
          codeRetourStatus = 'Pago Rechazado';
        } else {
          codeRetourStatus = payment.code_retour;
        }

        // Determine estadoMembresiaStatus
        switch (payment.estado_membresia) {
          case '1':
            estadoMembresiaStatus = 'Activa';
            break;
          case '2':
            estadoMembresiaStatus = 'Pendiente de cancelar';
            break;
          case '3':
            estadoMembresiaStatus = 'Finalizada';
            break;
          default:
            estadoMembresiaStatus = payment.estado_membresia;
        }

        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${payment.id}</td>
          <td>${codeRetourStatus}</td>
          <td>${payment.fecha_inicio}</td>
          <td>${payment.fecha_final}</td>
          <td>${payment.referencia_pago}</td>
          <td>${estadoMembresiaStatus}</td>
          <td>${payment.monto}</td>
          <td>${payment.fechahora}</td>
          <td>${payment.dominio}</td>
        `;
        paymentTableBody.appendChild(row);
      });

      $("#paymentModal").modal("show");
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error: " + status + error);
    },
  });
}
