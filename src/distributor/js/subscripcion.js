const titulos = [
  "Facturación mensual",
  "Membresía 1",
  "Membresía 2",
  "Membresía 3",
];

const subscripcionTh = document.querySelector("#tr-subscripcion");

titulos.forEach((titulo) => {
  const th = document.createElement("th"); // Crea un nuevo elemento <th>
  th.textContent = titulo; // Establece el texto del <th> al título actual
  subscripcionTh.appendChild(th); // Añade el <th> a la fila de cabecera
});
