jQuery(document).ready(function ($) {
  searchCotizacion();
  searchCountry();
  searchCountry2();
  searchCountryRates();
  searchWeightAir();
  searchWeightAirEdit();
  searchWeightMaritime();
  searchWeightMaritimeEdit();
  searchRates();
  searchProductsTable();
  searchCategorie();

  $(document).on("click", ".u-file", function () {
    var msj = $("#i-file").val();
    if (msj == "") {
      msj = "No file selected";
      $(".msjFile").text(msj);
    }
  });

  $(document).on("change", "#i-file", function () {
    var msj = $(this).val();
    if (msj == "") {
      msj = "No file selected";
      $(".msjFile").text(msj);
      $("#btn-i").addClass("none");
    } else {
      msj = msj.replace(/^.*\\/, "");
      $(".msjFile").text(msj);
      $("#btn-i").removeClass("none");
    }
  });

  $(document).on("click", "#btn-i", function () {
    var file = $("#i-file")[0].files[0];
    var formData = new FormData();
    formData.append("file", file);

    $.ajax({
      contentType: "multipart/form-data",
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/uploadProducts.php",
      type: "POST",
      data: formData,
      dataType: "text",
      processData: false,
      contentType: false,
      cache: false,
    })
      .done(function (respuesta) {
        console.log(respuesta);
        var data = JSON.parse(respuesta);
        var failed = data.failed;
        if (data.update === "correcto") {
          alert("Data loaded successfully");
          $("#i-file").val("");
          $(".u-file").click();
          searchProductsTable();
          if (Object.entries(failed).length === 0) {
          } else {
            let msjM = "";
            $.each(failed, function (i, element) {
              var model = element.model;
              msjM += "    • " + model + "\n";
            });
            let msj =
              "The following codes were not loaded because they are already registered in the database:\n";
            alert(msj + msjM);
          }
          $("#btn-i").addClass("none");
        } else {
          if (data.update === "incorrecto") {
            alert("There was an error uploading the file");
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  });

  $(document).on("click", "#btnSavedProductChange", function () {
    var name = $("#txt-namePE").val();
    var model = $("#txt-modelPE").val();
    var netWeight = $("#txt-netWE").val();
    var grossWeight = $("#txt-grossWE").val();
    var long = $("#txt-longE").val();
    var width = $("#txt-widthE").val();
    var height = $("#txt-heightE").val();
    var long1 = $("#txt-long1E").val();
    var width1 = $("#txt-width1E").val();
    var height1 = $("#txt-height1E").val();
    var priceEUR = $("#txt-pricePE").val();
    var priceUSD = $("#txt-pricePU").val();

    updateProduct(
      model,
      name,
      netWeight,
      grossWeight,
      height,
      width,
      long,
      height1,
      width1,
      long1,
      priceUSD,
      priceEUR
    );
  });

  $(document).on("click", "#deleteP", function () {
    var valor = $(this).val();
    $("#modelDeleteP").text(valor);
    $("#modelDeleteP").val(valor);
  });

  $(document).on("click", "#confirmDeleteP", function () {
    var model = $("#modelDeleteP").val();
    eliminarProducto(model);
  });

  $(document).on("click", "#btn-u", function () {
    $("#i-file").click();
  });

  $(".btn-add").click(function (e) {
    e.preventDefault();
    let product = $("#i-search").val();
    let cant = $("#i-cant").val();
    let mEnvio = $("#envioM").val();
    let destination = $("#country").val();
    let incoterm = $("#incoterm").val();
    let chWeight = $("#ih-chWeight").val();
    let w3 = $("#ih-weight3").val();
    let coin = $("#divisa").val();

    if (product === "") {
      alert("Equipment model is required.");
      $("#i-search").focus();
    } else {
      if (cant === "") {
        alert("The quantity is required for the calculation of the quotation.");
        $("#i-cant").focus();
      } else {
        if (cant === "0") {
          alert("Product quantity must be greater than 0.");
        } else {
          if (mEnvio === "0") {
            alert("Shipping method is required.");
            $("#envioM").focus();
          } else {
            if (destination === "0") {
              alert("Destination is required.");
              $("#country").focus();
            } else {
              if (incoterm === "0") {
                alert("Incoterm is required.");
                $("#incoterm").focus();
              } else {
                searchProducts(
                  product,
                  cant,
                  mEnvio,
                  destination,
                  incoterm,
                  chWeight,
                  coin,
                  w3
                );
              }
            }
          }
        }
      }
    }
  });

  $(".btn-addE").click(function (e) {
    e.preventDefault();
    let product = $("#i-searchE").val();
    let cant = $("#i-cantE").val();
    let mEnvio = $("#envioME").val();
    let destination = $("#countryE").val();
    let incoterm = $("#incotermE").val();
    let chWeight = $("#ih-chWeight").val();
    let coin = $("#divisaE").val();

    if (product === "") {
      alert("Equipment model is required.");
      $("#i-search").focus();
    } else {
      if (cant === "") {
        alert("The quantity is required for the calculation of the quotation.");
        $("#i-cant").focus();
      } else {
        if (cant === "0") {
          alert("Product quantity must be greater than 0.");
        } else {
          if (mEnvio === "0") {
            alert("Shipping method is required.");
            $("#envioM").focus();
          } else {
            if (destination === "0") {
              alert("Destination is required.");
              $("#country").focus();
            } else {
              if (incoterm === "0") {
                alert("Incoterm is required.");
                $("#incoterm").focus();
              } else {
                searchProductsE(
                  product,
                  cant,
                  mEnvio,
                  destination,
                  incoterm,
                  chWeight,
                  coin
                );
              }
            }
          }
        }
      }
    }
  });

  $(document).on("keyup", "#i-search", function () {
    var valor = $(this).val().toUpperCase();
    $(this).val(valor);
  });

  $(document).on("keyup", "#i-searchCotizacion", function () {
    var valor = $(this).val();
    searchCotizacion(valor);
  });

  $(document).on("keyup", "#i-searchCountryRates", function () {
    var valor = $(this).val();
    searchRates(valor);
  });

  $(document).on("click", ".btnc", function (e) {
    $("#sres").val("");
    $("#atc").val("");
    $("#subtotal").val("0.00");
    $("#desc").val("0.00");
    $("#subtotal2").val("0.00");
    $("#envio").val("0.00");
    $("#total").val("0.00");
    $("#count").val("0");
    $("#countE").val("0");
    $("#incoterm").val("0");
    $("#divisa").val("0");
    $("#pago").val("0");
    $("#envioM").val("0");
    $("#country").val("0");
    $("#zipcode").val("");
    $("#list-product tr").remove();
    $("#list-productE tr").remove();
    $("#country").val(0);
    $("#ih-chWeight").val(0);
    $("#ih-weight3").val(0);
  });

  $(document).on("click", ".btncE", function (e) {
    $("#sresE").val("");
    $("#atcE").val("");
    $("#subtotalE").val("0.00");
    $("#descE").val("0.00");
    $("#subtotal2E").val("0.00");
    $("#envioE").val("0.00");
    $("#totalE").val("0.00");
    $("#count").val("0");
    $("#countE").val("0");
    $("#incotermE").val("0");
    $("#divisaE").val("0");
    $("#pagoE").val("0");
    $("#envioME").val("0");
    $("#countryE").val("0");
    $("#zipcodeE").val("");
    $("#list-product tr").remove();
    $("#list-productE tr").remove();
    $("#countryE").val(0);
    $("#ih-chWeight").val(0);
    $("#ih-weight3").val(0);
  });

  $(document).on("click", ".btn-cancelar", function (e) {
    $("#sres").val("");
    $("#atc").val("");
    $("#subtotal").val("0.00");
    $("#desc").val("0.00");
    $("#subtotal2").val("0.00");
    $("#envio").val("");
    $("#total").val("0.00");
    $("#count").val("0");
    $("#list-product tr").remove();
    $("#country").val(0);
  });

  $(document).on("click", ".btn-cancelarE", function (e) {
    $("#sresE").val("");
    $("#atcE").val("");
    $("#subtotalE").val("0.00");
    $("#descE").val("0.00");
    $("#subtotal2E").val("0.00");
    $("#envioE").val("");
    $("#totalE").val("0.00");
    $("#countEdit").val("0");
    $("#count").val("0");
    $("#country").val(0);
    $("#list-productE tr").remove();
  });

  $(document).on("click", "#view", function (e) {
    var valor = $(this).val();
    createdSession(valor);
  });

  $(document).on("click", "#edit", function (e) {
    var valor = $(this).val();
    editCotizacion(valor);
    $("#idEdit").val(valor);
  });

  $(document).on("click", "#erased", function (e) {
    var valor = $(this).val();
    $(".idDelete").text("QUO" + valor);
    $(".idDelete").val(valor);
  });

  $(document).on("click", "#deleteOk", function (e) {
    var valor = $(".idDelete").val();
    deleteCotizacion(valor);
  });

  $(document).on("click", "#w-close", function (e) {
    $("#weightMaritime").removeClass("block");
    $("#weightAir").removeClass("block");
    $("#weightMaritime").addClass("none");
    $("#weightAir").addClass("none");
    $("#country").val(0);
  });

  $(document).on("click", "#w-cancel", function (e) {
    $("#weightMaritime").removeClass("block");
    $("#weightAir").removeClass("block");
    $("#weightMaritime").addClass("none");
    $("#weightAir").addClass("none");
  });

  $(document).on("click", ".r-close", function (e) {
    $("#newWeightMaritime").removeClass("block");
    $("#newWeightAir").removeClass("block");
    $("#newWeightMaritime").addClass("none");
    $("#newWeightAir").addClass("none");
    $("#editWeightMaritime").removeClass("block");
    $("#editWeightAir").removeClass("block");
    $("#editWeightMaritime").addClass("none");
    $("#editWeightAir").addClass("none");
    $("#modifyRate-content").removeClass("block");
    $("#modifyRate-content").addClass("none");
    $("#newRate-content").removeClass("block");
    $("#newRate-content").addClass("none");
    $("#option1").removeAttr("checked");
    $("#option2").removeAttr("checked");
    $("#country").val(0);
    $("#country2").val(0);
    $("#weightAirNewRate").val(0);
    $("#weightMaritimeNewRate").val(0);
    $("#countryEdit").val(0);
    $("#weightTypeNew").val(0);
    $("#weightTypeEdit").val(0);
  });

  $(document).on("click", ".r-cancel", function (e) {
    $("#newWeightMaritime").removeClass("block");
    $("#newWeightAir").removeClass("block");
    $("#newWeightMaritime").addClass("none");
    $("#newWeightAir").addClass("none");
    $("#editWeightMaritime").removeClass("block");
    $("#editWeightAir").removeClass("block");
    $("#editWeightMaritime").addClass("none");
    $("#editWeightAir").addClass("none");
    $("#modifyRate-content").removeClass("block");
    $("#modifyRate-content").addClass("none");
    $("#newRate-content").removeClass("block");
    $("#newRate-content").addClass("none");
    $("#option1").removeAttr("checked");
    $("#option2").removeAttr("checked");
    $("#country").val(0);
    $("#country2").val(0);
    $("#weightAirNewRate").val(0);
    $("#weightMaritimeNewRate").val(0);
    $("#countryEdit").val(0);
    $("#weightTypeNew").val(0);
    $("#weightTypeEdit").val(0);
  });

  $(document).on("click", "#saveWeight", function (e) {
    if ($("#weightAir").hasClass("block")) {
      var valor = $("#i-kg").val();
      addWeightAir(valor);
    } else {
      if ($("#weightMaritime").hasClass("block")) {
        var valor = $("#i-m3").val();
        addWeightMaritime(valor);
      }
    }
  });

  $(document).on("click", "#option1", function (e) {
    $("#modifyRate-content").removeClass("none");
    $("#newRate-content").addClass("block");
    $("#modifyRate-content").removeClass("block");
    $("#modifyRate-content").addClass("none");
  });

  $(document).on("click", "#option2", function (e) {
    $("#modifyRate-content").removeClass("none");
    $("#modifyRate-content").addClass("block");
    $("#newRate-content").removeClass("block");
    $("#newRate-content").addClass("none");
    searchWeightAirEdit();
    searchWeightMaritimeEdit();
    searchCountryRates();
  });

  $(document).on("change", "#weightType", function (e) {
    var valor = $(this).val();
    if (valor === "1") {
      $("#weightMaritime").removeClass("block");
      $("#weightMaritime").addClass("none");
      $("#weightAir").removeClass("none");
      $("#weightAir").addClass("block");
    } else {
      if (valor === "2") {
        $("#weightAir").removeClass("block");
        $("#weightAir").addClass("none");
        $("#weightMaritime").removeClass("none");
        $("#weightMaritime").addClass("block");
      } else {
        $("#weightMaritime").removeClass("block");
        $("#weightAir").removeClass("block");
        $("#weightMaritime").addClass("none");
        $("#weightAir").addClass("none");
      }
    }
  });

  $(document).on("change", "#weightTypeEdit", function (e) {
    var valor = $(this).val();
    if (valor === "1") {
      $("#editWeightMaritime").removeClass("block");
      $("#editWeightMaritime").addClass("none");
      $("#editWeightAir").removeClass("none");
      $("#editWeightAir").addClass("block");
      var country = $("#countryEdit").val();
      searchWeightAirEdit(country);
    } else {
      if (valor === "2") {
        $("#editWeightAir").removeClass("block");
        $("#editWeightAir").addClass("none");
        $("#editWeightMaritime").removeClass("none");
        $("#editWeightMaritime").addClass("block");
        var country = $("#countryEdit").val();
        searchWeightAirEdit(country);
      } else {
        $("#editWeightMaritime").removeClass("block");
        $("#editWeightAir").removeClass("block");
        $("#editWeightMaritime").addClass("none");
        $("#editWeightAir").addClass("none");
      }
    }
  });

  $(document).on("click", "#btnSaved", function (e) {
    e.preventDefault();
    var sres = $("#sres").val();
    var atc = $("#atc").val();
    var subtotal = $("#subtotal").val();
    var desc = $("#desc").val();
    var subtotal2 = $("#subtotal2").val();
    var envio = $("#envio").val();
    var total = $("#total").val();
    var count = $("#count").val();
    var mEnvio = $("#envioM").val();
    var destino = $("#country").val();
    var zipcode = $("#zipcode").val();
    var incoterm = $("#incoterm").val();
    var divisa = $("#divisa").val();
    var pago = $("#pago").val();
    var nItem = parseInt(count) + parseInt(1);
    var url = $(location).attr("host") + "" + $(location).attr("pathname");
    var newUrl = url.replace("wp-admin/admin.php", "");
    let datas = [];

    for (let i = 1; i < nItem; i++) {
      let model = $("#i-hidden-" + i + "").val();
      let image = $("#ih-image-" + i + "").val();
      let maker = $("#ih-maker-" + i + "").val();
      let name = $("#name-" + i + "").text();
      let cant = $("#cant-" + i + "").text();
      let precio = $("#precio-" + i + "").text();
      let anidado = $("#ih-anidado-" + i + "").val();
      let totalprecio = $("#totalPrecio-" + i + "").text();

      datas.push({
        model: model,
        image: image,
        maker: maker,
        name: name,
        cant: cant,
        precio: precio,
        anidado: anidado,
        totalprecio: totalprecio,
      });
    }

    if (sres === "") {
      $("#sres").focus();
      alert(
        "There are fields that are empty, please provide the requested information."
      );
    } else {
      if (atc === "") {
        alert(
          "There are fields that are empty, please provide the requested information."
        );
        $("#atc").focus();
      } else {
        if (mEnvio === "0") {
          alert(
            "There are fields that are empty, please provide the requested information."
          );
          $("#envioM").focus();
        } else {
          if (destino === "0") {
            alert(
              "There are fields that are empty, please provide the requested information."
            );
            $("#country").focus();
          } else {
            if (zipcode === "") {
              alert(
                "There are fields that are empty, please provide the requested information."
              );
              $("#country").focus();
            } else {
              if (incoterm === "0") {
                alert(
                  "There are fields that are empty, please provide the requested information."
                );
                $("#incoterm").focus();
              } else {
                if (divisa === "0") {
                  alert(
                    "There are fields that are empty, please provide the requested information."
                  );
                  $("#divisa").focus();
                } else {
                  if (pago === "0") {
                    alert(
                      "There are fields that are empty, please provide the requested information."
                    );
                    $("#pago").focus();
                  } else {
                    if (total === "0.00") {
                      alert(
                        "There are fields that are empty, please provide the requested information."
                      );
                      $("#i-search").focus();
                    } else {
                      if (envio === "") {
                        alert(
                          "There are fields that are empty, please provide the requested information."
                        );
                        $("#envio").focus();
                      } else {
                        savedCotizacion(
                          sres,
                          atc,
                          subtotal,
                          desc,
                          subtotal2,
                          envio,
                          total,
                          datas,
                          incoterm,
                          divisa,
                          pago,
                          newUrl,
                          mEnvio,
                          destino,
                          zipcode
                        );
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

  $(document).on("click", "#btnSavedE", function (e) {
    e.preventDefault();
    var sres = $("#sresE").val();
    var atc = $("#atcE").val();
    var subtotal = $("#subtotalE").val();
    var desc = $("#descE").val();
    var subtotal2 = $("#subtotal2E").val();
    var envio = $("#envioE").val();
    var total = $("#totalE").val();
    var incoterm = $("#incotermE").val();
    var divisa = $("#divisaE").val();
    var pago = $("#pagoE").val();
    var mEnvio = $("#envioME").val();
    var destino = $("#countryE").val();
    var zipcode = $("#zipcodeE").val();
    var count = $("#countEdit").val();
    var nItem = parseInt(count) + parseInt(1);
    var count2 = $("#count").val();
    var nItem2 = parseInt(count2) + parseInt(1);
    var idEdit = $("#idEdit").val();
    let datas = [];
    let datas2 = [];

    for (let i = 1; i < nItem; i++) {
      let model = $(".iEe-hidden-" + i + "").val();
      let image = $(".ihEe-image-" + i + "").val();
      let maker = $(".ihEe-maker-" + i + "").val();
      let name = $(".nameEe-" + i + "").text();
      let cant = $(".cantEe-" + i + "").text();
      let precio = $(".precioEe-" + i + "").text();
      let anidado = $(".ihEe-anidado-" + i + "").val();
      let totalprecio = $(".totalPrecioEe-" + i + "").text();

      datas.push({
        model: model,
        image: image,
        maker: maker,
        name: name,
        cant: cant,
        precio: precio,
        totalprecio: totalprecio,
        anidado: anidado,
      });
    }

    for (let e = 1; e < nItem2; e++) {
      let aid = $("#iE-hidden-" + e + "").val();
      let model = $("#iEe-hidden-" + e + "").val();
      let precio = $("#ihE-precio-" + e + "").val();
      let anidado = $("#ihE-anidado-" + e + "").val();
      let totalprecio = $("#ihE-precioTotal-" + e + "").val();

      datas2.push({
        aid: aid,
        model: model,
        precio: precio,
        totalprecio: totalprecio,
        anidado: anidado,
      });
    }

    console.log(datas2);
    let nArray = datas.length;

    if (sres === "") {
      $("#sresE").focus();
      alert(
        "There are fields that are empty, please provide the requested information."
      );
    } else {
      if (atc === "") {
        alert(
          "There are fields that are empty, please provide the requested information."
        );
        $("#atcE").focus();
      } else {
        if (mEnvio === "0") {
          alert(
            "There are fields that are empty, please provide the requested information."
          );
          $("#envioME").focus();
        } else {
          if (destino === "0") {
            alert(
              "There are fields that are empty, please provide the requested information."
            );
            $("#countryE").focus();
          } else {
            if (zipcode === "") {
              alert(
                "There are fields that are empty, please provide the requested information."
              );
              $("#countryE").focus();
            } else {
              if (incoterm === "0") {
                alert(
                  "There are fields that are empty, please provide the requested information."
                );
                $("#incotermE").focus();
              } else {
                if (divisa === "0") {
                  alert(
                    "There are fields that are empty, please provide the requested information."
                  );
                  $("#divisaE").focus();
                } else {
                  if (pago === "0") {
                    alert(
                      "There are fields that are empty, please provide the requested information."
                    );
                    $("#pagoE").focus();
                  } else {
                    if (total === "0.00") {
                      alert(
                        "There are fields that are empty, please provide the requested information."
                      );
                      $("#i-searchE").focus();
                    } else {
                      if (envio === "") {
                        alert(
                          "There are fields that are empty, please provide the requested information."
                        );
                        $("#envioE").focus();
                      } else {
                        if (nArray === 0) {
                          updateCotizacion(
                            sres,
                            atc,
                            subtotal,
                            desc,
                            subtotal2,
                            envio,
                            total,
                            idEdit,
                            incoterm,
                            divisa,
                            pago,
                            mEnvio,
                            destino,
                            zipcode,
                            datas2
                          );
                        } else {
                          updateCotizacion2(
                            sres,
                            atc,
                            subtotal,
                            desc,
                            subtotal2,
                            envio,
                            total,
                            idEdit,
                            datas,
                            incoterm,
                            divisa,
                            pago,
                            mEnvio,
                            destino,
                            zipcode,
                            datas2
                          );
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

  $("#envio").keyup(function (e) {
    e.preventDefault();
    var valor = $(this).val();
    var subtotal = $("#subtotal2").val();

    if (valor != "") {
      if (e.keyCode == 13) {
        var sumar = parseFloat(valor) + parseFloat(subtotal);
        $("#total").val(sumar.toFixed(2));
      }
    } else {
      if (e.keyCode == 13) {
        $("#total").val(subtotal);
      }
    }
  });

  $("#envioE").keyup(function (e) {
    e.preventDefault();
    var valor = $(this).val();
    var subtotal = $("#subtotal2E").val();

    if (valor != "") {
      if (e.keyCode == 13) {
        var sumar = parseFloat(valor) + parseFloat(subtotal);
        $("#totalE").val(sumar.toFixed(2));
      }
    } else {
      if (e.keyCode == 13) {
        $("#totalE").val(subtotal);
      }
    }
  });

  function searchProducts(
    model,
    quantity,
    mEnvio,
    destination,
    incoterm,
    chWeight,
    coin,
    m3
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchProducts.php",
      type: "POST",
      data: {
        model,
        quantity,
        mEnvio,
        destination,
        incoterm,
        chWeight,
        coin,
        m3,
      },
    })
      .done(function (respuesta) {
        var nItem = $("#count").val();
        var subtotal = $("#subtotal").val();
        nItem = parseInt(nItem) + parseInt(1);
        var data = JSON.parse(respuesta);
        var precio = data.price;
        var cant = data.cant;
        var priceE = data.priceE;
        if (data.priceIncoterm === "0.00") {
          priceIncoterm = "";
        } else {
          var priceIncoterm = data.priceIncoterm;
          priceIncoterm = "(+" + priceIncoterm + ")";
        }
        if (data.limitePeso === "maximo") {
          alert(
            "Due to the company's policies and thinking about reducing a little your expenses, your products to list exceed 60kg, which would be a little expensive, for this reason your shipment will be by sea."
          );
          $("#envioM").val("Maritime");
          $("#btn-add").focus();
        } else {
          if (data.limitePeso === "permitido") {
            var precioAnidado =
              parseFloat(precio) + parseFloat(data.priceIncoterm);
            var totalprecio = parseFloat(precioAnidado) * parseFloat(cant);
            $("#list-product").append(
              "<tr id='item-" +
                nItem +
                "'><th scope='row' id='row-" +
                nItem +
                "'>" +
                nItem +
                "</th><td id='name-" +
                nItem +
                "'>" +
                data.name +
                "<input type='hidden' id='i-hidden-" +
                nItem +
                "' value='" +
                data.model +
                "'/><input type='hidden' id='ih-image-" +
                nItem +
                "' value='" +
                data.image +
                "'/><input type='hidden' id='ih-maker-" +
                nItem +
                "' value='" +
                data.description +
                "'/><input type='hidden' id='ih-anidado-" +
                nItem +
                "' value='" +
                data.priceIncoterm +
                "'/><input type='hidden' id='ih-weight-" +
                nItem +
                "' value='" +
                data.weight +
                "'/><input type='hidden' id='ih-m3-" +
                nItem +
                "' value='" +
                data.n3 +
                "'/></td><td id='cant-" +
                nItem +
                "'>" +
                data.cant +
                "</td><td id='precio-" +
                nItem +
                "'>" +
                data.price +
                " " +
                priceIncoterm +
                "</td><td id='totalPrecio-" +
                nItem +
                "'>" +
                totalprecio.toFixed(2) +
                "</td><td><button type='button' id='btnRemove' value='" +
                nItem +
                "' class='btn btn-danger btnR-" +
                nItem +
                "'>X</button></td></tr>"
            );

            $("#ih-weight3").val(data.m3);
            $("#ih-chWeight").val(data.chWeight);
            $("#count").val(nItem);
            var sumaSubtotal = parseFloat(totalprecio) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
            var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
            $("#desc").val(porcentajeDescuento.toFixed(2));
            var sumaSubtotal2 =
              parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
            $("#subtotal2").val(sumaSubtotal2.toFixed(2));
            $("#envio").val(priceE);
            var sumaTotal =
              parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
            $("#total").val(sumaTotal.toFixed(2));
            $("#i-search").val("");
            $("#i-cant").val("");
            $("#i-search").focus();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchProductsE(
    model,
    quantity,
    mEnvio,
    destination,
    incoterm,
    chWeight,
    coin
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchProducts.php",
      type: "POST",
      data: { model, quantity, mEnvio, destination, incoterm, chWeight, coin },
    })
      .done(function (respuesta) {
        var nItem = $("#count").val();
        var nItemE = $("#countEdit").val();
        var subtotal = $("#subtotalE").val();
        nItem = parseInt(nItem) + parseInt(1);
        nItemE = parseInt(nItemE) + parseInt(1);
        var data = JSON.parse(respuesta);
        var precio = data.price;
        var cant = data.cant;
        var priceE = data.priceE;
        if (data.priceIncoterm === "0.00") {
          priceIncoterm = "";
        } else {
          var priceIncoterm = data.priceIncoterm;
          priceIncoterm = "(+" + priceIncoterm + ")";
        }
        if (data.limitePeso === "maximo") {
          alert(
            "Due to company policies and thinking about reducing a little your expenses, your products to quote exceed 60kg which would be a bit expensive, for this reason we invite you to ship by sea."
          );
          $("#envioME").val("Maritime");
          $("#btn-addE").focus();
        } else {
          if (data.limitePeso === "permitido") {
            var precioAnidado =
              parseFloat(precio) + parseFloat(data.priceIncoterm);
            var totalprecio = parseFloat(precioAnidado) * parseFloat(cant);
            $("#list-productE").append(
              "<tr id='itemE-" +
                nItem +
                "'><th scope='row'>" +
                nItem +
                "</th><td id='nameEe-" +
                nItem +
                "' class='nameEe-" +
                nItemE +
                "'>" +
                data.name +
                "<input type='hidden' id='iEe-hidden-" +
                nItem +
                "' class='iEe-hidden-" +
                nItemE +
                "' value='" +
                data.model +
                "'/><input type='hidden' id='ihE-image-" +
                nItem +
                "' class='ihEe-image-" +
                nItemE +
                "' value='" +
                data.image +
                "'/><input type='hidden' id='ihE-maker-" +
                nItem +
                "' class='ihEe-maker-" +
                nItemE +
                "' value='" +
                data.description +
                "'/><input type='hidden' id='ihE-anidado-" +
                nItem +
                "' class='ihEe-anidado-" +
                nItemE +
                "' value='" +
                data.priceIncoterm +
                "'/><input type='hidden' id='ihE-weight-" +
                nItem +
                "' class='ihE-weight-" +
                nItemE +
                "' value='" +
                data.weight +
                "'/></td><td id='cantE-" +
                nItem +
                "' class='cantEe-" +
                nItemE +
                "'>" +
                data.cant +
                "</td><td id='precioE-" +
                nItem +
                "' class='precioEe-" +
                nItemE +
                "''>" +
                data.price +
                " " +
                priceIncoterm +
                "</td><td id='totalPrecioE-" +
                nItem +
                "' class='totalPrecioEe-" +
                nItemE +
                "'>" +
                totalprecio.toFixed(2) +
                "</td><td><button type='button' id='btnRemoveE' value='" +
                nItem +
                "' class='btn btn-danger btnRE-" +
                nItem +
                "'>X</button></td></tr>"
            );

            $("#ih-chWeight").val(data.chWeight);
            $("#count").val(nItem);
            $("#countEdit").val(nItemE);
            var sumaSubtotal = parseFloat(totalprecio) + parseFloat(subtotal);
            $("#subtotalE").val(sumaSubtotal.toFixed(2));
            var porcentajeDescuento = parseFloat($("#subtotalE").val() * 0.18);
            $("#descE").val(porcentajeDescuento.toFixed(2));
            var sumaSubtotal2 =
              parseFloat($("#subtotalE").val()) - parseFloat($("#descE").val());
            $("#subtotal2E").val(sumaSubtotal2.toFixed(2));
            $("#envioE").val(priceE);
            var sumaTotal =
              parseFloat($("#subtotal2E").val()) +
              parseFloat($("#envioE").val());
            $("#totalE").val(sumaTotal.toFixed(2));
            $("#i-searchE").val("");
            $("#i-cantE").val("");
            $("#i-searchE").focus();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function removeProducto(chWeight, destination, mEnvio, m3) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/shippingRecalcule.php",
      type: "POST",
      data: { chWeight, destination, mEnvio, m3 },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        var priceE = data.priceE;
        $("#envio").val(priceE);
        var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
        $("#desc").val(porcentajeDescuento.toFixed(2));
        var sumaSubtotal2 =
          parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
        $("#subtotal2").val(sumaSubtotal2.toFixed(2));
        var envio = $("#envio").val();
        var subtotal = $("#subtotal2").val();
        var sumar = parseFloat(envio) + parseFloat(subtotal);
        $("#total").val(sumar.toFixed(2));
      })
      .fail(function () {
        console.log("error");
      });
  }

  function removeProductoE(chWeight, destination, mEnvio, m3) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/shippingRecalcule.php",
      type: "POST",
      data: { chWeight, destination, mEnvio, m3 },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        var priceE = data.priceE;
        $("#envioE").val(priceE);
        var porcentajeDescuento = parseFloat($("#subtotalE").val() * 0.18);
        $("#descE").val(porcentajeDescuento.toFixed(2));
        var sumaSubtotal2 =
          parseFloat($("#subtotalE").val()) - parseFloat($("#descE").val());
        $("#subtotal2E").val(sumaSubtotal2.toFixed(2));
        var envio = $("#envioE").val();
        var subtotal = $("#subtotal2E").val();
        var sumar = parseFloat(envio) + parseFloat(subtotal);
        $("#totalE").val(sumar.toFixed(2));
      })
      .fail(function () {
        console.log("error");
      });
  }

  function changeOptions(
    chWeight,
    destination,
    mEnvio,
    incoterm,
    datas,
    coin,
    m3
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/changeShipping.php",
      type: "POST",
      data: { chWeight, destination, mEnvio, incoterm, datas, coin, m3 },
    })
      .done(function (respuesta) {
        console.log(respuesta);
        var data = JSON.parse(respuesta);
        var array = data.data;
        var priceE = data.priceE;
        var count = $("#count").val();

        if (data.limitePeso === "maximo") {
          alert(
            "Due to the company's policies and thinking about reducing a little your expenses, your products to list exceed 60kg, which would be a little expensive, for this reason your shipment will be by sea."
          );
          $("#envioM").val("Maritime");
          $("#btn-add").focus();
        } else {
          $("#subtotal").val("0.00");
          for (let i = 0; i < count; i++) {
            var priceIncoterm = array[i].priceIncoterm;
            var price = array[i].price;
            var a = parseInt(i) + parseInt(1);
            var cant = $("#cant-" + a).text();
            var subtotal = $("#subtotal").val();

            var precioAnidado = parseFloat(price) + parseFloat(priceIncoterm);
            var precioTotal = parseFloat(precioAnidado) * parseFloat(cant);

            if (priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }

            $("#precio-" + a).text(price + " " + priceIncoterm);
            $("#ih-anidado-" + a).val(array[i].priceIncoterm);
            $("#totalPrecio-" + a).text(precioTotal.toFixed(2));
            var sumaSubtotal =
              parseFloat($("#totalPrecio-" + a).text()) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
          }

          $("#envio").val(priceE);
          var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
          $("#desc").val(porcentajeDescuento.toFixed(2));
          var sumaSubtotal2 =
            parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
          $("#subtotal2").val(sumaSubtotal2.toFixed(2));
          $("#envio").val(priceE);
          var sumaTotal =
            parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
          $("#total").val(sumaTotal.toFixed(2));
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function changeOptionsE(
    chWeight,
    destination,
    mEnvio,
    incoterm,
    datas,
    coin,
    m3
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/changeShipping.php",
      type: "POST",
      data: { chWeight, destination, mEnvio, incoterm, datas, coin, m3 },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        var array = data.data;
        var priceE = data.priceE;
        var count = $("#count").val();

        if (data.limitePeso === "maximo") {
          alert(
            "Due to the company's policies and thinking about reducing a little your expenses, your products to list exceed 60kg, which would be a little expensive, for this reason your shipment will be by sea."
          );
          $("#envioME").val("Maritime");
          $("#btn-addE").focus();
        } else {
          $("#subtotalE").val("0.00");
          for (let i = 0; i < count; i++) {
            var priceIncoterm = array[i].priceIncoterm;
            var price = array[i].price;
            var a = parseInt(i) + parseInt(1);
            var cant = $("#cantE-" + a).text();
            var subtotal = $("#subtotalE").val();
            $("#ihE-precio-" + a + "").val(price);
            $("#ihE-anidado-" + a + "").val(priceIncoterm);

            var precioAnidado = parseFloat(price) + parseFloat(priceIncoterm);
            var precioTotal = parseFloat(precioAnidado) * parseFloat(cant);
            $("#ihE-precioTotal-" + a + "").val(precioTotal.toFixed(2));

            if (priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }

            $("#precioE-" + a).text(price + " " + priceIncoterm);
            $("#totalPrecioE-" + a).text(precioTotal.toFixed(2));
            var sumaSubtotal =
              parseFloat($("#totalPrecioE-" + a).text()) + parseFloat(subtotal);
            $("#subtotalE").val(sumaSubtotal.toFixed(2));
          }

          $("#envioE").val(priceE);
          var porcentajeDescuento = parseFloat($("#subtotalE").val() * 0.18);
          $("#descE").val(porcentajeDescuento.toFixed(2));
          var sumaSubtotal2 =
            parseFloat($("#subtotalE").val()) - parseFloat($("#descE").val());
          $("#subtotal2E").val(sumaSubtotal2.toFixed(2));
          $("#envioE").val(priceE);
          var sumaTotal =
            parseFloat($("#subtotal2E").val()) + parseFloat($("#envioE").val());
          $("#totalE").val(sumaTotal.toFixed(2));
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function createdSession(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/createSession.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        window.open(
          "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/createPDF.php",
          "_blank"
        );
        location = location;
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchCotizacion(consulta, newUrl) {
    var url = $(location).attr("host") + "" + $(location).attr("pathname");
    var newUrl = url.replace("wp-admin/admin.php", "");

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchCotizacion.php",
      type: "POST",
      data: { consulta, newUrl },
    })
      .done(function (respuesta) {
        $("#cc").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function savedCotizacion(
    sres,
    atc,
    subtotal,
    desc,
    subtotal2,
    envio,
    total,
    datas,
    incoterm,
    divisa,
    pago,
    newUrl,
    mEnvio,
    destino,
    zipcode
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/registerCotizacion.php",
      type: "POST",
      data: {
        sres,
        atc,
        subtotal,
        desc,
        subtotal2,
        envio,
        total,
        datas,
        incoterm,
        divisa,
        pago,
        newUrl,
        mEnvio,
        destino,
        zipcode,
      },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.registro === "correcto") {
          alert("Quote was made successfully.");
          searchCotizacion();
          $(".btnc").click();
          var id = data.id;
          createdSession(id);
          $("#ih-chWeight").val(0);
        } else {
          alert("Quote creation failed due to an error.");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function updateCotizacion(
    sres,
    atc,
    subtotal,
    desc,
    subtotal2,
    envio,
    total,
    idEdit,
    incoterm,
    divisa,
    pago,
    mEnvio,
    destino,
    zipcode,
    datas2
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/updateCotizacion.php",
      type: "POST",
      data: {
        sres,
        atc,
        subtotal,
        desc,
        subtotal2,
        envio,
        total,
        idEdit,
        incoterm,
        divisa,
        pago,
        mEnvio,
        destino,
        zipcode,
        datas2,
      },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          alert("The quote was successfully changed!");
          searchCotizacion();
          $(".btncE").click();
          var id = data.id;
          createdSession(id);
          $("#ih-chWeight").val(0);
        } else {
          alert("The quote could not be modified due to an error.");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function updateCotizacion2(
    sres,
    atc,
    subtotal,
    desc,
    subtotal2,
    envio,
    total,
    idEdit,
    datas,
    incoterm,
    divisa,
    pago,
    mEnvio,
    destino,
    zipcode,
    datas2
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateCotizacion2.php",
      type: "POST",
      data: {
        sres,
        atc,
        subtotal,
        desc,
        subtotal2,
        envio,
        total,
        idEdit,
        datas,
        incoterm,
        divisa,
        pago,
        mEnvio,
        destino,
        zipcode,
        datas2,
      },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          alert("The quote was successfully changed!");
          searchCotizacion();
          $(".btncE").click();
          var id = data.id;
          createdSession(id);
        } else {
          alert("The quote could not be modified due to an error..");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function editCotizacion(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/editCotizacion.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        var sres = data.sres;
        var atc = data.atc;
        var subtotal = data.subtotal;
        var desc = data.desc;
        var subtotal2 = data.subtotal2;
        var mEnvio = data.mEnvio;
        var destino = data.destino;
        var zipcode = data.zipcode;
        var envio = data.envio;
        var total = data.total;
        var incoterm = data.incoterm;
        var divisa = data.divisa;
        var pago = data.pago;
        var a = data.data;
        var nItem = $("#count").val();

        $("#sresE").val(sres);
        $("#atcE").val(atc);
        $("#subtotalE").val(subtotal);
        $("#descE").val(desc);
        $("#subtotal2E").val(subtotal2);
        $("#envioME").val(mEnvio);
        $("#countryE").val(destino);
        $("#zipcodeE").val(zipcode);
        $("#incotermE").val(incoterm);
        $("#divisaE").val(divisa);
        $("#pagoE").val(pago);
        $("#envioE").val(envio);
        $("#totalE").val(total);

        $.each(a, function (i, element) {
          var ch = $("#ih-chWeight").val();
          var wm3 = $("#ih-weight3").val();
          var aid = element.aid;
          var model = element.model;
          var chWeight = element.chWeight;
          var name = element.name;
          var cant = element.cant;
          var valorU = element.valorU;
          var valorT = element.valorT;
          var valorA = element.valorA;
          var n3 = element.n3;
          if (valorA === "0.00") {
            var valorA = "";
          } else {
            var valorA = " (+" + valorA + ")";
          }
          var chPlus = parseInt(ch) + parseInt(chWeight);
          $("#ih-chWeight").val(chPlus);
          var wm3Plus = parseFloat(wm3) + parseFloat(n3);
          $("#ih-weight3").val(wm3Plus);
          nItem = parseInt(nItem) + parseInt(1);
          $("#count").val(nItem);

          $("#list-productE").append(
            "<tr id='itemE-" +
              nItem +
              "'><th scope='rowE' id='rowE-" +
              nItem +
              "'>" +
              nItem +
              "</th><td id='nameE-" +
              nItem +
              "'>" +
              name +
              "<input type='hidden' id='iE-hidden-" +
              nItem +
              "' value='" +
              aid +
              "'/><input type='hidden' id='iEe-hidden-" +
              nItem +
              "' value='" +
              model +
              "'/><input type='hidden' id='ihE-weight-" +
              nItem +
              "' value='" +
              chWeight +
              "'/><input type='hidden' id='ihE-m3-" +
              nItem +
              "' value='" +
              n3 +
              "'/><input type='hidden' id='ihE-precio-" +
              nItem +
              "' value='" +
              valorU +
              "'/><input type='hidden' id='ihE-precioTotal-" +
              nItem +
              "' value='" +
              valorT +
              "'/><input type='hidden' id='ihE-anidado-" +
              nItem +
              "' value='" +
              element.valorA +
              "'/></td><td id='cantE-" +
              nItem +
              "'>" +
              cant +
              "</td><td id='precioE-" +
              nItem +
              "'>" +
              valorU +
              valorA +
              "</td><td id='totalPrecioE-" +
              nItem +
              "'>" +
              valorT +
              "</td><td><button type='button' id='btnRemoveE' value='" +
              nItem +
              "' class='btn btn-danger btnRE-" +
              nItem +
              "'>X</button></td></tr>"
          );
        });
      })
      .fail(function () {
        console.log("error");
      });
  }

  function editProduct(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/editProduct.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        $("#txt-namePE").val(data.name);
        $("#txt-modelPE").val(data.model);
        $("#txt-netWE").val(data.netWeight);
        $("#txt-grossWE").val(data.grossWeight);
        $("#txt-longE").val(data.long);
        $("#txt-widthE").val(data.width);
        $("#txt-heightE").val(data.height);
        $("#txt-long1E").val(data.long1);
        $("#txt-width1E").val(data.width1);
        $("#txt-height1E").val(data.height1);
        $("#txt-pricePE").val(data.priceEUR);
        $("#txt-pricePU").val(data.priceUSD);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function updateProduct(
    model,
    name,
    netWeight,
    grossWeight,
    height,
    width,
    long,
    height1,
    width1,
    long1,
    priceUSD,
    priceEUR
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateProduct.php",
      type: "POST",
      data: {
        model,
        name,
        netWeight,
        grossWeight,
        height,
        width,
        long,
        height1,
        width1,
        long1,
        priceUSD,
        priceEUR,
      },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          alert("The product was successfully updated");
          searchProductsTable();
          $("#btnClosedEditProduct").click();
        } else {
          if (data.update === "incorrecto") {
            alert("The product was not modified because of an error");
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function eliminarProducto(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/eliminarProducto.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.delete === "correcto") {
          alert("The product was successfully deleted");
          searchProductsTable();
          $("#btnClosedDP").click();
        } else {
          if (data.delete === "incorrecto") {
            alert("The product was not deleted due to an error");
          }
        }
      })
      .fail(function () {});
  }

  function deleteCotizacion(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/deleteCotizacion.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $data = JSON.parse(respuesta);
        if ($data.delete === "correcto") {
          alert("Quote was successfully removed!");
          $(".btn-close").click();
          searchCotizacion();
        } else {
          alert("Quote delete error occurred.");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function deleteProduct(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/deleteProduct.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {})
      .fail(function () {
        console.log("error");
      });
  }

  function searchCountry(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/searchCountry.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#country").html(respuesta);
        $("#countryE").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchCountry2(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/searchCountry2.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#country2").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchCountryRates(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchCountryRates.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#countryEdit").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchWeightAir(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchWeightAir.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#weightAirNewRate").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchWeightAirEdit(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchWeightAirEdit.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#weightAirEditRate").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchWeightMaritime(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchWeightMaritime.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#weightMaritimeNewRate").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchWeightMaritimeEdit(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchWeightMaritimeEdit.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#weightMaritimeEditRate").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function addWeightAir(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/alterAir.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.register === "exists") {
          alert(
            "The weight you are trying to add already exists in the database"
          );
        } else {
          if (data.register === "correcto") {
            alert("Weight was successfully recorded");
            $("#i-kg").val("");
            $("#weightType").val(0);
            $("#weightMaritime").removeClass("block");
            $("#weightAir").removeClass("block");
            $("#weightMaritime").addClass("none");
            $("#weightAir").addClass("none");
            searchWeightAir();
            searchRates();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function addWeightMaritime(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/alterMaritime.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.register === "exists") {
          alert(
            "The weight you are trying to add already exists in the database"
          );
        } else {
          if (data.register === "correcto") {
            alert("Weight was successfully recorded");
            $("#weightMaritime").removeClass("block");
            $("#weightAir").removeClass("block");
            $("#weightMaritime").addClass("none");
            $("#weightAir").addClass("none");
            $("#i-m3").val("");
            $("#weightType").val(0);
            searchWeightMaritime();
            searchRates();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function registerRateAir(country, weight, price) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/registerRateAir.php",
      type: "POST",
      data: { country, weight, price },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.register === "exists") {
          alert(
            "The country rate you are trying to add already exists in the database"
          );
        } else {
          if (data.register === "correcto") {
            alert("The country rate's was successfully recorded");
            $("#i-airPrice").val("");
            $("#option1").removeAttr("checked");
            $("#newRate-content").removeClass("block");
            $("#newRate-content").addClass("none");
            $("#newWeightAir").removeClass("block");
            $("#newWeightMaritime").removeClass("block");
            $("#newWeightAir").addClass("none");
            $("#newWeightMaritime").addClass("none");
            $("#weightAirNewRate").val(0);
            $("#weightTypeNew").val(0);
            $("#country2").val(0);
            searchWeightMaritime();
            searchRates();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function registerRateMaritime(country, weight, price) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/registerRateMaritime.php",
      type: "POST",
      data: { country, weight, price },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.register === "exists") {
          alert(
            "The country rate you are trying to add already exists in the database"
          );
        } else {
          if (data.register === "correcto") {
            alert("The country rate's was successfully recorded");
            $("#i-maritimePrice").val("");
            $("#option1").removeAttr("checked");
            $("#newRate-content").removeClass("block");
            $("#newRate-content").addClass("none");
            $("#newWeightAir").removeClass("block");
            $("#newWeightMaritime").removeClass("block");
            $("#newWeightAir").addClass("none");
            $("#newWeightMaritime").addClass("none");
            $("#weightMaritimeNewRate").val(0);
            $("#weightTypeNew").val(0);
            $("#country2").val(0);
            searchWeightMaritime();
            searchRates();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function updateRateAir(country, weight, price) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateRateAir.php",
      type: "POST",
      data: { country, weight, price },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          alert("The rate was successfully changed!");
          searchRates();
          $("#i-airPriceEdit").val("");
          $("#option2").removeAttr("checked");
          $("#modifyRate-content").removeClass("block");
          $("#modifyRate-content").addClass("none");
          $("#editWeightAir").removeClass("block");
          $("#editWeightMaritime").removeClass("block");
          $("#editWeightAir").addClass("none");
          $("#editWeightMaritime").addClass("none");
          $("#weightAirEditRate").val(0);
          $("#weightTypeEdit").val(0);
          $("#countryEdit").val(0);
        } else {
          alert("The rate could not be modified due to an error.");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function updateRateMaritime(country, weight, price) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateRateMaritime.php",
      type: "POST",
      data: { country, weight, price },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          alert("The rate was successfully changed!");
          searchRates();
          $("#i-maritimePriceEdit").val("");
          $("#option2").removeAttr("checked");
          $("#modifyRate-content").removeClass("block");
          $("#modifyRate-content").addClass("none");
          $("#editWeightAir").removeClass("block");
          $("#editWeightMaritime").removeClass("block");
          $("#editWeightAir").addClass("none");
          $("#editWeightMaritime").addClass("none");
          $("#weightMaritimeEditRate").val(0);
          $("#weightTypeEdit").val(0);
          $("#countryEdit").val(0);
        } else {
          alert("The rate could not be modified due to an error.");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchRates(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchRates.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#rc").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchPriceWeightAir(consulta, consulta2) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchPriceWeightAir.php",
      type: "POST",
      data: { consulta, consulta2 },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        $("#i-airPriceEdit").val(data.price);
        $("#i-airPriceEdit").focus();
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchPriceWeightMaritime(consulta, consulta2) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchPriceWeightMaritime.php",
      type: "POST",
      data: { consulta, consulta2 },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        $("#i-maritimePriceEdit").val(data.price);
        $("#i-maritimePriceEdit").focus();
      })
      .fail(function () {
        console.log("error");
      });
  }

  function registerProduct(
    model,
    name,
    price,
    netWeight,
    grossWeight,
    long,
    width,
    height,
    long1,
    width1,
    height1
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/registerProduct.php",
      type: "POST",
      data: {
        model,
        name,
        price,
        netWeight,
        grossWeight,
        long,
        width,
        height,
        long1,
        width1,
        height1,
      },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.register === "exists") {
          alert("The product is already registered in the database.");
        } else {
          if (data.register === "correcto") {
            alert("The product was successfully registered in the database");
            $(".p-close").click();
            searchProductsTable();
          } else {
            alert("The product was not registered due to an error");
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnRemove", function () {
    var valor = $(this).val();
    var weight = $("#ih-weight-" + valor + "").val();
    var m3 = $("#ih-m3-" + valor + "").val();
    var destination = $("#country").val();
    var envioM = $("#envioM").val();
    var chWeight = $("#ih-chWeight").val();
    var wm3 = $("#ih-weight3").val();
    var newM3 = parseFloat(wm3) - parseFloat(m3);
    $("#ih-weight3").val(newM3.toFixed(3));
    var newWM3 = $("#ih-weight3").val();
    var newWeight = parseFloat(chWeight) - parseFloat(weight);
    $("#ih-chWeight").val(newWeight.toFixed(2));
    var newCH = $("#ih-chWeight").val();
    removeProducto(newCH, destination, envioM, newWM3);
    var totalPrecio = $("#totalPrecio-" + valor + "").text();
    var subtotal = $("#subtotal").val();
    var restar = parseFloat(subtotal) - parseFloat(totalPrecio);
    $("#subtotal").val(restar.toFixed(2));

    $("#item-" + valor + "").remove();
    var count = parseInt($("#count").val()) + parseInt(1);
    var lessItem = parseInt($("#count").val()) - parseInt(1);

    for (let i = 1; i < count; i++) {
      var item = $("#item-" + i).attr("id");
      if (item === "item-1") {
        var a = 1;
        $("#item-" + i).attr("id", "item-" + a);
        $("#name-" + i).attr("id", "name-" + a);
        $("#cant-" + i).attr("id", "cant-" + a);
        $("#precio-" + i).attr("id", "precio-" + a);
        $("#totalPrecio-" + i).attr("id", "totalPrecio-" + a);
        $("#i-hidden-" + i).attr("id", "i-hidden-" + a);
        $("#ih-image-" + i).attr("id", "ih-image-" + a);
        $("#ih-maker-" + i).attr("id", "ih-maker-" + a);
        $("#ih-anidado-" + i).attr("id", "ih-anidado-" + a);
        $("#ih-weight-" + i).attr("id", "ih-weight-" + a);
        $("#ih-m3-" + i).attr("id", "ih-m3-" + a);
        $("#row-" + i)
          .attr("id", "row-" + a)
          .text(a);
        $("#btnRemove ." + i + "")
          .removeClass(i)
          .addClass(a)
          .val(a);
      } else {
        if (item === "item-2" && $("#item-1").length > 0) {
          var a = 2;
          $("#item-" + i).attr("id", "item-" + a);
          $("#name-" + i).attr("id", "name-" + a);
          $("#cant-" + i).attr("id", "cant-" + a);
          $("#precio-" + i).attr("id", "precio-" + a);
          $("#totalPrecio-" + i).attr("id", "totalPrecio-" + a);
          $("#i-hidden-" + i).attr("id", "i-hidden-" + a);
          $("#ih-image-" + i).attr("id", "ih-image-" + a);
          $("#ih-maker-" + i).attr("id", "ih-maker-" + a);
          $("#ih-anidado-" + i).attr("id", "ih-anidado-" + a);
          $("#ih-weight-" + i).attr("id", "ih-weight-" + a);
          $("#ih-m3-" + i).attr("id", "ih-m3-" + a);
          $("#row-" + i)
            .attr("id", "row-" + a)
            .text(a);
          $("#btnRemove ." + i + "")
            .removeClass(i)
            .addClass(a)
            .val(a);
        } else {
          var a = parseInt(i) - parseInt(1);
          $("#item-" + i).attr("id", "item-" + a);
          $("#name-" + i).attr("id", "name-" + a);
          $("#cant-" + i).attr("id", "cant-" + a);
          $("#precio-" + i).attr("id", "precio-" + a);
          $("#totalPrecio-" + i).attr("id", "totalPrecio-" + a);
          $("#i-hidden-" + i).attr("id", "i-hidden-" + a);
          $("#ih-image-" + i).attr("id", "ih-image-" + a);
          $("#ih-maker-" + i).attr("id", "ih-maker-" + a);
          $("#ih-anidado-" + i).attr("id", "ih-anidado-" + a);
          $("#ih-weight-" + i).attr("id", "ih-weight-" + a);
          $("#ih-m3-" + i).attr("id", "ih-m3-" + a);
          $("#row-" + i)
            .attr("id", "row-" + a)
            .text(a);
          $(".btnR-" + i + "")
            .removeClass("btnR-" + i + "")
            .addClass("btnR-" + a + "")
            .val(a);
        }
      }
    }
    $("#count").val(lessItem);
  });

  $(document).on("click", "#btnRemoveE", function () {
    var valor = $(this).val();
    var weight = $("#ihE-weight-" + valor + "").val();
    var m3 = $("#ihE-m3-" + valor + "").val();
    var destination = $("#countryE").val();
    var envioM = $("#envioME").val();
    var chWeight = $("#ih-chWeight").val();
    var wm3 = $("#ih-weight3").val();
    var newM3 = parseFloat(wm3) - parseFloat(m3);
    $("#ih-weight3").val(newM3.toFixed(3));
    var newWM3 = $("#ih-weight3").val();
    var newWeight = parseInt(chWeight) - parseInt(weight);
    $("#ih-chWeight").val(newWeight);
    var newCH = $("#ih-chWeight").val();
    var aid = $("#iE-hidden-" + valor + "").val();
    deleteProduct(aid);
    removeProductoE(newCH, destination, envioM, newWM3);
    var totalPrecio = $("#totalPrecioE-" + valor + "").text();
    var subtotal = $("#subtotalE").val();
    var restar = parseFloat(subtotal) - parseFloat(totalPrecio);
    $("#subtotalE").val(restar.toFixed(2));

    $("#itemE-" + valor + "").remove();
    var count = parseInt($("#count").val()) + parseInt(1);
    var lessItem = parseInt($("#count").val()) - parseInt(1);

    for (let i = 1; i < count; i++) {
      var item = $("#itemE-" + i).attr("id");
      if (item === "itemE-1") {
        var a = 1;
        $("#itemE-" + i).attr("id", "itemE-" + a);
        $("#nameE-" + i).attr("id", "nameE-" + a);
        $("#cantE-" + i).attr("id", "cantE-" + a);
        $("#precioE-" + i).attr("id", "precioE-" + a);
        $("#totalPrecioE-" + i).attr("id", "totalPrecioE-" + a);
        $("#iE-hidden-" + i).attr("id", "iE-hidden-" + a);
        $("#iEe-hidden-" + i).attr("id", "iEe-hidden-" + a);
        $("#ihE-weight-" + i).attr("id", "ihE-weight-" + a);
        $("#ihE-precio-" + i).attr("id", "ihE-precio-" + a);
        $("#ihE-precioTotal-" + i).attr("id", "ihE-precioTotal-" + a);
        $("#ihE-anidado-" + i).attr("id", "ihE-anidado-" + a);
        $("#ihE-m3-" + i).attr("id", "ihE-m3-" + a);
        $("#rowE-" + i)
          .attr("id", "rowE-" + a)
          .text(a);
        $(".btnRE-" + i + "")
          .removeClass("btnRE-" + i + "")
          .addClass("btnRE-" + a + "")
          .val(a);
      } else {
        if (item === "item-2" && $("#item-1").length > 0) {
          var a = 2;
          $("#itemE-" + i).attr("id", "itemE-" + a);
          $("#nameE-" + i).attr("id", "nameE-" + a);
          $("#cantE-" + i).attr("id", "cantE-" + a);
          $("#precioE-" + i).attr("id", "precioE-" + a);
          $("#totalPrecioE-" + i).attr("id", "totalPrecioE-" + a);
          $("#iE-hidden-" + i).attr("id", "iE-hidden-" + a);
          $("#iEe-hidden-" + i).attr("id", "iEe-hidden-" + a);
          $("#ihE-weight-" + i).attr("id", "ihE-weight-" + a);
          $("#ihE-precio-" + i).attr("id", "ihE-precio-" + a);
          $("#ihE-precioTotal-" + i).attr("id", "ihE-precioTotal-" + a);
          $("#ihE-anidado-" + i).attr("id", "ihE-anidado-" + a);
          $("#ihE-m3-" + i).attr("id", "ihE-m3-" + a);
          $("#rowE-" + i)
            .attr("id", "rowE-" + a)
            .text(a);
          $(".btnRE-" + i + "")
            .removeClass("btnRE-" + i + "")
            .addClass("btnRE-" + a + "")
            .val(a);
        } else {
          var a = parseInt(i) - parseInt(1);
          $("#itemE-" + i).attr("id", "itemE-" + a);
          $("#nameE-" + i).attr("id", "nameE-" + a);
          $("#cantE-" + i).attr("id", "cantE-" + a);
          $("#precioE-" + i).attr("id", "precioE-" + a);
          $("#totalPrecioE-" + i).attr("id", "totalPrecioE-" + a);
          $("#iE-hidden-" + i).attr("id", "iE-hidden-" + a);
          $("#iEe-hidden-" + i).attr("id", "iEe-hidden-" + a);
          $("#ihE-weight-" + i).attr("id", "ihE-weight-" + a);
          $("#ihE-precio-" + i).attr("id", "ihE-precio-" + a);
          $("#ihE-precioTotal-" + i).attr("id", "ihE-precioTotal-" + a);
          $("#ihE-anidado-" + i).attr("id", "ihE-anidado-" + a);
          $("#ihE-m3-" + i).attr("id", "ihE-m3-" + a);
          $("#rowE-" + i)
            .attr("id", "rowE-" + a)
            .text(a);
          $(".btnRE-" + i + "")
            .removeClass("btnRE-" + i + "")
            .addClass("btnRE-" + a + "")
            .val(a);
        }
      }
    }
    $("#count").val(lessItem);
  });

  $(document).on("change", "#weightTypeNew", function () {
    var valor = $(this).val();
    if (valor === "1") {
      $("#newWeightMaritime").removeClass("block");
      $("#newWeightMaritime").addClass("none");
      $("#newWeightAir").removeClass("none");
      $("#newWeightAir").addClass("block");
      var country = $("#country2").val();
      searchWeightAir(country);
    } else {
      if (valor === "2") {
        $("#newWeightAir").removeClass("block");
        $("#newWeightAir").addClass("none");
        $("#newWeightMaritime").removeClass("none");
        $("#newWeightMaritime").addClass("block");
        var country = $("#country2").val();
        searchWeightMaritime(country);
      } else {
        $("#newWeightMaritime").removeClass("block");
        $("#newWeightAir").removeClass("block");
        $("#newWeightMaritime").addClass("none");
        $("#newWeightAir").addClass("none");
      }
    }
  });

  $(document).on("change", "#country2", function () {
    $("#weightTypeNew").val(0);
    $("#newWeightAir").removeClass("block");
    $("#newWeightAir").addClass("none");
    $("#newWeightMaritime").removeClass("block");
    $("#newWeightMaritime").addClass("none");
  });

  $(document).on("change", "#countryEdit", function () {
    $("#weightTypeEdit").val(0);
    $("#weightMaritimeEditRate").val(0);
    $("#editWeightAir").removeClass("block");
    $("#editWeightAir").addClass("none");
    $("#editWeightMaritime").removeClass("block");
    $("#editWeightMaritime").addClass("none");
    $("#i-airPriceEdit").val("");
    $("#i-maritimePriceEdit").val("");
  });

  $(document).on("change", "#weightAirEditRate", function () {
    var valor = $(this).val();
    var valor2 = $("#countryEdit").val();
    if (valor2 == "0") {
      alert(
        "You need to select the country in which you want to change the rate."
      );
      $("#weightAirEditRate").val(0);
    } else {
      if (valor == "0") {
        alert("You must select the weight of the rate you want to change.");
        $("#weightAirEditRate").val(0);
        $("#i-airPriceEdit").val("");
      } else {
        searchPriceWeightAir(valor, valor2);
      }
    }
  });

  $(document).on("change", "#weightMaritimeEditRate", function () {
    var valor = $(this).val();
    var valor2 = $("#countryEdit").val();
    if (valor2 == "0") {
      alert(
        "You need to select the country in which you want to change the rate."
      );
      $("#weightAirEditRate").val(0);
    } else {
      if (valor == "0") {
        alert("You must select the weight of the rate you want to change.");
        $("#weightAirEditRate").val(0);
        $("#i-airPriceEdit").val("");
      } else {
        searchPriceWeightMaritime(valor, valor2);
      }
    }
  });

  $(document).on("click", "#btnSavedNewRate", function () {
    if ($("#newRate-content").hasClass("block")) {
      if ($("#newWeightAir").hasClass("block")) {
        var country = $("#country2").val();
        var weight = $("#weightAirNewRate").val();
        var price = $("#i-airPrice").val();

        registerRateAir(country, weight, price);
        searchCountryRates();
      } else {
        if ($("#newWeightMaritime").hasClass("block")) {
          var country = $("#country2").val();
          var weight = $("#weightMaritimeNewRate").val();
          var price = $("#i-maritimePrice").val();

          registerRateMaritime(country, weight, price);
          searchCountryRates();
        }
      }
    } else {
      if ($("#modifyRate-content").hasClass("block")) {
        if ($("#editWeightAir").hasClass("block")) {
          var country = $("#countryEdit").val();
          var weight = $("#weightAirEditRate").val();
          var price = $("#i-airPriceEdit").val();

          updateRateAir(country, weight, price);
          searchCountryRates();
        } else {
          if ($("#editWeightMaritime").hasClass("block")) {
            var country = $("#countryEdit").val();
            var weight = $("#weightMaritimeEditRate").val();
            var price = $("#i-maritimePriceEdit").val();

            updateRateMaritime(country, weight, price);
            searchCountryRates();
          }
        }
      }
    }
  });

  $(document).on("click", "#btn-add-product", function () {
    var valor = $("#txt-modelo").val();
    searchProducts2(valor);

    $("#c-product").removeClass("none");
  });

  $(document).on("keyup", "#txt-modelo", function (e) {
    var valor = $(this).val();
    if (e.keyCode == 8) {
      $("#c-product").addClass("none");
    }
  });

  $(document).on("click", "#btnSavedProduct", function () {
    var model = $("#txt-modelo").val();
    var name = $("#txt-name-product").val();
    var price = $("#txt-price-product").val();
    var netWeight = $("#txt-netWeight").val();
    var grossWeight = $("#txt-grossWeight").val();
    var long = $("#txt-long").val();
    var width = $("#txt-width").val();
    var height = $("#txt-height").val();
    var long1 = $("#txt-long1").val();
    var width1 = $("#txt-width1").val();
    var height1 = $("#txt-height1").val();

    registerProduct(
      model,
      name,
      price,
      netWeight,
      grossWeight,
      long,
      width,
      height,
      long1,
      width1,
      height1
    );
  });

  $(document).on("click", ".p-close", function () {
    $("#txt-modelo").val("");
    $("#txt-name-product").val("");
    $("#txt-price-product").val("");
    $("#txt-netWeight").val("");
    $("#txt-grossWeight").val("");
    $("#txt-long").val("");
    $("#txt-width").val("");
    $("#txt-height").val("");
    $("#txt-long1").val("");
    $("#txt-width1").val("");
    $("#txt-height1").val("");
    $("#c-product").addClass("none");
  });

  function searchProductsTable(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchProductTable.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#pc").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("keyup", "#i-searchProducts", function (e) {
    var valor = $(this).val();

    searchProductsTable(valor);
  });

  $(document).on("change", "#envioM", function () {
    var valor = $(this).val();
    var envio = $("#envio").val();
    var destination = $("#country").val();
    var count = $("#count").val();
    var incoterm = $("#incoterm").val();
    var weight = $("#ih-chWeight").val();
    var coin = $("#divisa").val();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert(
          "Do you need to specify the type of shipment, either air or sea?"
        );
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#i-hidden-" + i).val(),
            cant: $("#cant-" + i).text(),
            weight: $("#ih-weight-" + i).val(),
            wm3: $("#ih-m3-" + i).val(),
          });
        }
        changeOptions(
          weight,
          destination,
          valorActual,
          incoterm,
          datas,
          coin,
          m3
        );
      }
    }
  });

  $(document).on("change", "#envioME", function () {
    var valor = $(this).val();
    var envio = $("#envioE").val();
    var country = $("#countryE").val();
    var count = $("#count").val();
    var incoterm = $("#incotermE").val();
    var weight = $("#ih-chWeight").val();
    var coin = $("#divisaE").val();
    $("#zipcodeE").val("");
    $("#zipcodeE").focus();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("You need to specify the destination country.");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#iEe-hidden-" + i).val(),
            cant: $("#cantE-" + i).text(),
            weight: $("#ihE-weight-" + i).val(),
            wm3: $("#ihE-m3-" + i).val(),
          });
        }
        changeOptionsE(weight, country, valorActual, incoterm, datas, coin, m3);
      }
    }
  });

  $(document).on("change", "#country", function () {
    var valor = $(this).val();
    var envio = $("#envio").val();
    var envioM = $("#envioM").val();
    var count = $("#count").val();
    var incoterm = $("#incoterm").val();
    var weight = $("#ih-chWeight").val();
    var coin = $("#divisa").val();
    $("#zipcode").val("");
    $("#zipcode").focus();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("You need to specify the destination country.");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#i-hidden-" + i).val(),
            cant: $("#cant-" + i).text(),
            weight: $("#ih-weight-" + i).val(),
            wm3: $("#ih-m3-" + i).val(),
          });
        }
        changeOptions(weight, valorActual, envioM, incoterm, datas, coin, m3);
      }
    }
  });

  $(document).on("change", "#countryE", function () {
    var valor = $(this).val();
    var envio = $("#envioE").val();
    var envioM = $("#envioME").val();
    var count = $("#count").val();
    var incoterm = $("#incotermE").val();
    var weight = $("#ih-chWeight").val();
    var coin = $("#divisaE").val();
    $("#zipcodeE").val("");
    $("#zipcodeE").focus();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("You need to specify the destination country.");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#iEe-hidden-" + i).val(),
            cant: $("#cantE-" + i).text(),
            weight: $("#ihE-weight-" + i).val(),
            wm3: $("#ihE-m3-" + i).val(),
          });
        }
        changeOptionsE(weight, valorActual, envioM, incoterm, datas, coin, m3);
      }
    }
  });

  $(document).on("change", "#incoterm", function () {
    var valor = $(this).val();
    var envio = $("#envio").val();
    var envioM = $("#envioM").val();
    var count = $("#count").val();
    var country = $("#country").val();
    var weight = $("#ih-chWeight").val();
    var coin = $("#divisa").val();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("You need to specify the incoterm.");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#i-hidden-" + i).val(),
            cant: $("#cant-" + i).text(),
            weight: $("#ih-weight-" + i).val(),
            wm3: $("#ih-m3-" + i).val(),
          });
        }
        changeOptions(weight, country, envioM, valorActual, datas, coin, m3);
      }
    }
  });

  $(document).on("change", "#incotermE", function () {
    var valor = $(this).val();
    var envio = $("#envioE").val();
    var envioM = $("#envioME").val();
    var count = $("#count").val();
    var country = $("#countryE").val();
    var weight = $("#ih-chWeight").val();
    var coin = $("#divisaE").val();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("You need to specify the incoterm.");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#iEe-hidden-" + i).val(),
            cant: $("#cantE-" + i).text(),
            weight: $("#ihE-weight-" + i).val(),
            wm3: $("#ihE-m3-" + i).val(),
          });
        }
        changeOptionsE(weight, country, envioM, valorActual, datas, coin, m3);
      }
    }
  });

  $(document).on("change", "#divisa", function () {
    var valor = $(this).val();
    var envio = $("#envio").val();
    var envioM = $("#envioM").val();
    var count = $("#count").val();
    var country = $("#country").val();
    var weight = $("#ih-chWeight").val();
    var incoterm = $("#incoterm").val();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("Need to enter payment currency, EUR or USD?");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#i-hidden-" + i).val(),
            cant: $("#cant-" + i).text(),
            weight: $("#ih-weight-" + i).val(),
            wm3: $("#ih-m3-" + i).val(),
          });
        }
        changeOptions(
          weight,
          country,
          envioM,
          incoterm,
          datas,
          valorActual,
          m3
        );
      }
    }
  });

  $(document).on("change", "#divisaE", function () {
    var valor = $(this).val();
    var envio = $("#envioE").val();
    var envioM = $("#envioME").val();
    var count = $("#count").val();
    var country = $("#countryE").val();
    var weight = $("#ih-chWeight").val();
    var incoterm = $("#incotermE").val();
    var m3 = $("#ih-weight3").val();
    if (envio === "0.00") {
    } else {
      if (valor == 0) {
        alert("Need to enter payment currency, EUR or USD?");
        $("#envioM").focus();
      } else {
        var valorActual = $(this).val();
        var count = parseInt($("#count").val()) + parseInt(1);
        let datas = [];

        for (let i = 1; i < count; i++) {
          datas.push({
            model: $("#iEe-hidden-" + i).val(),
            cant: $("#cantE-" + i).text(),
            weight: $("#ihE-weight-" + i).val(),
            wm3: $("#ihE-m3-" + i).val(),
          });
        }
        changeOptionsE(
          weight,
          country,
          envioM,
          incoterm,
          datas,
          valorActual,
          m3
        );
      }
    }
  });

  $(document).on("click", "#editProduct", function () {
    var valor = $(this).val();

    editProduct(valor);
  });

  $(document).on("change", "#lineP", function () {
    var valor = $(this).val();
    if (valor === "Other") {
      $(this).addClass("none");
      $("#txt-other-line").removeClass("none");
      $("#txt-other-line").focus();
    }
  });

  $(document).on("change", "#categoryP", function () {
    var valor = $(this).val();
    if (valor === "Other") {
      $(this).addClass("none");
      $("#txt-other-category").removeClass("none");
      $("#txt-other-category").focus();
    }
  });

  $(document).on("change", "#subcategoryP", function () {
    var valor = $(this).val();
    if (valor === "Other") {
      $(this).addClass("none");
      $("#txt-other-subcategory").removeClass("none");
      $("#txt-other-subcategory").focus();
    }
  });

  $(document).on("keyup", "#textAreaProduct", function (e) {
    var valor = $(this).val();
    $("#view-1").html(valor);
  });
  $(document).on("keypress", "#textAreaProduct", function (e) {
    if (e.keyCode == 13) {
      $(this).val($(this).val() + "<br>");
    }
  });

  $(document).on("click", ".b-1", function () {
    $("#textAreaProduct").select(boldText());
  });

  $(document).on("click", ".i-1", function () {
    $("#textAreaProduct").select(italicText());
  });

  $(document).on("click", ".z-1", function () {
    $("#textAreaProduct").focus();
  });

  $(document).on("click", ".y-1", function () {
    $("#textAreaProduct").trigger(jQuery.Event("keypress", { keycode: 13 }));
  });

  function boldText() {
    const textSelect = document.getSelection();
    if (textSelect == "") {
      var valor = $("#textAreaProduct").val();
      $("#textAreaProduct").val(valor + "<b>bold text here!</b>");
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    } else {
      var valor = $("#textAreaProduct").val();
      valor = valor.replace(textSelect, "<b>" + textSelect + "</b>");
      $("#textAreaProduct").val(valor);
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    }
  }

  function italicText() {
    const textSelect = document.getSelection();
    if (textSelect == "") {
      var valor = $("#textAreaProduct").val();
      $("#textAreaProduct").val(valor + "<em>italic text here!</em>");
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    } else {
      var valor = $("#textAreaProduct").val();
      valor = valor.replace(textSelect, "<em>" + textSelect + "</em>");
      $("#textAreaProduct").val(valor);
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    }
  }

  function ol() {
    const textSelect = document.getSelection();
    if (textSelect == "") {
      var valor = $("#textAreaProduct").val();
      $("#textAreaProduct").val(valor + "<em>italic text here!</em>");
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    } else {
      var valor = $("#textAreaProduct").val();
      valor = valor.replace(textSelect, "<em>" + textSelect + "</em>");
      $("#textAreaProduct").val(valor);
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    }
  }

  function li() {
    const textSelect = document.getSelection();
    if (textSelect == "") {
      var valor = $("#textAreaProduct").val();
      $("#textAreaProduct").val(valor + "<em>italic text here!</em>");
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    } else {
      var valor = $("#textAreaProduct").val();
      valor = valor.replace(textSelect, "<em>" + textSelect + "</em>");
      $("#textAreaProduct").val(valor);
      $("#view-1").html($("#textAreaProduct").val());
      $("#textAreaProduct").focus();
    }
  }

  $(document).on("click", "#saveUpdateRate", function () {
    var porcentaje = $("#i-rateU").val();
    var porcentajeM = $("#i-rateUM").val();
    updateRates(porcentaje, porcentajeM);
    $("#ur-cancel").click();
  });

  function updateRates(porcentaje, porcentajeM) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateRates.php",
      type: "POST",
      data: { porcentaje, porcentajeM },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          alert("Actualización correcta");
          searchRates();
          $("#i-rateU").val("");
          $("#i-rateUM").val("");
        } else {
          alert("No se pudo actualizar");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchCategorie(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchCategorie.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#categorieProduct").html(respuesta);
        $("#categorieProduct2").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("change", "#tIncrease", function () {
    let valor = $(this).val();
    if (valor == 1) {
      $(".cPercentage").removeClass("none");
      $(".cRate").addClass("none");
      $("#txt-rate").val("");
      $("#categorieProduct2").val(0);
      $("#filterPrice").val(0);
    } else {
      if (valor == 2) {
        $(".cRate").removeClass("none");
        $(".cPercentage").addClass("none");
        $("#txt-percentage").val("");
        $("#categorieProduct").val(0);
      } else {
        $(".cRate").addClass("none");
        $(".cPercentage").addClass("none");
        $("#txt-rate").val("");
        $("#txt-percentage").val("");
        $("#categorieProduct").val(0);
        $("#categorieProduct2").val(0);
        $("#filterPrice").val(0);
      }
    }
  });

  $(document).on("click", "#btnCloseUPP", function () {
    $(".cRate").addClass("none");
    $(".cPercentage").addClass("none");
    $("#tIncrease").val(0);
    $("#txt-rate").val("");
    $("#txt-percentage").val("");
    $("#categorieProduct").val(0);
    $("#categorieProduct2").val(0);
    $("#filterPrice").val(0);
  });

  $(document).on("click", "#btnUpdateProductsPrices", function () {
    let ty = $("#tIncrease").val();
    if (ty == 1) {
      let percentage = $("#txt-percentage").val();
      let categorie = $("#categorieProduct").val();
      if (percentage != "") {
        if (categorie != 0) {
          updatePercentage(percentage, categorie);
        } else {
          alert("You must select the category you want to increase");
          $("#categorieProduct").focus();
        }
      } else {
        alert("It is necessary to specify the percentage increase");
        $("#txt-percentage").focus();
      }
    } else {
      if (ty == 2) {
        let rate = $("#txt-rate").val();
        let categorie = $("#categorieProduct2").val();
        let filter = $("#filterPrice").val();
        if (rate != "") {
          if (categorie != 0) {
            if (filter != 0) {
              updatePPR(rate, categorie, filter);
            } else {
              alert(
                "You must select the filter for the prices you wish to increase"
              );
              $("#filterPrice").focus();
            }
          } else {
            alert("You must select the category you want to increase");
            $("#categorieProduct2").focus();
          }
        } else {
          alert("It is necessary to specify the rate increase");
          $("#txt-rate").focus();
        }
      } else {
        alert("You must select the type of increment");
        $("#tIncrease").focus();
      }
    }
  });

  function updatePercentage(percentage, categorie) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateProductsPricePercentage.php",
      type: "POST",
      data: { percentage, categorie },
    })
      .done(function (respuesta) {
        let data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          $("#btnCloseUPP").click();
          searchProductsTable();
          alert("Product prices have been updated correctly");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function updatePPR(rate, categorie, filterP) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/updateProductsPriceRate.php",
      type: "POST",
      data: { rate, categorie, filterP },
    })
      .done(function (respuesta) {
        let data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          $("#btnCloseUPP").click();
          searchProductsTable();
          alert("Product prices have been updated correctly");
        }
      })
      .fail(function () {
        console.log("error");
      });
  }
});
