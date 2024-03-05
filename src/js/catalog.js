jQuery(document).ready(function ($) {
  let category = $("#category").val();
  let inputSearch = $("#searchreport").val();

  catalogo(inputSearch, category);

  function catalogo(inputSearch, category) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/catalog.php",
      type: "POST",
      data: { inputSearch, category },
    })
      .done(function (respuesta) {
        $("#catalogo").html(JSON.parse(respuesta).html);
        tblCatalogsPagination();

        let total = JSON.parse(respuesta).total;

        console.log("total: " + total);

        $(".pagination #form-previous-catalog").attr("hidden", "");

        if (12 >= total) $(".pagination #form-next-catalog").attr("hidden", "");
        else $(".pagination #form-next-catalog").removeAttr("hidden");
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("keyup", "#searchreport", function () {
    let inputSearch = $(this).val();
    let category = $("#category").val();
    catalogo(inputSearch, category);
  });

  $(document).on("change", "#category", function () {
    let category = $(this).val();
    let inputSearch = $("#searchreport").val();
    catalogo(inputSearch, category);
  });

  //PAGINATION

  function tblCatalogsPagination() {
    let inputSearch = $("#searchreport").val();
    let category = $("#category").val();

    function tableContent(nextPage) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/catalog.php",
        type: "POST",
        data: { inputSearch: inputSearch, category: category, o: nextPage },
        success: function (data) {
          var tableContent = $(JSON.parse(data).html)
            .find("#catalogPag")
            .html();

          if (tableContent.trim() === "") {
            return;
          }

          var currentPage = nextPage;
          $("#currentPageIndicatorCatalog").text("Page: " + currentPage);

          $("#catalogPag").html(tableContent);

          $(".pagination #form-next-catalog input[name=o]").val(
            parseInt(currentPage) + 1
          );
          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;
          $(".pagination #form-previous-catalog input[name=o]").val(prev);

          let total = JSON.parse(data).total;

          if (currentPage == "1")
            $(".pagination #form-previous-catalog").attr("hidden", "");
          else $(".pagination #form-previous-catalog").removeAttr("hidden");

          console.log(parseInt(currentPage) * 12);
          console.log(total);

          if (parseInt(currentPage) * 12 >= total)
            $(".pagination #form-next-catalog").attr("hidden", "");
          else $(".pagination #form-next-catalog").removeAttr("hidden");
        },
        error: function () {
          alert("Error charging quote data.");
        },
      });
    }

    $(".pagination #form-next-catalog").submit(function (e) {
      e.preventDefault();
      var nextPage = $(this).find("input[name=o]").val();
      tableContent(nextPage);
    });

    $(".pagination #form-previous-catalog").submit(function (e) {
      e.preventDefault();
      var prevPage = $(this).find("input[name=o]").val();
      tableContent(prevPage);
    });
  }
});

jQuery(document).ready(function ($) {
  category();
  function category(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#category").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }
});
