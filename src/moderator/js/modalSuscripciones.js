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
    url: "getSuscripcionData.php",
    data: { idAccount: idAccount },
    dataType: "json",
    success: function (response) {
      const paymentTableBody = document.getElementById("paymentTableBody");
      paymentTableBody.innerHTML = ""; // Clear previous data

      response.forEach((payment) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${payment.id}</td>
          <td>${payment.code_retour}</td>
          <td>${payment.fecha_inicio}</td>
          <td>${payment.fecha_final}</td>
          <td>${payment.referencia_pago}</td>
          <td>${payment.estado_membresia}</td>
          <td>${payment.monto}</td>
          <td>${payment.fechahora}</td>
          <td>${payment.dominio}</td>
          <td>${payment.user_id}</td>
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
