var im_in_shop = true;

jQuery(document).ready(function ($) {
  searchCountryEU();
  searchDepartment();
  searchDataUserDashboard();
  resultPagePagination();

  function searchDataUserDashboard(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchUserLoguer.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        console.log(respuesta);
        let data = JSON.parse(respuesta);
        $("#atc").val(data.name + " " + data.lastname);

        if (data.nameCompany != "") {
          $("#sres").val(data.nameCompany);
        } else {
          $("#sres").val(data.name + " " + data.lastname);
        }

        console.log("PAIS: " + data.destination);

        $("#envioM").val(data.shippingM);
        searchCountry(data.shippingM, data.destination);
        $("#zipcode").val(data.zipcode);

        if (data.warehouse == "EXW Kalstein Shanghai") {
          $("#r01").attr("checked", "checked");
          $("#r01").change();
          $("#r01").click();
        } else if (data.warehouse == "EXW Kalstein Paris") {
          $("#r02").attr("checked", "checked");
          $("#r02").change();
          $("#r02").click();
        }
        $("#withdrawalMethod").val("1");
        $("#withdrawalMethod").change();

        $("#divisa").val(data.currency);
        $("#pago").val(data.paymentM);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchIdUser(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchUserLoguer.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        console.log(respuesta);
        let data = JSON.parse(respuesta);
        $("#IDacc, iva").val(data.emailAcc);
      })
      .fail(function () {
        console.log("error");
      });
  }

  consultRolAccount();

  function consultRolAccount() {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/consultTypeAccount.php", // URL correcta
      type: "POST", // Método HTTP adecuado
      dataType: "json",
    })
      .done(function (respuesta) {
        // 'datos' ya es un objeto JSON
        $("#ih-percentageDiscount").val(respuesta.percentage);
        if (respuesta.percentage == 0.02) {
          $("#txtDiscount").attr("data-i18n", "client:discount2");
        } else {
          $("#txtDiscount").attr("data-i18n", "client:discount4");
        }
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log("error", textStatus, errorThrown);
      });
  }

  const cookieLng = document.cookie
    .split("; ")
    .find((row) => row.startsWith("language="))
    .split("=")[1];
  let alertsTranslations = {};

  // cargar json de traducciones 1
  const loadTranslations = (lng) => {
    return fetch(
      `https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/client.json`
    )
      .then((response) => response.json())
      .then((translation) => {
        // save in a global variable
        alertsTranslations = translation;
      });
  };

  loadTranslations(cookieLng);

  var resultCotDiv = `
    <button class="showQUO">QUO <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger nPC">0</span></button>
    <div class='asideCotizacion mobile-quote-hidden'>
        <div class='mainAsideClose d-flex flex-row justify-content-between'>
            <span class='txtTitleQuote' data-i18n='client:quote2'></span>
            <div class='btnCloseQuote me-4' style='cursor: pointer'><b>X</b></div>
        </div>
        <div class='cadd-products'>
            <div class='cshipping pt-1 pb-1'>
                <div class='shipping'>
                    <span data-i18n='client:shipping'></span><button class='zipcode d-inline'></button> - <button class='country d-inline'></button>
                </div>
                <div class='method'>
                    <span data-i18n='client:metodo'>: <button class='mshipping d-inline'></button></span>
                </div>
                <div class='incoterm'>
                    <span>Incoterm: <button class='warehouse d-inline'></button></span>
                </div>
                <div class='paymentM'>
                    <span data-i18n='client:paymentMethod'>: <button class='mPayment d-inline'></button> - <button class='currency d-inline'></button></span>
                </div>
            </div>
            <div class='cListProduct'>
                <input type='hidden' id='user' />
                <input type='hidden' id='company' />
                <input type='hidden' id='rb' /><input type='hidden' id='IDacc' />
                <input type='hidden' id='emailMaker' />
                <input type='hidden' id='withdrawalM' />
                <input type='hidden' id='deliveryTime' />
                <input type='hidden' id='rb2' />
                <input type='hidden' id='discountPercentage'/>
            </div>
        </div>
        <div class='ccal-prices'>
            <div class='maincsubtotal1 d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span data-i18n='client:subtotal'> </span>
                </div>
                <div class='cinput'>
                    <input type='text' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' class='i-subtotal1' id='subtotal' value='0.00' readonly disabled/>
                </div>
            </div>
            <div class='maincdiscount d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span data-i18n='client:discount'>: </span>
                </div>
                <div class='cinput'>
                    <input type='text'id='desc' class='i-discount' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' value='0.00' readonly disabled/>
                </div>
            </div>
            <div class='maincsubtotal2 d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span data-i18n='client:subtotal'> </span>
                </div>
                <div class='cinput' value='0.00'>
                    <input type='text' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' id='subtotal2' class='i-subtotal2' value='0.00' readonly disabled/>
                    <input type='hidden' id='ih-iva' value='0.00'/>
                </div>
            </div>
            <div class='mainctotal d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span id='txtDiscount'></span>
                </div>
                <div class='cinput'>
                    <input type='text' id='totalWithDiscount' class='i-total' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' value='0.00' readonly disabled/>
                </div>
            </div>
            <div class='maincshipping d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span data-i18n='client:shipping'>: </span>
                </div>
                <div class='cinput'>
                    <input type='text' class='i-shipping' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' id='envio' value='0.00' readonly disabled/>
                </div>
            </div>
            <div class='maincaduana d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span data-i18n='client:arancel'>: </span>
                </div>
                <div class='cinput'>
                    <input type='text' class='i-customs' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' id='customs' value='0.00' readonly disabled/>
                </div>
            </div>
            <div class='mainctotal d-flex p-1 ms-1'>
                <div class='cspan'>
                    <span data-i18n='client:total'>: </span>
                </div>
                <div class='cinput'>
                    <input type='text' id='total' class='i-total' style='border: none; background: none; outline: none; color: #fff; font-weight: bold;' value='0.00' readonly disabled/>
                </div>
            </div>
        </div>
        <div class='cbtns'>
            <button class='btn-clean' data-i18n='client:cancelar'></button>
            <button class='btn-generate' data-i18n='client:generar'></button>
        </div>
    </div>
`;

  function showAsideCotizacion() {
    if ($(".warehouse").val() == "" || $(".warehouse").val() == undefined) {
      $("#resultCot").html(resultCotDiv);
    }
  }

  showAsideCotizacion();

  var searchTags = $(".searchTags").text();
  $("#i-search").focus();

  $(document).on("click", "#form-check-input", function () {
    if ($(this).hasClass("checked-chk")) {
      $(this).removeClass("checked-chk");
    } else {
      $(this).addClass("checked-chk");
    }
  });

  $(document).on("click", ".btnQuo", function () {
    var country = $(".warehouse").val();
    var modelo = $(this).val();
    console.log(modelo);
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/verificadorUsuario.php",
      type: "POST",
      dataType: "json",
      data: { modelo },
    })
      .done(function (data) {
        if (data.respuesta == "incorrecto") {
          var path = $(location).attr("pathname");
          let metodoEnvioSession = $("#envioM").val();

          if (country == "") {
            $(".activeModal").click();
            var cant = $("#i-cant-woo-" + modelo).length
              ? $("#i-cant-woo-" + modelo).val()
              : $("#i-cant-" + modelo).val();
            $("#ih-model").val(modelo);
            $("#ih-cant").val(cant);
          } else {
            let sres = $("#company").val();
            let atc = $("#user").val();
            var cant = $("#i-cant-woo-" + modelo).length
              ? $("#i-cant-woo-" + modelo).val()
              : $("#i-cant-" + modelo).val();
            let zipcode = $(".zipcode").val();
            let destination = $(".country").val();
            let mEnvio = $(".mshipping").val();
            let incoterm = $(".warehouse").val();
            let payment = $(".mPayment").val();
            let coin = $(".currency").val();
            let chWeight = $("#ih-chWeight").val();
            let w3 = $("#ih-weight3").val();
            let rb = $("#rb").val();
            let rb2 = $("#rb2").val();
            let deliveryTime = $("#deliveryTimes").val();
            let withdrawalM = $("#withdrawalMethod").val();
            let discount = $("#discountCode").val();

            let countAccesories = $("#ih-accesories-add").val();
            let arrayAccesories = [];
            let checks = document.querySelectorAll(".checked-chk");
            console.log(checks);

            for (let elem of checks) {
              let modelAccesorie = elem.value;
              arrayAccesories.push({
                modelAccesorie: modelAccesorie,
              });
              elem.click();
            }

            addProduct2(
              modelo,
              cant,
              mEnvio,
              destination,
              zipcode,
              incoterm,
              chWeight,
              coin,
              payment,
              w3,
              rb,
              sres,
              atc,
              withdrawalM,
              deliveryTime,
              rb2,
              arrayAccesories,
              discount
            );
          }
        } else {
          iziToast.warning({
            title: "Información",
            message: "No puedes cotizar tus mismos productos",
            position: "topCenter",
          });
        }
      })
      .fail(function () {
        console.log("error");
        alert("error");
      });
  });

  $(document).on("click", ".btnRemoveP", function () {
    var valor = $(this).val();
    let warehouse = $(".warehouse").val();

    if (warehouse === "EXW Kalstein Shanghai") {
      var weight = $("#ih-weight-" + valor + "").val();
      var m3 = $("#ih-m3-" + valor + "").val();
      var destination = $(".country").val();
      var envioM = $(".mshipping").val();
      var chWeight = $("#ih-chWeight").val();
      var wm3 = $("#ih-weight3").val();
      var newM3 = parseFloat(wm3) - parseFloat(m3);
      $("#ih-weight3").val(newM3.toFixed(3));
      var newWM3 = $("#ih-weight3").val();
      var newWeight = parseFloat(chWeight) - parseFloat(weight);
      $("#ih-chWeight").val(newWeight.toFixed(2));
      var newCH = $("#ih-chWeight").val();
      var percentajeArancel = $("#ih-arancel-" + valor).val();
      var totalPrecio = $("#ih-total-" + valor + "").val();
      var arancelCalculated =
        parseFloat(totalPrecio) * parseFloat(percentajeArancel);
      var arancelCalculated2 = arancelCalculated.toFixed(2);
      var subtotal = $("#subtotal").val();
      var arancel = $("#customs").val();
      var restar = parseFloat(subtotal) - parseFloat(totalPrecio);
      var restar2 = parseFloat(arancel) - parseFloat(arancelCalculated2);
      $("#subtotal").val(restar.toFixed(2));
      $("#customs").val(restar2.toFixed(2));
      removeProducto(newCH, destination, envioM, newWM3, warehouse);
      removeArrayProduct(valor);
      $("#item-" + valor + "").remove();
    } else {
      var weight = $("#ih-weight-" + valor + "").val();
      var m3 = $("#ih-m3-" + valor + "").val();
      var destination = $(".country").val();
      var envioM = $(".mshipping").val();
      var chWeight = $("#ih-chWeight").val();
      var wm3 = $("#ih-weight3").val();
      var newM3 = parseFloat(wm3) - parseFloat(m3);
      $("#ih-weight3").val(newM3.toFixed(3));
      var newWM3 = $("#ih-weight3").val();
      var newWeight = parseFloat(chWeight) - parseFloat(weight);
      $("#ih-chWeight").val(newWeight.toFixed(2));
      var newCH = $("#ih-chWeight").val();
      var totalPrecio = $("#ih-total-" + valor + "").val();
      var subtotal = $("#subtotal").val();
      var restar = parseFloat(subtotal) - parseFloat(totalPrecio);
      $("#subtotal").val(restar.toFixed(2));
      $("#customs").val("0.00");
      removeProducto(newCH, destination, envioM, newWM3, warehouse);
      removeArrayProduct(valor);
      $("#item-" + valor + "").remove();
    }

    var count = parseInt($("#count").val()) + parseInt(1);
    var lessItem = parseInt($("#count").val()) - parseInt(1);

    for (let i = 1; i < count; i++) {
      var item = $("#item-" + i).attr("id");
      if (item === "item-1") {
        var a = 1;
        $("#item-" + i).attr("id", "item-" + a);
        $("#ih-name-" + i).attr("id", "ih-name-" + a);
        $("#ih-cant-" + i).attr("id", "ih-cant-" + a);
        $("#ih-price-" + i).attr("id", "ih-price-" + a);
        $("#ih-total-" + i).attr("id", "ih-total-" + a);
        $("#ih-model-" + i).attr("id", "ih-model-" + a);
        $("#ih-image-" + i).attr("id", "ih-image-" + a);
        $("#ih-maker-" + i).attr("id", "ih-maker-" + a);
        $("#ih-anidado-" + i).attr("id", "ih-anidado-" + a);
        $("#ih-weight-" + i).attr("id", "ih-weight-" + a);
        $("#ih-arancel-" + i).attr("id", "ih-arancel-" + a);
        $("#ih-m3-" + i).attr("id", "ih-m3-" + a);
        $("#ih-modelAccesorie-add-" + i).attr(
          "id",
          "ih-modelAccesorie-add-" + a
        );
        $(".btnR-" + i + "")
          .removeClass(i)
          .addClass(a)
          .val(a);
      } else {
        if (item === "item-2" && $("#item-1").length > 0) {
          var a = 2;
          $("#item-" + i).attr("id", "item-" + a);
          $("#ih-name-" + i).attr("id", "ih-name-" + a);
          $("#ih-cant-" + i).attr("id", "ih-cant-" + a);
          $("#ih-price-" + i).attr("id", "ih-price-" + a);
          $("#ih-total-" + i).attr("id", "ih-total-" + a);
          $("#ih-model-" + i).attr("id", "ih-model-" + a);
          $("#ih-image-" + i).attr("id", "ih-image-" + a);
          $("#ih-maker-" + i).attr("id", "ih-maker-" + a);
          $("#ih-anidado-" + i).attr("id", "ih-anidado-" + a);
          $("#ih-weight-" + i).attr("id", "ih-weight-" + a);
          $("#ih-arancel-" + i).attr("id", "ih-arancel-" + a);
          $("#ih-m3-" + i).attr("id", "ih-m3-" + a);
          $("#ih-modelAccesorie-add-" + i).attr(
            "id",
            "ih-modelAccesorie-add-" + a
          );
          $(".btnR-" + i + "")
            .removeClass(i)
            .addClass(a)
            .val(a);
        } else {
          var a = parseInt(i) - parseInt(1);
          $("#item-" + i).attr("id", "item-" + a);
          $("#ih-name-" + i).attr("id", "ih-name-" + a);
          $("#ih-cant-" + i).attr("id", "ih-cant-" + a);
          $("#ih-price-" + i).attr("id", "ih-price-" + a);
          $("#ih-total-" + i).attr("id", "ih-total-" + a);
          $("#ih-model-" + i).attr("id", "ih-model-" + a);
          $("#ih-image-" + i).attr("id", "ih-image-" + a);
          $("#ih-maker-" + i).attr("id", "ih-maker-" + a);
          $("#ih-anidado-" + i).attr("id", "ih-anidado-" + a);
          $("#ih-weight-" + i).attr("id", "ih-weight-" + a);
          $("#ih-arancel-" + i).attr("id", "ih-arancel-" + a);
          $("#ih-m3-" + i).attr("id", "ih-m3-" + a);
          $("#ih-modelAccesorie-add-" + i).attr(
            "id",
            "ih-modelAccesorie-add-" + a
          );
          $(".btnR-" + i + "")
            .removeClass("btnR-" + i + "")
            .addClass("btnR-" + a + "")
            .val(a);
        }
      }
    }
    $("#count").val(lessItem);
  });

  $(document).on("click", ".btn-generate", function () {
    let country = $(".warehouse").val();
    let total = parseFloat($("#total").val());
    if (country != "" && !isNaN(total) && total != 0) {
      let user = $("#user").val();
      let company = $("#company").val();
      let subtotal = $("#subtotal").val();
      let desc = $("#desc").val();
      let subtotal2 = $("#subtotal2").val();
      let descOnline = $("#totalWithDiscount").val();
      let envio = $("#envio").val();
      let iva = $("#ih-iva").val();
      let arancel = $("#customs").val();
      let total = $("#total").val();
      let count = $("#count").val();
      let mEnvio = $(".mshipping").val();
      let destino = $(".country").val();
      let zipcode = $(".zipcode").val();
      let incoterm = $(".warehouse").val();
      let divisa = $("#divisa").val();
      console.log(divisa);
      let pago = $(".mPayment").val();
      let IDacc = $("#IDacc").val();
      let nItem = parseInt(count) + parseInt(1);
      let maker = $("#emailMaker").val();
      let url = $(location).attr("host") + "" + $(location).attr("pathname");
      let newUrl = url.replace("wp-admin/admin.php", "");
      let datas = [];

      for (let i = 1; i < nItem; i++) {
        let model = $("#ih-model-" + i + "").val();
        let image = $("#ih-image-" + i + "").val();
        let maker = $("#ih-maker-" + i + "").val();
        let name = $("#ih-name-" + i + "").val();
        let cant = $("#ih-cant-" + i + "").val();
        let precio = $("#ih-price-" + i + "").val();
        let anidado = $("#ih-anidado-" + i + "").val();
        let arancel = $("#ih-arancel-" + i + "").val();

        let accesories = document.querySelectorAll(
          "#ih-modelAccesorie-add-" + i + ""
        );

        let arrayAccesories = [];
        for (let elem of accesories) {
          arrayAccesories.push({
            modelAccesorie: elem.value,
          });
        }

        let totalprecio = $("#ih-total-" + i + "").val();

        datas.push({
          model: model,
          image: image,
          maker: maker,
          name: name,
          cant: cant,
          precio: precio,
          anidado: anidado,
          arancel: arancel,
          totalprecio: totalprecio,
          arrayAccesories: arrayAccesories,
        });
      }
      //
      if (mEnvio === "Maritime") {
        var m3 = $("#ih-weight3").val();
        if (m3 < 0.3) {
          alert(
            "El metro cúbico de sus productos a cotizar es " +
              m3 +
              " y necesita al menos 0,300cbm para el envío. Prueba el envío aéreo o añade más productos."
          );
        } else {
          let divisa = $("#divisa").val();
          console.log(divisa);
          savedCotizacion(
            company,
            user,
            subtotal,
            desc,
            subtotal2,
            descOnline,
            envio,
            arancel,
            total,
            datas,
            incoterm,
            divisa,
            pago,
            newUrl,
            mEnvio,
            destino,
            zipcode,
            IDacc,
            iva,
            maker
          );
        }
      } else {
        let divisa = $("#divisa").val();
        console.log(divisa);
        savedCotizacion(
          company,
          user,
          subtotal,
          desc,
          subtotal2,
          descOnline,
          envio,
          arancel,
          total,
          datas,
          incoterm,
          divisa,
          pago,
          newUrl,
          mEnvio,
          destino,
          zipcode,
          IDacc,
          iva,
          maker
        );
      }
    }
  });

  $(document).on("click", "#btnSavedInfoQuote", function () {
    let product = $("#ih-model").val();
    let cant = $("#ih-cant").val();
    let mEnvio = $("#envioM").val();
    let destination = $("#country").val();
    let zipcode = $("#zipcode").val();
    let payment = $("#pago").val();
    let divisa = $("#divisa").val();
    let chWeight = $("#ih-chWeight").val();
    let w3 = $("#ih-weight3").val();
    let coin = $("#divisa").val();
    let sres = $("#sres").val();
    var path = $(location).attr("pathname");
    let atc = $("#atc").val();
    let discountCode = $("#discountCode").val();
    let rb = 0;

    let countAccesories = $("#ih-accesories-add").val();
    let arrayAccesories = [];
    let checks = document.querySelectorAll(".checked-chk");

    for (let elem of checks) {
      let modelAccesorie = elem.value;
      arrayAccesories.push({
        modelAccesorie: modelAccesorie,
      });
      elem.click();
    }
    if ($("#r02").attr("checked")) {
      var incoterm = "EXW Kalstein Paris";
      let deliveryTime = $("#deliveryTimes").val();
      let withdrawalM = "";
      rb = 1;

      if (deliveryTime == 0) {
        alert("Seleccione un plazo de entrega");
        $("#deliveryTimes").focus();
      } else {
        if ($("#r03").attr("checked")) {
          var rb2 = 3;
          destination = "FR";
          addProduct(
            product,
            cant,
            mEnvio,
            destination,
            zipcode,
            incoterm,
            divisa,
            chWeight,
            coin,
            payment,
            w3,
            rb,
            sres,
            atc,
            withdrawalM,
            deliveryTime,
            rb2,
            arrayAccesories,
            discountCode
          );
          $("#user").val(user);
          $("#company").val(company);
        } else {
          if ($("#r04").attr("checked")) {
            destination = $("#countryEU").val();
            var rb2 = 4;
            if ($("#countryEU").val() == 0) {
              alert("Seleccione un país");
              $("#countryEU").focus();
            } else {
              addProduct(
                product,
                cant,
                mEnvio,
                destination,
                zipcode,
                incoterm,
                divisa,
                chWeight,
                coin,
                payment,
                w3,
                rb,
                sres,
                atc,
                withdrawalM,
                deliveryTime,
                rb2,
                arrayAccesories,
                discountCode
              );
              $("#user").val(user);
              $("#company").val(company);
            }
          } else {
            alert(
              "Seleccione si se encuentra en Francia o en otro país de la UE."
            );
          }
        }
      }
    } else {
      rb = rb;
      var rb2 = 0;
      var incoterm = "EXW Kalstein Shanghai";
      let withdrawalM = $("#withdrawalMethod").val();
      let deliveryTime = "";

      if (withdrawalM == 0) {
        alert("El método de retiro es obligatorio.");
        $("#withdrawalMethod").focus();
      } else {
        if (withdrawalM == 1) {
          if (mEnvio == 0) {
            alert("Se requiere método de envío.");
            $("#envioM").focus();
          } else {
            if (destination == 0) {
              alert("El destino es obligatorio.");
              $("#country").focus();
            } else {
              if (zipcode == "") {
                alert("Código postal obligatorio.");
                $("#zipcode").focus();
              } else {
                if (coin == 0) {
                  alert("Se requiere divisa.");
                  $("#divisa").focus();
                } else {
                  if (payment == 0) {
                    alert("Se requiere forma de pago.");
                    $("#payment").focus();
                  } else {
                    addProduct(
                      product,
                      cant,
                      mEnvio,
                      destination,
                      zipcode,
                      incoterm,
                      divisa,
                      chWeight,
                      coin,
                      payment,
                      w3,
                      rb,
                      sres,
                      atc,
                      withdrawalM,
                      deliveryTime,
                      rb2,
                      arrayAccesories,
                      discountCode
                    );
                    $("#user").val(user);
                    $("#company").val(company);
                  }
                }
              }
            }
          }
        } else {
          if (coin == 0) {
            alert("Se necesita moneda.");
            $("#divisa").focus();
          } else {
            if (payment == 0) {
              alert("Se requiere forma de pago.");
              $("#payment").focus();
            } else {
              addProduct(
                product,
                cant,
                mEnvio,
                destination,
                zipcode,
                incoterm,
                divisa,
                chWeight,
                coin,
                payment,
                w3,
                rb,
                sres,
                atc,
                withdrawalM,
                deliveryTime,
                rb2,
                arrayAccesories
              );
              $("#user").val(user);
              $("#company").val(company);
            }
          }
        }
      }
    }
  });

  $(document).on("click", ".btn-clean", function () {
    $("#resultCot").html(resultCotDiv);
    consultRolAccount();
    $("#count").val(0);
    $("#ih-chWeight").val(0);
    $("#ih-weight3").val(0);
  });

  $(document).on("click", ".btnSaveChangeMPayment", function () {
    var pago = $("#pago2").val();
    $(".mPayment").val(pago);
    $(".mPayment").text(pago);
    $(".btnCancelChangeMPayment").click();
  });

  $(document).on("change", "#country2", function () {
    $("#zipcode2").focus();
    $("#zipcode2").val("");
  });

  $(document).on("click", ".btnCancelChangeCountry", function () {
    $("#country2").val(0);
    $("#zipcode2").val("");
  });

  //EVENTO DE BOTÓN PARA VERIFICAR CÓDIGO.
  $("#checkCodeBtn").on("click", function () {
    let valor = $("#discountCode").val();
    let lengthCharacter = valor.length;

    if (lengthCharacter == 8) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/checkFirtsDiscount.php",
        type: "POST",
        data: { valor },
      })
        .done(function (respuesta) {
          let data = JSON.parse(respuesta);

          if (data.status === "validado") {
            $("#msgCodeStatus01").css({ display: "block" });
            $("#msgCodeStatus02").css({ display: "none" });
          } else {
            $("#msgCodeStatus02").css({ display: "block" });
            $("#msgCodeStatus01").css({ display: "none" });
          }

          if (data.status === "error") {
            $("#msgCodeStatus01").css({ display: "none" });
            $("#msgCodeStatus02").css({ display: "block" });
          }
        })

        .fail(function (error) {
          console.log("error");
        });
    }
  });

  function addProduct(
    model,
    quantity,
    mEnvio,
    destination,
    zipcode,
    incoterm,
    divisa,
    chWeight,
    coin,
    payment,
    m3,
    rb,
    sres,
    atc,
    withdrawalM,
    deliveryTime,
    rb2,
    arrayAccesories,
    discount
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/searchProductsSC.php",
      type: "POST",
      data: {
        model,
        quantity,
        mEnvio,
        destination,
        zipcode,
        incoterm,
        divisa,
        chWeight,
        coin,
        payment,
        m3,
        rb,
        sres,
        atc,
        withdrawalM,
        deliveryTime,
        rb2,
        arrayAccesories,
        discount,
      },
    })
      .done(function (respuesta) {
        searchIdUser();
        console.log(respuesta);
        let percentageHidden = $("#ih-percentageDiscount").val();
        $(".showQUO").addClass("mobile-quote-hidden");
        $(".asideCotizacion").removeClass("mobile-quote-hidden");
        $(".entry-content").css({ width: "70vw", float: "left" });
        var data = JSON.parse(respuesta);
        $("#user").val(data.atc);
        $("#company").val(data.sres);
        $("#rb").val(data.rb);
        $("#rb2").val(data.rb2);
        $("#deliveryTimes").val(data.deliveryTime);
        $("#withdrawalMethod").val(data.withdrawalM);
        $("#emailMaker").val(data.maker);
        $("#discountPercentage").val(data.codeDiscount);
        let arrayAccesories = data.arrayAccesories;
        if (data.rb === "1") {
          if (data.priceIncoterm === "0.00") {
            priceIncoterm = "";
          } else {
            var priceIncoterm = data.priceIncoterm;
            priceIncoterm = "(+" + priceIncoterm + ")";
          }
          var nItem = $("#count").val();
          nItem = parseInt(nItem) + parseInt(1);
          $(".zipcode").val(data.zipcode);
          $(".zipcode").text(data.zipcode);
          $(".country").val(data.iso);
          $(".country").text(data.destination);
          $(".mshipping").val(data.mEnvio);
          $(".mshipping").text(data.mEnvio);
          $(".warehouse").val(data.incoterm);
          $(".warehouse").text(data.incoterm);
          $(".mPayment").val(data.payment);
          $(".mPayment").text(data.payment);
          $(".currency").val(data.coin);
          $(".currency").text(data.coin);
          $(".nPC").text(nItem);

          var precioAnidado =
            parseFloat(data.price) + parseFloat(data.priceIncoterm);
          var pricehscode =
            parseFloat(data.price) * parseFloat(data.hsPorcentage);
          var totalhscode = parseFloat(pricehscode) * parseFloat(data.cant);
          var multi = parseFloat(precioAnidado) * parseFloat(data.cant);
          $("#total").val($("#total").val() - $);
          var total = parseFloat(multi) + parseFloat(totalhscode);
          var subtotal = $("#subtotal").val();
          let name = data.name;
          let newName = name.replace(/'/g, /\'/);
          let nwName = newName.replace(/\//g, "");
          var arregloDiv = "";
          let countAccesoriesAdd = 1;

          if (arrayAccesories === null) {
            mainAccesorie += "";
          } else {
            $.each(arrayAccesories, function (index, elem) {
              arregloDiv +=
                '<div class="row" style="width: 100%; padding-left: 1.5rem;">' +
                elem["modelAccesorie"] +
                '</div><input type="hidden" id="ih-modelAccesorie-add-' +
                nItem +
                '" value="' +
                elem["modelAccesorie"] +
                '"/>';
            });
            mainAccesorie += "<br> Accesorios Añadidos: " + arregloDiv + "<br>";
          }

          $(".cListProduct").append(
            '<div class="item" id="item-' +
              nItem +
              '"><div class="columnImage"><img src="' +
              data.image +
              '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="ih-model-' +
              nItem +
              '" value="' +
              data.model +
              '"/><input type="hidden" id="ih-name-' +
              nItem +
              '" value="' +
              nwName +
              '"/><input type="hidden" id="ih-maker-' +
              nItem +
              '" value="' +
              data.description +
              '"/><input type="hidden" id="ih-image-' +
              nItem +
              '" value="' +
              data.image +
              '"/><input type="hidden" id="ih-cant-' +
              nItem +
              '" value="' +
              data.cant +
              '"/><input type="hidden" id="ih-price-' +
              nItem +
              '" value="' +
              data.price +
              '"/><input type="hidden" id="ih-anidado-' +
              nItem +
              '" value="' +
              data.priceIncoterm +
              '"/><input type="hidden" id="ih-arancel-' +
              nItem +
              '" value="' +
              data.hsPorcentage +
              '"/><input type="hidden" id="ih-total-' +
              nItem +
              '" value="' +
              multi.toFixed(2) +
              '"/><input type="hidden" id="ih-weight-' +
              nItem +
              '" value="' +
              data.weight +
              '"/><input type="hidden" id="ih-m3-' +
              nItem +
              '" value="' +
              data.n3 +
              '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
              data.name +
              '</span><br><span class="quantity" style="font-size: 0.7em;">Cant: ' +
              data.cant +
              "" +
              mainAccesorie +
              ' Precio: $<span class="spPrices-' +
              nItem +
              '">' +
              data.price +
              " " +
              priceIncoterm +
              '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
              multi.toFixed(2) +
              '</span></div></div><div><button class="btn btn-danger btnRemoveP btnR-' +
              nItem +
              '" value="' +
              nItem +
              '">X</button></div></div>'
          );

          $("#count").val(nItem);
          $("#ih-weight3").val(data.m3);
          $("#ih-chWeight").val(data.chWeight);
          var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
          $("#subtotal").val(sumaSubtotal.toFixed(2));
          if (data.rb2 == 3) {
            var iva = parseFloat($("#subtotal").val()) * parseFloat(0.2);
            $("#ih-iva").val(iva.toFixed(2));
          } else {
            var iva = "0.00";
            $("#ih-iva").val(iva);
          }
          if (data.incoterm === "EXW Kalstein Paris") {
            $("#desc").val("0.00");
          } else {
            var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
            $("#desc").val(porcentajeDescuento.toFixed(2));
          }
          var sumaSubtotal2 =
            parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
          $("#subtotal2").val(sumaSubtotal2.toFixed(2));
          let totalWithDiscount =
            parseFloat($("#subtotal2").val()) * parseFloat(percentageHidden);
          $("#totalWithDiscount").val(totalWithDiscount.toFixed(2));
          $("#envio").val(data.priceE);
          let customs = $("#customs").val();
          var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
          $("#customs").val(sumaCustoms.toFixed(2));
          var sumaSubTotal3 =
            parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
          var sumaTotal =
            parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
          var sumaTotal2 =
            parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
          $("#total").val(sumaTotal2.toFixed(2));
          let discountCode = $("#total").val() * $("#discountPercentage").val();
          let newTotal = $("#total").val() - discountCode;
          $("#total").val(newTotal.toFixed(2));

          $(".btnClosedModal").click();
        } else {
          if (data.withdrawalM == "1") {
            if (data.priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = data.priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }

            var nItem = $("#count").val();
            nItem = parseInt(nItem) + parseInt(1);
            $(".zipcode").val(data.zipcode);
            $(".zipcode").text(data.zipcode);
            $(".country").val(data.iso);
            $(".country").text(data.destination);
            $(".mshipping").val(data.mEnvio);
            $(".mshipping").text(data.mEnvio);
            $(".warehouse").val(data.incoterm);
            $(".warehouse").text(data.incoterm);
            $(".mPayment").val(data.payment);
            $(".mPayment").text(data.payment);
            $(".currency").val(data.coin);
            $(".currency").text(data.coin);
            $(".nPC").text(nItem);

            var precioAnidado =
              parseFloat(data.price) + parseFloat(data.priceIncoterm);
            var pricehscode =
              parseFloat(data.price) * parseFloat(data.hsPorcentage);
            var totalhscode = parseFloat(pricehscode) * parseFloat(data.cant);
            var multi = parseFloat(precioAnidado) * parseFloat(data.cant);
            var total = parseFloat(multi) + parseFloat(totalhscode);
            var subtotal = $("#subtotal").val();
            let name = data.name;
            let newName = name.replace(/'/g, /\'/);
            let nwName = newName.replace(/\//g, "");
            var arregloDiv = "";
            var mainAccesorie = "";
            let countAccesoriesAdd = 1;

            if (arrayAccesories === null) {
              mainAccesorie += "";
            } else {
              $.each(arrayAccesories, function (index, elem) {
                arregloDiv +=
                  '<div class="row" style="width: 100%; padding-left: 1.5rem;">' +
                  elem["modelAccesorie"] +
                  '</div><input type="hidden" id="ih-modelAccesorie-add-' +
                  nItem +
                  '" value="' +
                  elem["modelAccesorie"] +
                  '"/>';
              });
              mainAccesorie +=
                "<br> Accesorios Añadidos: " + arregloDiv + "<br>";
            }

            $(".cListProduct").append(
              '<div class="item" id="item-' +
                nItem +
                '"><div class="columnImage"><img src="' +
                data.image +
                '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="discountPercentage" value="' +
                data.codeDiscount +
                '"><input type="hidden" id="ih-model-' +
                nItem +
                '" value="' +
                data.model +
                '"/><input type="hidden" id="ih-name-' +
                nItem +
                '" value="' +
                nwName +
                '"/><input type="hidden" id="ih-maker-' +
                nItem +
                '" value="' +
                data.description +
                '"/><input type="hidden" id="ih-image-' +
                nItem +
                '" value="' +
                data.image +
                '"/><input type="hidden" id="ih-cant-' +
                nItem +
                '" value="' +
                data.cant +
                '"/><input type="hidden" id="ih-price-' +
                nItem +
                '" value="' +
                data.price +
                '"/><input type="hidden" id="ih-anidado-' +
                nItem +
                '" value="' +
                data.priceIncoterm +
                '"/><input type="hidden" id="ih-arancel-' +
                nItem +
                '" value="' +
                data.hsPorcentage +
                '"/><input type="hidden" id="ih-total-' +
                nItem +
                '" value="' +
                multi.toFixed(2) +
                '"/><input type="hidden" id="ih-weight-' +
                nItem +
                '" value="' +
                data.weight +
                '"/><input type="hidden" id="ih-m3-' +
                nItem +
                '" value="' +
                data.n3 +
                '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                data.name +
                '</span><br><span class="quantity" style="font-size: 0.7em;">Cant: ' +
                data.cant +
                "" +
                mainAccesorie +
                ' Precio: $<span class="spPrices-' +
                nItem +
                '">' +
                data.price +
                " " +
                priceIncoterm +
                '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                multi.toFixed(2) +
                '</span></div></div><div><button class="btn btn-danger btnRemoveP btnR-' +
                nItem +
                '" value="' +
                nItem +
                '">X</button></div></div>'
            );

            $("#count").val(nItem);
            $("#ih-weight3").val(data.m3);
            $("#ih-chWeight").val(data.chWeight);
            var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
            $("#ih-iva").val(0.0);
            if (data.incoterm === "EXW Kalstein Paris") {
              $("#desc").val("0.00");
            } else {
              var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
              $("#desc").val(porcentajeDescuento.toFixed(2));
            }
            var sumaSubtotal2 =
              parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
            $("#subtotal2").val(sumaSubtotal2.toFixed(2));
            let totalWithDiscount =
              parseFloat($("#subtotal2").val()) * parseFloat(percentageHidden);
            $("#totalWithDiscount").val(totalWithDiscount.toFixed(2));
            $("#envio").val(data.priceE);
            let customs = $("#customs").val();
            var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
            $("#customs").val(sumaCustoms.toFixed(2));
            var sumaSubTotal3 =
              parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
            var sumaTotal =
              parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
            var sumaTotal2 =
              parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
            $("#total").val(sumaTotal2.toFixed(2));
            let discountCode =
              $("#total").val() * $("#discountPercentage").val();
            let newTotal = $("#total").val() - discountCode;
            $("#total").val(newTotal.toFixed(2));

            $(".btnClosedModal").click();
          } else {
            if (data.priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = data.priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }
            var nItem = $("#count").val();
            nItem = parseInt(nItem) + parseInt(1);
            $(".zipcode").val(data.zipcode);
            $(".zipcode").text(data.zipcode);
            $(".country").val("");
            $(".country").text("");
            $(".mshipping").val("");
            $(".mshipping").text("");
            $(".warehouse").val(data.incoterm);
            $(".warehouse").text(data.incoterm);
            $(".mPayment").val(data.payment);
            $(".mPayment").text(data.payment);
            $(".currency").val(data.coin);
            $(".currency").text(data.coin);
            $(".nPC").text(nItem);

            var precioAnidado =
              parseFloat(data.price) + parseFloat(data.priceIncoterm);
            multi = parseFloat(precioAnidado) * parseFloat(data.cant);
            var pricehscode =
              parseFloat(data.price) * parseFloat(data.hsPorcentage);
            var totalhscode = parseFloat(pricehscode) * parseFloat(data.cant);
            var total = parseFloat(multi) + parseFloat(totalhscode);
            var subtotal = $("#subtotal").val();
            let name = data.name;
            let newName = name.replace(/'/g, /\'/);
            let nwName = newName.replace(/\//g, "");
            var arregloDiv = "";
            var mainAccesorie = "";
            let countAccesoriesAdd = 1;

            if (arrayAccesories === null) {
              mainAccesorie += "";
            } else {
              $.each(arrayAccesories, function (index, elem) {
                arregloDiv +=
                  '<div class="row" style="width: 100%; padding-left: 1.5rem;">' +
                  elem["modelAccesorie"] +
                  '</div><input type="hidden" id="ih-modelAccesorie-add-' +
                  nItem +
                  '" value="' +
                  elem["modelAccesorie"] +
                  '"/>';
              });
              mainAccesorie +=
                "<br> Accesorios Añadidos: " + arregloDiv + "<br>";
            }

            $(".cListProduct").append(
              '<div class="item" id="item-' +
                nItem +
                '"><div class="columnImage"><img src="' +
                data.image +
                '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="discountPercentage" value="' +
                data.codeDiscount +
                '"><input type="hidden" id="ih-model-' +
                nItem +
                '" value="' +
                data.model +
                '"/><input type="hidden" id="ih-name-' +
                nItem +
                '" value="' +
                nwName +
                '"/><input type="hidden" id="ih-maker-' +
                nItem +
                '" value="' +
                data.description +
                '"/><input type="hidden" id="ih-image-' +
                nItem +
                '" value="' +
                data.image +
                '"/><input type="hidden" id="ih-cant-' +
                nItem +
                '" value="' +
                data.cant +
                '"/><input type="hidden" id="ih-price-' +
                nItem +
                '" value="' +
                data.price +
                '"/><input type="hidden" id="ih-anidado-' +
                nItem +
                '" value="' +
                data.priceIncoterm +
                '"/><input type="hidden" id="ih-arancel-' +
                nItem +
                '" value="' +
                data.hsPorcentage +
                '"/><input type="hidden" id="ih-total-' +
                nItem +
                '" value="' +
                multi.toFixed(2) +
                '"/><input type="hidden" id="ih-weight-' +
                nItem +
                '" value="' +
                data.weight +
                '"/><input type="hidden" id="ih-m3-' +
                nItem +
                '" value="' +
                data.n3 +
                '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                data.name +
                '</span><br><span class="quantity" style="font-size: 0.7em;">Cant: ' +
                data.cant +
                "" +
                mainAccesorie +
                ' Precio: $<span class="spPrices-' +
                nItem +
                '">' +
                data.price +
                " " +
                priceIncoterm +
                '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                multi.toFixed(2) +
                '</span></div></div><div><button class="btn btn-danger btnRemoveP btnR-' +
                nItem +
                '" value="' +
                nItem +
                '">X</button></div></div>'
            );

            $("#count").val(nItem);
            $("#ih-weight3").val(data.m3);
            $("#ih-chWeight").val(data.chWeight);
            var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
            $("#ih-iva").val(0.0);
            if (data.incoterm === "EXW Kalstein Paris") {
              $("#desc").val("0.00");
            } else {
              var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
              $("#desc").val(porcentajeDescuento.toFixed(2));
            }
            var sumaSubtotal2 =
              parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
            $("#subtotal2").val(sumaSubtotal2.toFixed(2));
            let totalWithDiscount =
              parseFloat($("#subtotal2").val()) * parseFloat(percentageHidden);
            $("#totalWithDiscount").val(totalWithDiscount.toFixed(2));
            $("#envio").val(data.priceE);
            let customs = $("#customs").val();
            var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
            $("#customs").val(sumaCustoms.toFixed(2));
            var sumaSubTotal3 =
              parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
            var sumaTotal =
              parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
            var sumaTotal2 =
              parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
            $("#total").val(sumaTotal2.toFixed(2));
            let discountCode =
              $("#total").val() * $("#discountPercentage").val();
            let newTotal = $("#total").val() - discountCode;
            $("#total").val(newTotal.toFixed(2));

            $(".btnClosedModal").click();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function addProduct2(
    model,
    quantity,
    mEnvio,
    destination,
    zipcode,
    incoterm,
    chWeight,
    coin,
    payment,
    m3,
    rb,
    sres,
    atc,
    withdrawalM,
    deliveryTime,
    rb2,
    arrayAccesories,
    discount
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/searchProductsSC.php",
      type: "POST",
      data: {
        model,
        quantity,
        mEnvio,
        destination,
        zipcode,
        incoterm,
        chWeight,
        coin,
        payment,
        m3,
        rb,
        sres,
        atc,
        withdrawalM,
        deliveryTime,
        rb2,
        arrayAccesories,
        discount,
      },
    })
      .done(function (respuesta) {
        searchIdUser();
        console.log(respuesta);
        let percentageHidden = $("#ih-percentageDiscount").val();
        $(".showQUO").addClass("mobile-quote-hidden");
        $(".asideCotizacion").removeClass("mobile-quote-hidden");
        $(".entry-content").css({ width: "70vw", float: "left" });
        var data = JSON.parse(respuesta);
        $("#user").val(data.atc);
        $("#company").val(data.sres);
        $("#rb").val(data.rb);
        $("#rb2").val(data.rb2);
        $("#deliveryTimes").val(data.deliveryTime);
        $("#withdrawalMethod").val(data.withdrawalM);
        $("#emailMaker").val(data.maker);
        let arrayAccesories = data.arrayAccesories;
        if (data.rb === "1") {
          if (data.priceIncoterm === "0.00") {
            priceIncoterm = "";
          } else {
            var priceIncoterm = data.priceIncoterm;
            priceIncoterm = "(+" + priceIncoterm + ")";
          }
          var nItem = $("#count").val();
          nItem = parseInt(nItem) + parseInt(1);
          $(".zipcode").val(data.zipcode);
          $(".zipcode").text(data.zipcode);
          $(".country").val(data.iso);
          $(".country").text(data.destination);
          $(".mshipping").val(data.mEnvio);
          $(".mshipping").text(data.mEnvio);
          $(".warehouse").val(data.incoterm);
          $(".warehouse").text(data.incoterm);
          $(".mPayment").val(data.payment);
          $(".mPayment").text(data.payment);
          $(".currency").val(data.coin);
          $(".currency").text(data.coin);
          $(".nPC").text(nItem);

          var precioAnidado =
            parseFloat(data.price) + parseFloat(data.priceIncoterm);
          var pricehscode =
            parseFloat(data.price) * parseFloat(data.hsPorcentage);
          var totalhscode = parseFloat(pricehscode) * parseFloat(data.cant);
          var multi = parseFloat(precioAnidado) * parseFloat(data.cant);
          var discountPercent = parseFloat($("#discountPercentage").val());

          if (discountPercent > 0) {
            var discountedTotal =
              $("#total").val() - (total * discountPercent) / 100;
            $("#total").val(discountedTotal.toFixed(2));
          }
          var total = parseFloat(multi) + parseFloat(totalhscode);
          var subtotal = $("#subtotal").val();
          let name = data.name;
          let newName = name.replace(/'/g, /\'/);
          let nwName = newName.replace(/\//g, "");
          var arregloDiv = "";
          let countAccesoriesAdd = 1;

          if (arrayAccesories === null) {
            mainAccesorie += "";
          } else {
            $.each(arrayAccesories, function (index, elem) {
              arregloDiv +=
                '<div class="row" style="width: 100%; padding-left: 1.5rem;">' +
                elem["modelAccesorie"] +
                '</div><input type="hidden" id="ih-modelAccesorie-add-' +
                nItem +
                '" value="' +
                elem["modelAccesorie"] +
                '"/>';
            });
            mainAccesorie += "<br> Accesorios Añadidos: " + arregloDiv + "<br>";
          }

          $(".cListProduct").append(
            '<div class="item" id="item-' +
              nItem +
              '"><div class="columnImage"><img src="' +
              data.image +
              '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="discountPercentage" value="' +
              data.codeDiscount +
              '"><input type="hidden" id="ih-model-' +
              nItem +
              '" value="' +
              data.model +
              '"/><input type="hidden" id="ih-name-' +
              nItem +
              '" value="' +
              nwName +
              '"/><input type="hidden" id="ih-maker-' +
              nItem +
              '" value="' +
              data.description +
              '"/><input type="hidden" id="ih-image-' +
              nItem +
              '" value="' +
              data.image +
              '"/><input type="hidden" id="ih-cant-' +
              nItem +
              '" value="' +
              data.cant +
              '"/><input type="hidden" id="ih-price-' +
              nItem +
              '" value="' +
              data.price +
              '"/><input type="hidden" id="ih-anidado-' +
              nItem +
              '" value="' +
              data.priceIncoterm +
              '"/><input type="hidden" id="ih-arancel-' +
              nItem +
              '" value="' +
              data.hsPorcentage +
              '"/><input type="hidden" id="ih-total-' +
              nItem +
              '" value="' +
              multi.toFixed(2) +
              '"/><input type="hidden" id="ih-weight-' +
              nItem +
              '" value="' +
              data.weight +
              '"/><input type="hidden" id="ih-m3-' +
              nItem +
              '" value="' +
              data.n3 +
              '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
              data.name +
              '</span><br><span class="quantity" style="font-size: 0.7em;">Cant: ' +
              data.cant +
              "" +
              mainAccesorie +
              ' Precio: $<span class="spPrices-' +
              nItem +
              '">' +
              data.price +
              " " +
              priceIncoterm +
              '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
              multi.toFixed(2) +
              '</span></div></div><div><button class="btn btn-danger btnRemoveP btnR-' +
              nItem +
              '" value="' +
              nItem +
              '">X</button></div></div>'
          );

          $("#count").val(nItem);
          $("#ih-weight3").val(data.m3);
          $("#ih-chWeight").val(data.chWeight);
          var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
          $("#subtotal").val(sumaSubtotal.toFixed(2));
          if (data.rb2 == 3) {
            var iva = parseFloat($("#subtotal").val()) * parseFloat(0.2);
            $("#ih-iva").val(iva.toFixed(2));
          } else {
            var iva = "0.00";
            $("#ih-iva").val(iva);
          }
          if (data.incoterm === "EXW Kalstein Paris") {
            $("#desc").val("0.00");
          } else {
            var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
            $("#desc").val(porcentajeDescuento.toFixed(2));
          }
          var sumaSubtotal2 =
            parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
          $("#subtotal2").val(sumaSubtotal2.toFixed(2));
          let totalWithDiscount =
            parseFloat($("#subtotal2").val()) * parseFloat(percentageHidden);
          $("#totalWithDiscount").val(totalWithDiscount.toFixed(2));
          $("#envio").val(data.priceE);
          let customs = $("#customs").val();
          var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
          $("#customs").val(sumaCustoms.toFixed(2));
          var sumaSubTotal3 =
            parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
          var sumaTotal =
            parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
          var sumaTotal2 =
            parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
          $("#total").val(sumaTotal2.toFixed(2));
          let discountCode = $("#total").val() * $("#discountPercentage").val();
          let newTotal = $("#total").val() - discountCode;
          $("#total").val(newTotal.toFixed(2));

          $(".btnClosedModal").click();
        } else {
          if (data.withdrawalM == "1") {
            if (data.priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = data.priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }

            var nItem = $("#count").val();
            nItem = parseInt(nItem) + parseInt(1);
            $(".zipcode").val(data.zipcode);
            $(".zipcode").text(data.zipcode);
            $(".country").val(data.iso);
            $(".country").text(data.destination);
            $(".mshipping").val(data.mEnvio);
            $(".mshipping").text(data.mEnvio);
            $(".warehouse").val(data.incoterm);
            $(".warehouse").text(data.incoterm);
            $(".mPayment").val(data.payment);
            $(".mPayment").text(data.payment);
            $(".currency").val(data.coin);
            $(".currency").text(data.coin);
            $(".nPC").text(nItem);

            var precioAnidado =
              parseFloat(data.price) + parseFloat(data.priceIncoterm);
            var pricehscode =
              parseFloat(data.price) * parseFloat(data.hsPorcentage);
            var totalhscode = parseFloat(pricehscode) * parseFloat(data.cant);
            var multi = parseFloat(precioAnidado) * parseFloat(data.cant);
            var total = parseFloat(multi) + parseFloat(totalhscode);
            var subtotal = $("#subtotal").val();
            let name = data.name;
            let newName = name.replace(/'/g, /\'/);
            let nwName = newName.replace(/\//g, "");
            var arregloDiv = "";
            var mainAccesorie = "";
            let countAccesoriesAdd = 1;

            if (arrayAccesories === null) {
              mainAccesorie += "";
            } else {
              $.each(arrayAccesories, function (index, elem) {
                arregloDiv +=
                  '<div class="row" style="width: 100%; padding-left: 1.5rem;">' +
                  elem["modelAccesorie"] +
                  '</div><input type="hidden" id="ih-modelAccesorie-add-' +
                  nItem +
                  '" value="' +
                  elem["modelAccesorie"] +
                  '"/>';
              });
              mainAccesorie +=
                "<br> Accesorios Añadidos: " + arregloDiv + "<br>";
            }

            $(".cListProduct").append(
              '<div class="item" id="item-' +
                nItem +
                '"><div class="columnImage"><img src="' +
                data.image +
                '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="discountPercentage" value="' +
                data.codeDiscount +
                '"><input type="hidden" id="ih-model-' +
                nItem +
                '" value="' +
                data.model +
                '"/><input type="hidden" id="ih-name-' +
                nItem +
                '" value="' +
                nwName +
                '"/><input type="hidden" id="ih-maker-' +
                nItem +
                '" value="' +
                data.description +
                '"/><input type="hidden" id="ih-image-' +
                nItem +
                '" value="' +
                data.image +
                '"/><input type="hidden" id="ih-cant-' +
                nItem +
                '" value="' +
                data.cant +
                '"/><input type="hidden" id="ih-price-' +
                nItem +
                '" value="' +
                data.price +
                '"/><input type="hidden" id="ih-anidado-' +
                nItem +
                '" value="' +
                data.priceIncoterm +
                '"/><input type="hidden" id="ih-arancel-' +
                nItem +
                '" value="' +
                data.hsPorcentage +
                '"/><input type="hidden" id="ih-total-' +
                nItem +
                '" value="' +
                multi.toFixed(2) +
                '"/><input type="hidden" id="ih-weight-' +
                nItem +
                '" value="' +
                data.weight +
                '"/><input type="hidden" id="ih-m3-' +
                nItem +
                '" value="' +
                data.n3 +
                '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                data.name +
                '</span><br><span class="quantity" style="font-size: 0.7em;">Cant: ' +
                data.cant +
                "" +
                mainAccesorie +
                ' Precio: $<span class="spPrices-' +
                nItem +
                '">' +
                data.price +
                " " +
                priceIncoterm +
                '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                multi.toFixed(2) +
                '</span></div></div><div><button class="btn btn-danger btnRemoveP btnR-' +
                nItem +
                '" value="' +
                nItem +
                '">X</button></div></div>'
            );

            $("#count").val(nItem);
            $("#ih-weight3").val(data.m3);
            $("#ih-chWeight").val(data.chWeight);
            var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
            $("#ih-iva").val(0.0);
            if (data.incoterm === "EXW Kalstein Paris") {
              $("#desc").val("0.00");
            } else {
              var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
              $("#desc").val(porcentajeDescuento.toFixed(2));
            }
            var sumaSubtotal2 =
              parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
            $("#subtotal2").val(sumaSubtotal2.toFixed(2));
            let totalWithDiscount =
              parseFloat($("#subtotal2").val()) * parseFloat(percentageHidden);
            $("#totalWithDiscount").val(totalWithDiscount.toFixed(2));
            $("#envio").val(data.priceE);
            let customs = $("#customs").val();
            var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
            $("#customs").val(sumaCustoms.toFixed(2));
            var sumaSubTotal3 =
              parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
            var sumaTotal =
              parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
            var sumaTotal2 =
              parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
            $("#total").val(sumaTotal2.toFixed(2));
            let discountCode =
              $("#total").val() * $("#discountPercentage").val();
            let newTotal = $("#total").val() - discountCode;
            $("#total").val(newTotal.toFixed(2));

            $(".btnClosedModal").click();
          } else {
            if (data.priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = data.priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }
            var nItem = $("#count").val();
            nItem = parseInt(nItem) + parseInt(1);
            $(".zipcode").val(data.zipcode);
            $(".zipcode").text(data.zipcode);
            $(".country").val("");
            $(".country").text("");
            $(".mshipping").val("");
            $(".mshipping").text("");
            $(".warehouse").val(data.incoterm);
            $(".warehouse").text(data.incoterm);
            $(".mPayment").val(data.payment);
            $(".mPayment").text(data.payment);
            $(".currency").val(data.coin);
            $(".currency").text(data.coin);
            $(".nPC").text(nItem);

            var precioAnidado =
              parseFloat(data.price) + parseFloat(data.priceIncoterm);
            multi = parseFloat(precioAnidado) * parseFloat(data.cant);
            var pricehscode =
              parseFloat(data.price) * parseFloat(data.hsPorcentage);
            var totalhscode = parseFloat(pricehscode) * parseFloat(data.cant);
            var total = parseFloat(multi) + parseFloat(totalhscode);
            var subtotal = $("#subtotal").val();
            let name = data.name;
            let newName = name.replace(/'/g, /\'/);
            let nwName = newName.replace(/\//g, "");
            var arregloDiv = "";
            var mainAccesorie = "";
            let countAccesoriesAdd = 1;

            if (arrayAccesories === null) {
              mainAccesorie += "";
            } else {
              $.each(arrayAccesories, function (index, elem) {
                arregloDiv +=
                  '<div class="row" style="width: 100%; padding-left: 1.5rem;">' +
                  elem["modelAccesorie"] +
                  '</div><input type="hidden" id="ih-modelAccesorie-add-' +
                  nItem +
                  '" value="' +
                  elem["modelAccesorie"] +
                  '"/>';
              });
              mainAccesorie +=
                "<br> Accesorios Añadidos: " + arregloDiv + "<br>";
            }

            $(".cListProduct").append(
              '<div class="item" id="item-' +
                nItem +
                '"><div class="columnImage"><img src="' +
                data.image +
                '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="discountPercentage" value="' +
                data.codeDiscount +
                '"><input type="hidden" id="ih-model-' +
                nItem +
                '" value="' +
                data.model +
                '"/><input type="hidden" id="ih-name-' +
                nItem +
                '" value="' +
                nwName +
                '"/><input type="hidden" id="ih-maker-' +
                nItem +
                '" value="' +
                data.description +
                '"/><input type="hidden" id="ih-image-' +
                nItem +
                '" value="' +
                data.image +
                '"/><input type="hidden" id="ih-cant-' +
                nItem +
                '" value="' +
                data.cant +
                '"/><input type="hidden" id="ih-price-' +
                nItem +
                '" value="' +
                data.price +
                '"/><input type="hidden" id="ih-anidado-' +
                nItem +
                '" value="' +
                data.priceIncoterm +
                '"/><input type="hidden" id="ih-arancel-' +
                nItem +
                '" value="' +
                data.hsPorcentage +
                '"/><input type="hidden" id="ih-total-' +
                nItem +
                '" value="' +
                multi.toFixed(2) +
                '"/><input type="hidden" id="ih-weight-' +
                nItem +
                '" value="' +
                data.weight +
                '"/><input type="hidden" id="ih-m3-' +
                nItem +
                '" value="' +
                data.n3 +
                '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                data.name +
                '</span><br><span class="quantity" style="font-size: 0.7em;">Cant: ' +
                data.cant +
                "" +
                mainAccesorie +
                ' Precio: $<span class="spPrices-' +
                nItem +
                '">' +
                data.price +
                " " +
                priceIncoterm +
                '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                multi.toFixed(2) +
                '</span></div></div><div><button class="btn btn-danger btnRemoveP btnR-' +
                nItem +
                '" value="' +
                nItem +
                '">X</button></div></div>'
            );

            $("#count").val(nItem);
            $("#ih-weight3").val(data.m3);
            $("#ih-chWeight").val(data.chWeight);
            var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
            $("#ih-iva").val(0.0);
            if (data.incoterm === "EXW Kalstein Paris") {
              $("#desc").val("0.00");
            } else {
              var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
              $("#desc").val(porcentajeDescuento.toFixed(2));
            }
            var sumaSubtotal2 =
              parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
            $("#subtotal2").val(sumaSubtotal2.toFixed(2));
            let totalWithDiscount =
              parseFloat($("#subtotal2").val()) * parseFloat(percentageHidden);
            $("#totalWithDiscount").val(totalWithDiscount.toFixed(2));
            $("#envio").val(data.priceE);
            let customs = $("#customs").val();
            var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
            $("#customs").val(sumaCustoms.toFixed(2));
            var sumaSubTotal3 =
              parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
            var sumaTotal =
              parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
            var sumaTotal2 =
              parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
            $("#total").val(sumaTotal2.toFixed(2));
            let discountCode =
              $("#total").val() * $("#discountPercentage").val();
            let newTotal = $("#total").val() - discountCode;
            $("#total").val(newTotal.toFixed(2));

            $(".btnClosedModal").click();
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchCountry(consulta, val = "") {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/searchCountry.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#country").html(respuesta);
        if (val != "") {
          $("#country").val(val);
          $("#country").change();
        }
        $("#country2").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function searchCountryEU(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/searchCountryEU.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#countryEU").html(respuesta);
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
    descOnline,
    envio,
    arancel,
    total,
    datas,
    incoterm,
    divisa,
    pago,
    newUrl,
    mEnvio,
    destino,
    zipcode,
    IDacc,
    iva,
    maker
  ) {
    console.log(incoterm);
    console.log(divisa);
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/registerCotizacion.php",
      type: "POST",
      data: {
        sres,
        atc,
        subtotal,
        desc,
        subtotal2,
        descOnline,
        envio,
        arancel,
        total,
        datas,
        incoterm,
        divisa,
        pago,
        newUrl,
        mEnvio,
        destino,
        zipcode,
        IDacc,
        iva,
        maker,
      },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.registro === "correcto") {
          sessionUnset();
          var id = data.id;
          iziToast.success({
            title: "Éxito",
            message: `<a class='btnViewPDFiziToast' href='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/createPDF.php?idCotizacion=${id}' target='_blank' style?>👀</a>`,
            position: "topCenter",
            timeout: 4500,
            onClosing: function () {
              location.hash = "#cotizaciones";

              setTimeout(() => {
                document.querySelector(".quoteScrollTarget").scrollIntoView({
                  behavior: "smooth",
                  block: "center",
                  inline: "center",
                });
              }, 20);

              $("#c-panel02").addClass("anim-running");

              setTimeout(() => {
                $("#c-panel02").removeClass("anim-running");
              }, 6000);
            },
          });

          $("#ih-chWeight").val(0);
          $("#ih-weight3").val(0);
          $("#count").val(0);
          $("#resultCot").html(resultCotDiv);
          consultRolAccount();
        } else {
          alert("La creación de la cotización ha fallado debido a un error.");
          console.log(respuesta);
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function removeProducto(chWeight, destination, mEnvio, m3, warehouse) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/shippingRecalcule.php",
      type: "POST",
      data: { chWeight, destination, mEnvio, m3, warehouse },
    })
      .done(function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.warehouse === "EXW Kalstein Shanghai") {
          var priceE = data.priceE;
          $("#envio").val(priceE);
          var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
          $("#desc").val(porcentajeDescuento.toFixed(2));
          var sumaSubtotal2 =
            parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
          $("#subtotal2").val(sumaSubtotal2.toFixed(2));
          var sumaSubTotal =
            parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
          var sumaTotal =
            parseFloat(sumaSubTotal) + parseFloat($("#customs").val());
          var sumaTotal2 =
            parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
          $("#total").val(sumaTotal2.toFixed(2));
          let discountCode = $("#total").val() * $("#discountPercentage").val();
          let newTotal = $("#total").val() - discountCode;
          $("#total").val(newTotal.toFixed(2));
        } else {
          let countrySelect = $(".country").val();
          $("#envio").val("0.00");
          $("#desc").val("0.00");
          $("#subtotal2").val($("#subtotal").val());
          if (countrySelect === "FR") {
            let multi = parseFloat($("#subtotal2").val()) * parseFloat(0.2);
            let suma =
              parseFloat($("#subtotal2").val()) + parseFloat(multi.toFixed(2));
            $("#total").val(suma.toFixed(2));
            let discountCode =
              $("#total").val() * $("#discountPercentage").val();
            let newTotal = $("#total").val() - discountCode;
            $("#total").val(newTotal.toFixed(2));
          } else {
            let multi =
              parseFloat($("#subtotal2").val()) +
              parseFloat($("#customs").val());
            $("#total").val(multi.toFixed(2));
            let discountCode =
              $("#total").val() * $("#discountPercentage").val();
            let newTotal = $("#total").val() - discountCode;
            $("#total").val(newTotal.toFixed(2));
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function removeArrayProduct(numItem) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/removeArraySession.php",
      type: "POST",
      data: { numItem },
    })
      .done(function (respuesta) {
        console.log(respuesta);
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
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/changeShipping.php",
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
            "Debido a las políticas de la empresa y pensando en reducir un poco sus gastos, sus productos a listar exceden los 60kg, lo cual sería un poco costoso, por esta razón su envío será por vía marítima."
          );
          $("#envioM").val("Maritime");
          $("#btn-add").focus();
        } else {
          $("#subtotal").val("0.00");
          for (let i = 0; i < count; i++) {
            var priceIncoterm = array[i].priceIncoterm;
            var price = array[i].price;
            var a = parseInt(i) + parseInt(1);
            var cant = $("#ih-cant-" + a).val();
            var subtotal = $("#subtotal").val();

            var precioAnidado = parseFloat(price) + parseFloat(priceIncoterm);
            var precioTotal = parseFloat(precioAnidado) * parseFloat(cant);

            if (priceIncoterm === "0.00") {
              priceIncoterm = "";
            } else {
              var priceIncoterm = priceIncoterm;
              priceIncoterm = "(+" + priceIncoterm + ")";
            }

            $(".spPrices-" + a).text(price + " " + priceIncoterm);
            $("#ih-price-" + a).val(price);
            $("#ih-anidado-" + a).val(array[i].priceIncoterm);
            $("#ih-total-" + a).val(precioTotal.toFixed(2));
            var sumaSubtotal =
              parseFloat($("#ih-total-" + a).val()) + parseFloat(subtotal);
            $("#subtotal").val(sumaSubtotal.toFixed(2));
          }

          $("#envio").val(priceE);
          if (data.incoterm === "EXW Kalstein France") {
            $("#desc").val("0.00");
          } else {
            var porcentajeDescuento = parseFloat($("#subtotal").val() * 0.18);
            $("#desc").val(porcentajeDescuento.toFixed(2));
          }
          var sumaSubtotal2 =
            parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
          $("#subtotal2").val(sumaSubtotal2.toFixed(2));
          $("#envio").val(priceE);
          var sumaTotal =
            parseFloat($("#subtotal2").val()) + parseFloat($("#envio").val());
          $("#total").val(sumaTotal.toFixed(2));
          $(".country").text(data.iso);
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", ".btnLogIn", function () {
    location.reload(); //dev.kalstein.plus/plataforma/login/'
  });

  $(document).on("click", ".btnSingIn", function () {
    location.reload(); //dev.kalstein.plus/plataforma/singin/'
  });

  function sessionProducts(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/issetSessionProducts.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        searchIdUser();
        console.log(respuesta);
        let data = JSON.parse(respuesta);
        var n = Object.keys(data);

        if (n.length > 0) {
          $(".showQUO").addClass("mobile-quote-hidden");
          $(".asideCotizacion").removeClass("mobile-quote-hidden");
          $(".entry-content").css({ width: "70vw", float: "left" });
          $("#user").val(data[0].atc);
          $("#company").val(data[0].sres);
          $("#rb").val(data[0].rb);
          $("#rb2").val(data[0].rb2);
          $("#deliveryTimes").val(data[0].deliveryTime);
          $("#withdrawalMethod").val(data[0].withdrawalM);
          $.each(data, function (i, element) {
            searchIdUser();
            if (element.rb === "1") {
              if (element.priceIncoterm === "0.00") {
                priceIncoterm = "";
              } else {
                var priceIncoterm = element.priceIncoterm;
                priceIncoterm = "(+" + priceIncoterm + ")";
              }
              var nItem = $("#count").val();
              nItem = parseInt(nItem) + parseInt(1);
              $(".zipcode").val(element.zipcode);
              $(".zipcode").text(element.zipcode);
              $(".country").val(element.iso);
              $(".country").text(element.destination);
              $(".mshipping").val(element.mEnvio);
              $(".mshipping").text(element.mEnvio);
              $(".warehouse").val(element.incoterm);
              $(".warehouse").text(element.incoterm);
              $(".mPayment").val(element.payment);
              $(".mPayment").text(element.payment);
              $(".currency").val(element.coin);
              $(".currency").text(element.coin);
              $(".nPC").text(nItem);

              var precioAnidado =
                parseFloat(element.price) + parseFloat(element.priceIncoterm);
              var pricehscode =
                parseFloat(element.price) * parseFloat(element.hsPorcentage);
              var totalhscode =
                parseFloat(pricehscode) * parseFloat(element.cant);
              var multi = parseFloat(precioAnidado) * parseFloat(element.cant);
              var total = parseFloat(multi) + parseFloat(totalhscode);
              var subtotal = $("#subtotal").val();
              let name = element.name;
              let newName = name.replace(/'/g, /\'/);
              let nwName = newName.replace(/\//g, "");

              $(".cListProduct").append(
                '<div class="item" id="item-' +
                  nItem +
                  '"><div class="columnImage"><img src="' +
                  element.image +
                  '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="ih-model-' +
                  nItem +
                  '" value="' +
                  element.model +
                  '"/><input type="hidden" id="ih-name-' +
                  nItem +
                  '" value="' +
                  nwName +
                  '"/><input type="hidden" id="ih-maker-' +
                  nItem +
                  '" value="' +
                  element.description +
                  '"/><input type="hidden" id="ih-image-' +
                  nItem +
                  '" value="' +
                  element.image +
                  '"/><input type="hidden" id="ih-cant-' +
                  nItem +
                  '" value="' +
                  element.cant +
                  '"/><input type="hidden" id="ih-price-' +
                  nItem +
                  '" value="' +
                  element.price +
                  '"/><input type="hidden" id="ih-anidado-' +
                  nItem +
                  '" value="' +
                  element.priceIncoterm +
                  '"/><input type="hidden" id="ih-arancel-' +
                  nItem +
                  '" value="' +
                  totalhscode.toFixed(2) +
                  '"/><input type="hidden" id="ih-total-' +
                  nItem +
                  '" value="' +
                  multi.toFixed(2) +
                  '"/><input type="hidden" id="ih-weight-' +
                  nItem +
                  '" value="' +
                  element.weight +
                  '"/><input type="hidden" id="ih-m3-' +
                  nItem +
                  '" value="' +
                  element.n3 +
                  '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                  element.name +
                  '</span><br><span class="quantity" style="font-size: 0.7em;">Quantity: ' +
                  element.cant +
                  ' <br> Prices: $<span class="spPrices-' +
                  nItem +
                  ' d-inline">' +
                  element.price +
                  " " +
                  priceIncoterm +
                  '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                  multi.toFixed(2) +
                  '</span></div></div><div class="mainBtnRemoved"><button class="btn btn-danger btnRemoveP btnR-' +
                  nItem +
                  '" value="' +
                  nItem +
                  '">X</button></div></div>'
              );

              $("#count").val(nItem);
              $("#ih-weight3").val(element.m3);
              $("#ih-chWeight").val(element.chWeight);
              var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
              $("#subtotal").val(sumaSubtotal.toFixed(2));
              if (element.rb2 == 3) {
                var iva = parseFloat($("#subtotal").val()) * parseFloat(0.2);
                $("#ih-iva").val(iva.toFixed(2));
              } else {
                var iva = "0.00";
                $("#ih-iva").val(iva);
              }
              if (element.incoterm === "EXW Kalstein Paris") {
                $("#desc").val("0.00");
              } else {
                var porcentajeDescuento = parseFloat(
                  $("#subtotal").val() * 0.18
                );
                $("#desc").val(porcentajeDescuento.toFixed(2));
              }
              var sumaSubtotal2 =
                parseFloat($("#subtotal").val()) - parseFloat($("#desc").val());
              $("#subtotal2").val(sumaSubtotal2.toFixed(2));
              $("#envio").val(element.priceE);
              let customs = $("#customs").val();
              var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
              $("#customs").val(sumaCustoms.toFixed(2));
              var sumaSubTotal3 =
                parseFloat($("#subtotal2").val()) +
                parseFloat($("#envio").val());
              var sumaTotal =
                parseFloat(sumaSubTotal3) + parseFloat($("#customs").val());
              var sumaTotal2 =
                parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
              $("#total").val(sumaTotal2.toFixed(2));

              $(".btnClosedModal").click();
            } else {
              if (element.withdrawalM == "1") {
                if (element.priceIncoterm === "0.00") {
                  priceIncoterm = "";
                } else {
                  var priceIncoterm = element.priceIncoterm;
                  priceIncoterm = "(+" + priceIncoterm + ")";
                }

                var nItem = $("#count").val();
                nItem = parseInt(nItem) + parseInt(1);
                $(".zipcode").val(element.zipcode);
                $(".zipcode").text(element.zipcode);
                $(".country").val(element.iso);
                $(".country").text(element.destination);
                $(".mshipping").val(element.mEnvio);
                $(".mshipping").text(element.mEnvio);
                $(".warehouse").val(element.incoterm);
                $(".warehouse").text(element.incoterm);
                $(".mPayment").val(element.payment);
                $(".mPayment").text(element.payment);
                $(".currency").val(element.coin);
                $(".currency").text(element.coin);
                $(".nPC").text(nItem);

                var precioAnidado =
                  parseFloat(element.price) + parseFloat(element.priceIncoterm);
                var pricehscode =
                  parseFloat(element.price) * parseFloat(element.hsPorcentage);
                var totalhscode =
                  parseFloat(pricehscode) * parseFloat(element.cant);
                var multi =
                  parseFloat(precioAnidado) * parseFloat(element.cant);
                var total = parseFloat(multi) + parseFloat(totalhscode);
                var subtotal = $("#subtotal").val();
                let name = element.name;
                let newName = name.replace(/'/g, /\'/);
                let nwName = newName.replace(/\//g, "");

                $(".cListProduct").append(
                  '<div class="item" id="item-' +
                    nItem +
                    '"><div class="columnImage"><img src="' +
                    element.image +
                    '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="ih-model-' +
                    nItem +
                    '" value="' +
                    element.model +
                    '"/><input type="hidden" id="ih-name-' +
                    nItem +
                    '" value="' +
                    nwName +
                    '"/><input type="hidden" id="ih-maker-' +
                    nItem +
                    '" value="' +
                    element.description +
                    '"/><input type="hidden" id="ih-image-' +
                    nItem +
                    '" value="' +
                    element.image +
                    '"/><input type="hidden" id="ih-cant-' +
                    nItem +
                    '" value="' +
                    element.cant +
                    '"/><input type="hidden" id="ih-price-' +
                    nItem +
                    '" value="' +
                    element.price +
                    '"/><input type="hidden" id="ih-anidado-' +
                    nItem +
                    '" value="' +
                    element.priceIncoterm +
                    '"/><input type="hidden" id="ih-arancel-' +
                    nItem +
                    '" value="' +
                    element.hsPorcentage +
                    '"/><input type="hidden" id="ih-total-' +
                    nItem +
                    '" value="' +
                    multi.toFixed(2) +
                    '"/><input type="hidden" id="ih-weight-' +
                    nItem +
                    '" value="' +
                    element.weight +
                    '"/><input type="hidden" id="ih-m3-' +
                    nItem +
                    '" value="' +
                    element.n3 +
                    '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                    element.name +
                    '</span><br><span class="quantity" style="font-size: 0.7em;">Quantity: ' +
                    element.cant +
                    ' <br> Prices: $<span class="spPrices-' +
                    nItem +
                    ' d-inline">' +
                    element.price +
                    " " +
                    priceIncoterm +
                    '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                    multi.toFixed(2) +
                    '</span></div></div><div class="mainBtnRemoved"><button class="btn btn-danger btnRemoveP btnR-' +
                    nItem +
                    '" value="' +
                    nItem +
                    '">X</button></div></div>'
                );

                $("#count").val(nItem);
                $("#ih-weight3").val(element.m3);
                $("#ih-chWeight").val(element.chWeight);
                var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
                $("#subtotal").val(sumaSubtotal.toFixed(2));
                $("#ih-iva").val(0.0);
                if (element.incoterm === "EXW Kalstein Paris") {
                  $("#desc").val("0.00");
                } else {
                  var porcentajeDescuento = parseFloat(
                    $("#subtotal").val() * 0.18
                  );
                  $("#desc").val(porcentajeDescuento.toFixed(2));
                }
                var sumaSubtotal2 =
                  parseFloat($("#subtotal").val()) -
                  parseFloat($("#desc").val());
                $("#subtotal2").val(sumaSubtotal2.toFixed(2));
                $("#envio").val(element.priceE);
                let customs = $("#customs").val();
                var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
                $("#customs").val(sumaCustoms.toFixed(2));
                var sumaSubTotal =
                  parseFloat($("#subtotal2").val()) +
                  parseFloat($("#envio").val());
                var sumaTotal =
                  parseFloat(sumaSubTotal) + parseFloat($("#customs").val());
                var sumaTotal2 =
                  parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
                $("#total").val(sumaTotal2.toFixed(2));

                $(".btnClosedModal").click();
              } else {
                if (element.priceIncoterm === "0.00") {
                  priceIncoterm = "";
                } else {
                  var priceIncoterm = element.priceIncoterm;
                  priceIncoterm = "(+" + priceIncoterm + ")";
                }
                var nItem = $("#count").val();
                nItem = parseInt(nItem) + parseInt(1);
                $(".zipcode").val(element.zipcode);
                $(".zipcode").text(element.zipcode);
                $(".country").val("");
                $(".country").text("");
                $(".mshipping").val("");
                $(".mshipping").text("");
                $(".warehouse").val(element.incoterm);
                $(".warehouse").text(element.incoterm);
                $(".mPayment").val(element.payment);
                $(".mPayment").text(element.payment);
                $(".currency").val(element.coin);
                $(".currency").text(element.coin);
                $(".nPC").text(nItem);

                var precioAnidado =
                  parseFloat(element.price) + parseFloat(element.priceIncoterm);
                multi = parseFloat(precioAnidado) * parseFloat(element.cant);
                var pricehscode =
                  parseFloat(element.price) * parseFloat(element.hsPorcentage);
                var totalhscode =
                  parseFloat(pricehscode) * parseFloat(element.cant);
                var total = parseFloat(multi) + parseFloat(totalhscode);
                var subtotal = $("#subtotal").val();
                let name = element.name;
                let newName = name.replace(/'/g, /\'/);
                let nwName = newName.replace(/\//g, "");

                $(".cListProduct").append(
                  '<div class="item" id="item-' +
                    nItem +
                    '"><div class="columnImage"><img src="' +
                    element.image +
                    '" style="height: 98%;" class="img-fluid" alt="..."></div><div class="columnDescription"><input type="hidden" id="ih-model-' +
                    nItem +
                    '" value="' +
                    element.model +
                    '"/><input type="hidden" id="ih-name-' +
                    nItem +
                    '" value="' +
                    nwName +
                    '"/><input type="hidden" id="ih-maker-' +
                    nItem +
                    '" value="' +
                    element.description +
                    '"/><input type="hidden" id="ih-image-' +
                    nItem +
                    '" value="' +
                    element.image +
                    '"/><input type="hidden" id="ih-cant-' +
                    nItem +
                    '" value="' +
                    element.cant +
                    '"/><input type="hidden" id="ih-price-' +
                    nItem +
                    '" value="' +
                    element.price +
                    '"/><input type="hidden" id="ih-anidado-' +
                    nItem +
                    '" value="' +
                    element.priceIncoterm +
                    '"/><input type="hidden" id="ih-arancel-' +
                    nItem +
                    '" value="' +
                    totalhscode.toFixed(2) +
                    '"/><input type="hidden" id="ih-total-' +
                    nItem +
                    '" value="' +
                    multi.toFixed(2) +
                    '"/><input type="hidden" id="ih-weight-' +
                    nItem +
                    '" value="' +
                    element.weight +
                    '"/><input type="hidden" id="ih-m3-' +
                    nItem +
                    '" value="' +
                    element.n3 +
                    '"/><span class="fw-bold" style="font-size: 0.8em; width: 100%; padding-top: -2mm;">' +
                    element.name +
                    '</span><br><span class="quantity" style="font-size: 0.7em;">Quantity: ' +
                    element.cant +
                    ' <br> Prices: $<span class="spPrices-' +
                    nItem +
                    ' d-inline">' +
                    element.price +
                    " " +
                    priceIncoterm +
                    '</span></span><br><div class="cTotalItemPrices" style="float: right;"><span class="fw-bold" style="font-size: 0.8em;">Total: ' +
                    multi.toFixed(2) +
                    '</span></div></div><div class="mainBtnRemoved"><button class="btn btn-danger btnRemoveP btnR-' +
                    nItem +
                    '" value="' +
                    nItem +
                    '">X</button></div></div>'
                );

                $("#count").val(nItem);
                $("#ih-weight3").val(element.m3);
                $("#ih-chWeight").val(element.chWeight);
                var sumaSubtotal = parseFloat(multi) + parseFloat(subtotal);
                $("#subtotal").val(sumaSubtotal.toFixed(2));
                $("#ih-iva").val(0.0);
                if (element.incoterm === "EXW Kalstein Paris") {
                  $("#desc").val("0.00");
                } else {
                  var porcentajeDescuento = parseFloat(
                    $("#subtotal").val() * 0.18
                  );
                  $("#desc").val(porcentajeDescuento.toFixed(2));
                }
                var sumaSubtotal2 =
                  parseFloat($("#subtotal").val()) -
                  parseFloat($("#desc").val());
                $("#subtotal2").val(sumaSubtotal2.toFixed(2));
                $("#envio").val("0.00");
                let customs = $("#customs").val();
                var sumaCustoms = parseFloat(customs) + parseFloat(totalhscode);
                $("#customs").val("0.00");
                var sumaSubTotal =
                  parseFloat($("#subtotal2").val()) +
                  parseFloat($("#envio").val());
                var sumaTotal =
                  parseFloat(sumaSubTotal) + parseFloat($("#customs").val());
                var sumaTotal2 =
                  parseFloat(sumaTotal) + parseFloat($("#ih-iva").val());
                $("#total").val(sumaTotal2.toFixed(2));

                $(".btnClosedModal").click();
              }
            }
          });
        } else {
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  function sessionUnset(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/deleteCotizacionSession.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        console.log(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#r01", function () {
    $("#cEXWShanghai").removeClass("none");
    $("#cEXWParis").addClass("none");
    $("#deliveryTimes").val("0");
    $("#r02").removeAttr("checked");
    $(this).attr("checked", true);
  });

  $(document).on("click", "#r02", function () {
    $("#cEXWParis").removeClass("none");
    $("#cEXWShanghai").addClass("none");
    $("#withdrawalMethod").val("0");
    $("#deliveryTimes").val("0");
    $("#r01").removeAttr("checked");
    $(this).attr("checked", true);
  });

  $(document).on("click", "#r03", function () {
    $("#r04").removeAttr("checked");
    $(this).attr("checked", true);
    $(".c-countryEU").addClass("none");
    $(".c-countryParis").css({ width: "100%" });
  });

  $(document).on("click", "#r04", function () {
    $("#r03").removeAttr("checked");
    $(".c-countryEU").removeClass("none");
    $(".c-countryParis").css({ width: "48%" });
    $(this).attr("checked", true);
  });

  $(document).on("click", "#li-department", function (e) {
    e.preventDefault();
    let valor = $(this).text();
    $("#filterSearchCategorie").text(valor);
  });

  $(document).on("keyup", "#i-search", function (e) {
    e.preventDefault();
    var valor = $(this).val();
    var department = $("#filterSearchCategorie").text();
    var path = $(location).attr("pathname");

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

  function showProductSearched(changePage) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/templates-php/resultPage.php",
      type: "POST",
      data: {},
    })
      .done(function (response) {
        $("#results").html(response);
        resultPagePagination();
      })
      .fail(function () {
        console.log("error");
      });

    $("#results").html("");
  }

  function resultPagePagination() {
    $("#quote-next-result").submit(function (e) {
      e.preventDefault();
      var nextPage = $(this).find("input[name=b]").val();
      contentResultPage(nextPage);
    });

    $("#quote-previous-result").submit(function (e) {
      e.preventDefault();
      var prevPage = $(this).find("input[name=b]").val();
      contentResultPage(prevPage);
    });
  }

  function contentResultPage(nextPage) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/templates-php/resultPage.php",
      type: "POST",
      data: { nextPage },
      success: function (data) {
        var tableContent = $(data).find("#mainResultSearchDiv").html();

        var currentPage = nextPage;
        $("#currentPageIndicatorResult").text("Page: " + currentPage);

        let totalCount = $("#totalCount").text();
        let maxCount = "";
        if (totalCount < 12) {
          maxCount = totalCount;
        } else {
          maxCount = parseInt(12) * parseInt(currentPage);
        }

        let minCount = totalCount == 0 ? 0 : parseInt(maxCount) - parseInt(11);

        if (maxCount > totalCount) {
          maxCount = totalCount;
          $("#quote-next-result").attr("hidden", "hidden");
        } else {
          maxCount = maxCount;
          maxCount == totalCount
            ? $("#quote-next-result").attr("hidden", "hidden")
            : $("#quote-next-result").removeAttr("hidden");
        }

        nextPage == 1
          ? $("#quote-previous-result").attr("hidden", "hidden")
          : $("#quote-previous-result").removeAttr("hidden");

        $("#minCount").text(minCount);
        $("#maxCount").text(maxCount);
        scrollTo(0, 0);

        $("#mainResultSearchDiv").html(tableContent);

        if (tableContent.trim() === "") {
          return;
        }

        $(".pagination #quote-next-result input[name=b]").val(
          parseInt(currentPage) + 1
        );
        let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;
        $(".pagination #quote-previous-result input[name=b]").val(prev);
      },
      error: function () {
        alert("Error charging quote data.");
      },
    });
  }

  $(document).on("click", "#next", function () {
    var nextPage = $(this).val();
    console.log(nextPage);
    contentResultPage(nextPage);
    $(this).val(parseInt(nextPage) + parseInt(1));
  });

  function clickBtnGenQuote() {
    scrollTo(0, 320);
    resetNavLinks("#btnGenQuote");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "block" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
  }

  $(document).on("click", ".li-sug", function () {
    var valor = $(this).text();
    var categorie = $("#filterSearchCategorie").text();
    createdSession(valor, categorie);
    $(".sc").removeClass("show");
    $("#btn-quote-back").click();
    clickBtnGenQuote();
  });

  function resetNavLinks(exception) {
    let links = [
      "#btnDashboardPr01",
      "#btnQuotePr01",
      "#btnRecentActivityPr01",
      "#btnEditProfilePr01",
      "#btnReportPr01",
      "#btnCatalogs",
    ];

    for (let elem of links) {
      $(elem).removeClass("active");
    }

    $(exception).addClass("active");
  }

  $(document).on("click", "#btnGenQuote", function (e) {
    viewSearchRecent("", "Todas");
    $(".sc").removeClass("show");
  });

  if ($("#search-product").val() != "") {
    viewSearchRecent("", "All");
    $("#btnDashboardPr01").removeClass("active");
  }

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

  $(document).on("click", ".typeCategoryWidget", function () {
    var valor = $(this).text();
    createdSession(valor, "Todas");
    scrollTo(0, 0);

    $("#btn-quote-back").click();
    $(".typeCategoryWidget").removeClass("fw-bold");
    $(".list-subcategory-widget").removeClass("fw-bold");
    $(this).addClass("fw-bold");
  });

  $(document).on("click", ".list-subcategory-widget", function () {
    var valor = $(this).text();
    createdSession(valor, "Todas");
    scrollTo(0, 0);

    $("#btn-quote-back").click();
    $(".typeCategoryWidget").removeClass("fw-bold");
    $(".list-subcategory-widget").removeClass("fw-bold");
    $(this).addClass("fw-bold");
  });

  function createdSession(consulta, consulta1) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/createdSession.php",
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

  $(document).on("change", "#withdrawalMethod", function () {
    var valor = $(this).val();
    if (valor == 1) {
      $("#c-withdrawal").css({ display: "block" });
      $(".container-shipping").removeClass("none");
    } else {
      if (valor == 2) {
        $("#c-withdrawal").css({ display: "block" });
        $(".container-shipping").addClass("none");
      } else {
        if (valor == 0) {
          $("#c-withdrawal").css({ display: "none" });
          $(".container-shipping").addClass("none");
        }
      }
    }
  });

  $(document).on("change", "#deliveryTimes", function () {
    var valor = $(this).val();
    if (valor == 1) {
      $(".container-shippingParis").removeClass("none");
    } else {
      if (valor == 2) {
        $(".container-shippingParis").removeClass("none");
      } else {
        if (valor == 0) {
          $(".container-shippingParis").addClass("none");
        }
      }
    }
  });

  $(document).on("change", "#envioM", function () {
    var valor = $(this).val();
    if (valor != "0") {
      searchCountry(valor);
    }
  });

  // PREVIEW PRODUCT

  $(document).on("click", ".img-preview-quote", function () {
    let product = this.getAttribute("value");

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/client/wooPreview.php",
      type: "GET",
      data: { p: product },
    })
      .done(function (response) {
        $("#results").attr("hidden", "");
        $("#resultsDiv").attr("hidden", "");

        $("#preview-item").removeAttr("hidden");
        $("#preview-item").html(response);

        $("#resultCot").addClass("order-first");

        scrollTo(0, 0);

        searchForModels();
      })
      .fail(function () {
        $("#preview-item").attr("hidden", "");
      });
  });

  $(document).on("click", "#btn-quote-back", function () {
    $("#results").removeAttr("hidden");
    $("#resultsDiv").removeAttr("hidden");
    $("#c-panel06 .container-fluid").removeAttr("hidden");

    $("#preview-item").attr("hidden", "");
    $("#preview-item").html("");

    $("#resultCot").removeClass("order-first");
  });

  $(document).on("click", "#btnViewSearch", function () {
    let valor = $(this).val();
    let search = $("#btnDescriptionViewSearch-" + valor).val();
    let categorie = $("#btnCategorieViewSearch-" + valor).val();
    viewSearchRecent(search, categorie);
    $("#btn-quote-back").click();
    window.scrollTo(0, 0);
    resetNavLinks("#btnGenQuote");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "block" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
  });

  $(document).on("click", ".showQUO", function () {
    $(".showQUO").addClass("mobile-quote-hidden");
    $(".asideCotizacion").removeClass("mobile-quote-hidden");
  });

  $(document).on("click", ".btnCloseQuote", function () {
    $(".asideCotizacion").addClass("mobile-quote-hidden");
    $(".showQUO").removeClass("mobile-quote-hidden");
  });

  $(document).on("click", "#btnShare", function () {
    let value = $(this).attr("value");
    navigator.clipboard.writeText(
      "https://dev.kalstein.plus/plataforma/dashboard/?search=" + value
    );
    iziToast.success({
      title: "Copied",
      message: `Copied to clipboard`,
      position: "topCenter",
    });
  });

  let isToastOpen = false;

  $(document).on("click", ".btn-view-accessory", function () {
    if (isToastOpen) {
      return;
    }

    var quote_id = $(this).data().id;
    console.log(quote_id);

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/manufacturer/getAccessoryInfo.php",
      method: "POST",
      data: { quote_id },
    })
      .done(function (response) {
        console.log(response);
        let res = JSON.parse(response);

        res.forEach((elem) => {
          productName = elem.product_name;
          productModel = elem.product_model;
          product_description = elem.product_description;
          productImage = elem.product_image;
          product_price = elem.product_price;

          var details =
            "Nombre del producto: " +
            productName +
            "<br>" +
            "Modelo del producto: " +
            productModel +
            "<br>" +
            "Descripción: " +
            product_description +
            "<br>" +
            "Precio: USD " +
            product_price +
            "<br>" +
            'Imagen: <img style="max-width: 200px;" src="' +
            productImage +
            '">';

          iziToast.show({
            title: "Detalles",
            message: details,
            position: "center",
            timeout: false,
            closeOnClick: true,
            progressBar: false,
            onClosed: function () {
              isToastOpen = false;
            },
          });
          isToastOpen = true;
        });
      })
      .fail(function () {
        iziToast.error({
          title: "Error",
          message: "No se pueden obtener datos de la base de datos",
          position: "center",
          timeout: false,
          closeOnClick: true,
          progressBar: false,
        });
        isToastOpen = true;
      });
  });

  $(document).ready(function() {
    // Usar hover para cambiar las clases
    $('#catg1').hover(function() {
      $(this).addClass('show').removeClass('elemento-vista-previa');
    }, function() {
      $(this).addClass('elemento-vista-previa').removeClass('show');
    });
  });
});

function verificarUsuaurio(modelo) {
  $.ajax({
    url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/php/verificadorUsuario.php",
    method: "POST",
    data: { product_model: modelo },
  })
    .done(function (data) {
      console.log(data);
    })
    .fail(function () {
      console.log("error");
      alert("error");
    });
}