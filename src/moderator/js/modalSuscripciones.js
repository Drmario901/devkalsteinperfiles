document.addEventListener("DOMContentLoaded", (event) => {
  const payments = [
    { id: 1, amount: 100, date: "2023-05-01" },
    { id: 2, amount: 200, date: "2023-06-01" },
    { id: 3, amount: 150, date: "2023-07-01" },
    // Agrega aquí los datos reales de los pagos del usuario
  ];

  const paymentTableBody = document.getElementById("paymentTableBody");

  payments.forEach((payment) => {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td>${payment.id}</td>
        <td>${payment.amount}</td>
        <td>${payment.date}</td>
      `;
    paymentTableBody.appendChild(row);
  });
});
