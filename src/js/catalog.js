jQuery(document).ready(function ($) {
  // Inicialización y eventos
  updateCatalogAndCategories();

  $(document).on("keyup", "#searchreport", function () {
    updateCatalog();
  });

  $(document).on("change", "#category", function () {
    updateCatalog();
  });

  function updateCatalogAndCategories() {
    let category = $("#category").val();
    let inputSearch = $("#searchreport").val();
    updateCatalog(inputSearch, category);
    updateCategories();
  }

  function updateCatalog(inputSearch = "", category = "") {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/catalog.php",
      type: "POST",
      dataType: "json", // Asegurando que esperamos una respuesta JSON
      data: { inputSearch, category },
      success: function (response) {
        $("#catalogo").html(response.html);
        tblCatalogsPagination(response.total);
      },
      error: function () {
        console.log("error al actualizar el catálogo");
      },
    });
  }

  function updateCategories() {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php",
      type: "POST",
      dataType: "html", // Esperamos HTML directamente aquí
      success: function (response) {
        $("#category").html(response);
      },
      error: function () {
        console.log("error al actualizar las categorías");
      },
    });
  }

  function tblCatalogsPagination(total) {
    let totalPages = Math.ceil(total / 12);
    let currentPage = parseInt($("#hiddenPage").val()) || 1;

    $(".pagination #form-previous-catalog").attr("hidden", currentPage <= 1);
    $(".pagination #form-next-catalog").attr(
      "hidden",
      currentPage >= totalPages
    );

    $(".pagination #form-next-catalog input[name=o]").val(currentPage + 1);
    $(".pagination #form-previous-catalog input[name=o]").val(
      Math.max(1, currentPage - 1)
    );
  }

  $(
    ".pagination #form-next-catalog, .pagination #form-previous-catalog"
  ).submit(function (e) {
    e.preventDefault();
    let page = $(this).find("input[name=o]").val();
    $("#hiddenPage").val(page);
    let category = $("#category").val();
    let inputSearch = $("#searchreport").val();
    updateCatalog(inputSearch, category);
  });
});
