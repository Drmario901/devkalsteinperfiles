document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("modal");
  const closeModal = document.querySelector(".close");
  const renderButtons = document.querySelectorAll(".btn-render");
  const downloadBtn = document.getElementById("download-images-btn");

  renderButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Obtener los datos del producto
      const card = this.closest(".card-render");
      const name = card.querySelector(".card-render-title").textContent;
      const fecha = card.querySelector(".card-render-text").textContent;
      const id = card.querySelector("#id-render").textContent;

      document.getElementById("userId").value = id;

      // Mostrar los datos del producto en el modal
      const modalBody = document.getElementById("datos");
      modalBody.innerHTML = ` <p>ID: ${id} <p><strong>Solicitante:</strong> ${name}</p><p><strong>Fecha de solicitud:</strong> ${fecha}</p>`;

      // Guardar las URL de las imágenes del producto
      const imageUrls = [
        card.querySelector("#principal").src,
        card.querySelector("#latIzquierdo").src,
        card.querySelector("#latDerecho").src,
        card.querySelector("#atras").src,
      ];

      // Almacenar las URL de las imágenes en el botón de descarga
      downloadBtn.setAttribute("data-images", JSON.stringify(imageUrls));

      // Mostrar el modal
      modal.style.display = "block";
    });
  });

  closeModal.addEventListener("click", function () {
    // Cerrar el modal al hacer clic en el botón de cerrar (X)
    modal.style.display = "none";
  });

  // Cerrar el modal al hacer clic fuera de él
  window.addEventListener("click", function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  // Manejar la descarga de imágenes al hacer clic en el botón de descarga
  downloadBtn.addEventListener("click", function () {
    const imageUrls = JSON.parse(this.getAttribute("data-images"));
    console.log(imageUrls);
    imageUrls.forEach((url) => {
      // Crear un enlace temporal para la descarga directa
      event.preventDefault();
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", ""); // Esto indica al navegador que debe descargar el archivo en lugar de abrirlo
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
  });

  const form = document.querySelector("#form-render");
  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    const enviar = confirm("¿Quieres enviar el archivo?");
    if (!enviar) return;

    try {
      // Assuming 'imageUpload' is the ID of your file input for a single file
      const fileInput = document.getElementById("imageUpload");
      const file = fileInput.files[0]; // Get the first file, since it's only one
      const datos = new FormData(this);

      // Check if a file is selected
      if (file) {
        datos.append("uploadedFile", file); // Append the selected file
      } else {
        // If no file is selected, possibly alert the user or handle accordingly
        alert("Por favor, selecciona un archivo para subir.");
        return; // Stop the function if no file is selected
      }

      // Debugging: Log FormData keys and values
      for (let [key, value] of datos.entries()) {
        console.log(`${key}: ${value}`);
      }

      // Make sure to point to the correct PHP script URL
      await fetch(plugin_dir + "php/moderator/render.php", {
        // Update this to your PHP script's path
        method: "POST",
        body: datos,
      })
        .then((res) => res.text()) // Assuming the response is in text format
        .then((text) =>
          iziToast.success({
            title: "Éxito",
            message: "Render subido con exito",
            position: "topRight",
          })
        )
        .catch((err) => console.error(err));
    } catch (error) {
      console.error("Error al procesar la solicitud:", error);
    }
  });
});
