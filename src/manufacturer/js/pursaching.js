jQuery(document).ready(function ($) {
  document.querySelector("#c-panel06 .banner").setAttribute("hidden", "");

  $(".my-quotes-nav").attr("hidden", "");

  if (document.querySelector("#search-bar-get-category").value != "") {
    $("#i-search").val($("#search-bar-get-text").val());
    $("#filterSearchCategorie").text($("#search-bar-get-category").val());
    $("#btnSearch").click();
  } else {
    $("#btnGenQuote").click();
  }
  $("#btnSearch").click(function () {
    console.log("Elemento clickeado!");
  });
});
