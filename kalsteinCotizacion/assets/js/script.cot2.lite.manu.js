jQuery(document).ready(function ($) {
  if (typeof im_in_shop === "undefined") {
    searchDepartment();

    $(document).on("click", "#li-department", function () {
      let valor = $(this).text();
      $("#filterSearchCategorie").text(valor);
    });

    $(document).on("keyup", "#i-search", function (e) {
      e.preventDefault();
      var valor = $(this).val();
      var department = $("#filterSearchCategorie").text();
      var path = $(location).attr("pathname");

      if (true) {
        if (valor != "") {
          searchProducts(valor, department);
          $(".sc").addClass("show");
          if (e.which === 13) {
            createdSession(valor, department);
            $(".sc").removeClass("show");
          }
        } else {
          $(".sc").removeClass("show");
        }
      } else {
        if (path == "/cotizacion/") {
          if (valor != "") {
            searchProducts_es(valor, department);
            $(".sc").addClass("show");
            if (e.which === 13) {
              createdSession(valor, department);
              location.reload();
            }
          } else {
            $(".sc").removeClass("show");
          }
        } else {
          if (path == "/wp-local/fr/" || path == "/wp-local/recherche/") {
            if (valor != "") {
              searchProducts_fr(valor, department);
              $(".sc").addClass("show");
              if (e.which === 13) {
                createdSession(valor, department);
                location.reload();
              }
            } else {
              $(".sc").removeClass("show");
            }
          } else {
            if (path == "/wp-local/de/" || path == "/wp-local/suchen/") {
              if (valor != "") {
                searchProducts_de(valor, department);
                $(".sc").addClass("show");
                if (e.which === 13) {
                  createdSession(valor, department);
                  location.reload();
                }
              } else {
                $(".sc").removeClass("show");
              }
            } else {
              if (path == "/wp-local/ee/" || path == "/wp-local/otsing/") {
                if (valor != "") {
                  searchProducts_ee(valor, department);
                  $(".sc").addClass("show");
                  if (e.which === 13) {
                    createdSession(valor, department);
                    location.reload();
                  }
                } else {
                  $(".sc").removeClass("show");
                }
              } else {
                if (path == "/wp-local/it/" || path == "/wp-local/ricerca/") {
                  if (valor != "") {
                    searchProducts_it(valor, department);
                    $(".sc").addClass("show");
                    if (e.which === 13) {
                      createdSession(valor, department);
                      location.reload();
                    }
                  } else {
                    $(".sc").removeClass("show");
                  }
                } else {
                  if (
                    path == "/wp-local/nl/" ||
                    path == "/wp-local/huiszoeking/"
                  ) {
                    if (valor != "") {
                      searchProducts_nl(valor, department);
                      $(".sc").addClass("show");
                      if (e.which === 13) {
                        createdSession(valor, department);
                        location.reload();
                      }
                    } else {
                      $(".sc").removeClass("show");
                    }
                  } else {
                    if (
                      path == "/wp-local/pl/" ||
                      path == "/wp-local/wyszukiwanie/"
                    ) {
                      if (valor != "") {
                        searchProducts_pl(valor, department);
                        $(".sc").addClass("show");
                        if (e.which === 13) {
                          createdSession(valor, department);
                          location.reload();
                        }
                      } else {
                        $(".sc").removeClass("show");
                      }
                    } else {
                      if (
                        path == "/wp-local/pt/" ||
                        path == "/wp-local/pesquisar/"
                      ) {
                        if (valor != "") {
                          searchProducts_pt(valor, department);
                          $(".sc").addClass("show");
                          if (e.which === 13) {
                            createdSession(valor, department);
                            location.reload();
                          }
                        } else {
                          $(".sc").removeClass("show");
                        }
                      } else {
                        if (
                          path == "/wp-local/se/" ||
                          path == "/wp-local/sok/"
                        ) {
                          if (valor != "") {
                            searchProducts_se(valor, department);
                            $(".sc").addClass("show");
                            if (e.which === 13) {
                              createdSession(valor, department);
                              location.reload();
                            }
                          } else {
                            $(".sc").removeClass("show");
                          }
                        } else {
                          if (valor != "") {
                            searchProducts_es(valor, department);
                            $(".sc").addClass("show");
                            if (e.which === 13) {
                              createdSession(valor, department);
                              location.reload();
                            }
                          } else {
                            $(".sc").removeClass("show");
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    });

    function searchProducts(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_es(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_es.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_fr(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_fr.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_de(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_de.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_ee(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_ee.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_it(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_it.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_nl(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_nl.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_pl(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_pl.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_pt(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_pt.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchProducts_se(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchbardb_se.php",
        type: "POST",
        dataType: "html",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          $(".sc").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }

    $(document).on("click", ".li-sug", function () {
      var valor = $(this).text();
      var categorie = $("#filterSearchCategorie").text();
      createdSession(valor, categorie);
      $(".sc").removeClass("show");
      $("#btn-quote-back").click();
      clickBtnGenQuote();
    });

    $(document).on("click", "#btnSearch", function (e) {
      console.log("entreee");
      e.preventDefault();
      var valor = $("#i-search").val();
      var categorie = $("#filterSearchCategorie").text();
      createdSession(valor, categorie);
      $(".sc").removeClass("show");
      $("#btn-quote-back").click();
      clickBtnGenQuote();
    });

    $(document).on("click", ".typeCategory", function () {
      var valor = $(this).text();
      var categorie = $("#filterSearchCategorie").text();
      createdSession(valor, categorie);
      scrollTo(0, 0);

      $("#btn-quote-back").click();
      $(".typeCategoryWidget").removeClass("fw-bold");
      $(".list-subcategory-widget").removeClass("fw-bold");
      $(this).addClass("fw-bold");
    });

    $(document).on("click", ".list-subcategory", function () {
      var valor = $(this).text();
      var categorie = $("#filterSearchCategorie").text();
      createdSession(valor, categorie);
      scrollTo(0, 0);

      $("#btn-quote-back").click();
      $(".typeCategoryWidget").removeClass("fw-bold");
      $(".list-subcategory-widget").removeClass("fw-bold");
      $(this).addClass("fw-bold");
    });

    function createdSession(consulta, consulta1) {
      window.location.href =
        "https://dev.kalstein.plus/plataforma/index.php/fabricante/tienda?search=" +
        consulta +
        "&category=" +
        consulta1;
    }

    function viewSearchRecent(consulta, consulta1) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/viewSearchRecent.php",
        type: "POST",
        data: { consulta, consulta1 },
      })
        .done(function (respuesta) {
          showProductSearched();
        })
        .fail(function () {
          console.log("error");
        });
    }

    function searchDepartment(consulta) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/searchDepartment.php",
        type: "POST",
        dataType: "html",
        data: { consulta },
      })
        .done(function (respuesta) {
          $(".cd").html(respuesta);
        })
        .fail(function () {
          console.log("error");
        });
    }
  }
});
