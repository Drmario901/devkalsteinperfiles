jQuery(document).ready(function ($) {
  $.ajax({
    url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/templateLetter.php",
    type: "GET",
    success: function (response) {
      // Insertar el contenido del PDF en el elemento 'pdfContainer'
      $("#pdfContainer").html(response);
    },
  });

  $(document).ready(function () {
    var currentPage = 1;
    var numPages = 3;

    function updateButtons() {
      $("#btnPrev").prop("disabled", currentPage == 1);
      $("#btnNext").prop("disabled", currentPage == numPages);
    }

    function updatePages() {
      for (var i = 1; i <= numPages; i++) {
        $(".cp0" + i).hide();
      }
      $(".cp0" + currentPage).show();
    }

    $("#btnPrev").click(function () {
      if (currentPage > 1) {
        currentPage--;
        updatePages();
        updateButtons();
      }
    });

    $("#btnNext").click(function () {
      if (currentPage < numPages) {
        currentPage++;
        updatePages();
        updateButtons();
      }
    });

    updatePages();
    updateButtons();
  });
});
