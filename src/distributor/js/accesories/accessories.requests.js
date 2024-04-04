var currentFileAccessories = {};

function validateProductDataAcc(
  name,
  model,
  description,
  weight,
  length,
  width,
  height,
  weight_pa,
  length_pa,
  width_pa,
  height_pa,
  pa_type,
  price,
  currency,
  parent,
  dont_image = false
) {
  err_msg = "";
  function scroll(selector) {
    const a = document.querySelector(selector);
    a.scrollIntoView({
      behavior: "smooth",
      block: "center",
      inline: "center",
    });
    document.querySelector(selector).focus();
  }

  var ignore_description;

  if (description === "") {
    ignore_description = true;
  }

  // void verifications
  if (name === "") {
    err_msg = "Name empty";
    scroll("#nameProductAcc");
  } else if (model === "") {
    err_msg = "Model empty";
    scroll("#modelProductAcc");
  } else if (weight === "") {
    err_msg = "Weight empty";
    scroll("#weProductAcc");
  } else if (width === "") {
    err_msg = "Width empty";
    scroll("#wiProductAcc");
  } else if (height === "") {
    err_msg = "Height empty";
    scroll("#heProductAcc");
  } else if (length === "") {
    err_msg = "Length empty";
    scroll("#leProductAcc");
  } else if (weight_pa === "") {
    err_msg = "Packing weight empty";
    scroll("#weProductPaAcc");
  } else if (width_pa === "") {
    err_msg = "Packing width empty";
    scroll("#wiProductPaAcc");
  } else if (height_pa === "") {
    err_msg = "Packing height empty";
    scroll("#heProductPaAcc");
  } else if (length_pa === "") {
    err_msg = "Packing length empty";
    scroll("#leProductPaAcc");
  } else if (pa_type === "") {
    err_msg = "Packing type empty";
    scroll("#packageTypeAcc");
  } else if (price === "") {
    err_msg = "Unit price empty";
    scroll("#priceProductAcc");
  } else if (currency === "") {
    err_msg = "Currency empty";
    scroll("#currencyAcc");
  }
  // negative verification
  else if (parseFloat(price) <= 0) {
    err_msg = "Price cannot be less than 0";
    scroll("#priceProductAcc");
  } else if (parseFloat(weight) <= 0) {
    err_msg = "Weight cannot be less than 0";
    scroll("#weProductAcc");
  } else if (parseFloat(width) <= 0) {
    err_msg = "Length cannot be less than 0";
    scroll("#wiProductAcc");
  } else if (parseFloat(height) <= 0) {
    err_msg = "Width cannot be less than 0";
    scroll("#heProductAcc");
  } else if (parseFloat(length) <= 0) {
    err_msg = "Height cannot be less than 0";
    scroll("#leProductAcc");
  } else if (parseFloat(weight_pa) <= 0) {
    err_msg = "Packing weight cannot be less than 0";
    scroll("#weProductPaAcc");
  } else if (parseFloat(width_pa) <= 0) {
    err_msg = "Packing length cannot be less than 0";
    scroll("#wiProductPaAcc");
  } else if (parseFloat(height_pa) <= 0) {
    err_msg = "Packing width cannot be less than 0";
    scroll("#heProductPaAcc");
  } else if (parseFloat(length_pa) <= 0) {
    err_msg = "Packing height cannot be less than 0";
    scroll("#leProductPaAcc");
  }
  // length validations
  else if (name.length > 200) {
    err_msg = "Name must be less than 200 characters";
    scroll("#nameProductAcc");
  } else if (model.length > 50) {
    err_msg = "Name must be less than 60 characters";
    scroll("#modelProductAcc");
  } else if (description.length > 1000) {
    err_msg = "Descriptiom must be less than 1000 characters";
    scroll("#descriptionProductAcc");
  } else {
    // verificacion de enlaces

    let reg = RegExp(
      /(\b(https?|ftp|file):\/\/|www\.[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi
    );

    let name_r = reg.test(name);
    let description_r;
    if (!ignore_description) {
      description_r = reg.test(description);
    }

    if (name_r) {
      err_msg = "please avoid linking to external websites in the title";
      scroll("#nameProduct");
    } else if (!ignore_description) {
      if (description_r) {
        err_msg = "please avoid linking to external websites in the descrption";
        scroll("#descriptionProduct");
      }
    }

    // verificacion de etiquetas HTML

    reg_ex1 = RegExp(/<(\S*?)[^>]*>.*?<\/\1>|<.*?\/>/g);
    reg_ex2 = RegExp(/<(\S*?)[^>]*>/g);

    if (reg_ex1.test(name) || reg_ex2.test(name)) {
      err_msg =
        'Please avoid using expressions of the form "&lt;xxx&gt;", "&lt;xxx/&gt;".';
      scroll("#nameProduct");
    }
    if (!ignore_description) {
      if (reg_ex1.test(description) || reg_ex2.test(description)) {
        err_msg =
          'Please avoid using expressions of the form "&lt;xxx&gt;", "&lt;xxx/&gt;".';
        scroll("#descriptionProduct");
      }
    }

    // palabras clave

    const words = [
      "Exclusive",
      "cheap",
      "Incredible",
      "Miraculous",
      "Guaranteed",
      "Risk-free",
      "100% safe",
      "Limited offer",
      "Guaranteed savings",
      "Ancient product",
      "Definitive solution",
      "Amazing testimonials",
      "Secret revealed",
      "Easy money-making",
      "Number 1 in sales",
      "Clearance prices",
      "Exaggerated discounts",
      "Win instant prizes",
      "Unmatched",
      "Exceeds all expectations",
    ];

    for (let word of words) {
      if (name.includes(word)) {
        err_msg =
          "Please avoid placing advertising words in the name of the product";
        scroll("#nameProduct");
      } else if (!ignore_description) {
        if (description.includes(word)) {
          err_msg = "Please avoid placing advertising words in the description";
          scroll("#descriptionProduct");
        }
      }
    }
  }

  if (err_msg != "") {
    iziToast.error({
      title: "Error",
      message: err_msg,
      position: "center",
    });
    return false;
  } else return true;
}

function imgVal(file, id) {
  console.log(file);

  err_msg = "";

  var maxSize = 10 * 1024 * 1024; // 10 MB
  var allowedTypes = ["image/jpeg", "image/png"];
  var fileType = file.type;

  if (file.size > maxSize) {
    err_msg = "The file size exceeds the limit of 10 MB.";
  }
  // formato de imagen
  else if (!allowedTypes.includes(fileType)) {
    err_msg = "Only JPG, PNG, and JPEG files are allowed.";
  }

  // tamaño mínimo
  var _URL = window.URL || window.webkitURL;
  var objectUrl = _URL.createObjectURL(file);

  const image = document.createElement("img");

  image.setAttribute("hidden", "");

  if(err_msg == ""){
        image.onload = function() {
            if (image.width < 250 || image.height < 250) {
    
                iziToast.error({
                    title: 'Error',
                    message: 'The image must be at least 900x900px in size.',
                    position: 'center'
                });
    
            }
        }
    }
  //document.querySelector("#" + id).value = "";

  image.src = objectUrl;
  document.body.appendChild(image);

  if (err_msg != "") {
    iziToast.error({
      title: "Error",
      message: err_msg,
      position: "center",
    });
    return false;
  } else return true;
}

jQuery(document).ready(function ($) {
  // SECCION: Envío de datos al servidor para añadir nuevo product

  $(document).on("change", "#file-inputAcc", () => {
    if (!imgVal($("#file-inputAcc")[0].files[0], "file-inputAcc")) {
      $("#file-inputAcc").val(undefined);
    }
  });

  function resetForm() {
    document.querySelector("#accessories_editor").reset();
    $("#thumbnailAcc").attr("style", "");
    $("#accessoyId").data().item = "new";
    $("#accessoyId").data().id = "";
    $("#accessoyId").data().id = "";
    $("#descriptionProductAcc").val("");
  }

  $(document).on("click", "#btnUpladAccesory", function (e) {
    var exist_status = $("#accessoyId").data().item;
    console.log($("#accessoyId").data());
    var exist_id = $("#accessoyId").data().id;

    var name = $("#nameProductAcc").val().replace(/'/g, "\\'");
    var model = $("#modelProductAcc").val().replace(/'/g, "\\'");
    var description = $("#descriptionProductAcc").val().replace(/'/g, "\\'");

    var fileInput = $("#file-inputAcc")[0].files[0];

    if (fileInput == undefined || fileInput == "") {
      fileInput = currentFileAccessories[$("#accessoyId").data().id];
    }

    var weight = $("#weProductAcc").val();
    var length = $("#leProductAcc").val();
    var width = $("#wiProductAcc").val();
    var height = $("#heProductAcc").val();

    var weight_pa = $("#weProductPaAcc").val();
    var length_pa = $("#leProductPaAcc").val();
    var width_pa = $("#wiProductPaAcc").val();
    var height_pa = $("#heProductPaAcc").val();
    var pa_type = $("#packageTypeAcc").val();

    var price = $("#priceProductAcc").val();
    var currency = $("#currencyAcc").val();

    if (
      validateProductDataAcc(
        name,
        model,
        description,
        weight,
        length,
        width,
        height,
        weight_pa,
        length_pa,
        width_pa,
        height_pa,
        pa_type,
        price,
        currency
      )
    ) {
      savedDataUploadAcc(
        exist_status,
        exist_id,
        name,
        model,
        description,
        fileInput,
        weight,
        length,
        width,
        height,
        weight_pa,
        length_pa,
        width_pa,
        height_pa,
        pa_type,
        price,
        currency
      );
    }
  });

  function savedDataUploadAcc(
    exist_status,
    exist_id,
    name,
    model,
    description,
    fileInput,
    weight,
    length,
    width,
    height,
    weight_pa,
    length_pa,
    width_pa,
    height_pa,
    pa_type,
    price,
    currency
  ) {
    var accessory_array = {};

    accessory_array.exist_status =
      exist_status == "new" ? "draft" : exist_status;

    card_id = exist_id != "" ? exist_id : Math.random().toString(16).slice(7);
    accessory_array.card_id = card_id;

    accessory_array.name = name;
    accessory_array.model = model;
    accessory_array.description = description;
    accessory_array.fileInput = "local";

    accessory_array.weight = weight;
    accessory_array.lengths = length;
    accessory_array.width = width;
    accessory_array.height = height;

    accessory_array.weight_pa = weight_pa;
    accessory_array.length_pa = length_pa;
    accessory_array.width_pa = width_pa;
    accessory_array.height_pa = height_pa;
    accessory_array.pa_type = pa_type;

    accessory_array.price = price;
    accessory_array.currency = currency;

    money = accessory_array.currency == "USD" ? "$" : "€";

    console.log(accessory_array);

    if (exist_status == "new") {
      $("#uploadAccesoryList").append(`
                <div class="card accessoryTarget p-3" data-item="draft" data-id="${card_id}">
                    <textarea type="hidden" class="json" hidden>${JSON.stringify(
                      accessory_array
                    )}</textarea>
                    <input type="hidden" class="image-url">
                    <div class="accessoryPreview d-flex flex-row">
                        <img src="" width="150">
                        <div class="ms-3">
                            <h6>${accessory_array.name}</h6>
                            <p><b>Model: </b> ${accessory_array.model}</p>
                            <p><b>Price: </b> ${
                              accessory_array.price
                            } ${money}</p>
                        </div>
                    </div>
                </div>
            `);

      if (fileInput !== undefined) {
        currentFileAccessories[card_id] = fileInput;

        var reader = new FileReader();
        reader.onload = function (e) {
          document
            .querySelector('.card[data-id="' + card_id + '"] img')
            .setAttribute(
              "style",
              "background-color: white; background-image: url(" +
                e.target.result +
                "); background-size: contain; background-position: 50% 50%;"
            );
        };

        reader.readAsDataURL(fileInput);
      } else {
        currentFileAccessories[card_id] = "";
      }
    } else if (exist_status == "draft" || exist_status == "uploaded") {
      $('#uploadAccesoryList [data-id="' + card_id + '"]').html(`
                <textarea type="hidden" class="json" hidden>${JSON.stringify(
                  accessory_array
                )}</textarea>
                <input type="hidden" class="image-url" ${fileInput}>
                <div class="accessoryPreview d-flex flex-row">
                    <img src="" width="150">
                    <div class="ms-3">
                        <h6>${accessory_array.name}</h6>
                        <p><b>Model: </b> ${accessory_array.model}</p>
                        <p><b>Price: </b> ${accessory_array.price} ${money}</p>
                    </div>
                </div>
            `);

      if (fileInput !== undefined) {
        if (typeof fileInput != "string") {
          currentFileAccessories[card_id] = fileInput;

          var reader = new FileReader();
          reader.onload = function (e) {
            document
              .querySelector('.card[data-id="' + card_id + '"] img')
              .setAttribute(
                "style",
                "background-color: white; background-image: url(" +
                  e.target.result +
                  "); background-size: contain; background-position: 50% 50%;"
              );
          };

          reader.readAsDataURL(fileInput);
        } else {
          currentFileAccessories[card_id] = fileInput;
          document
            .querySelector('.card[data-id="' + card_id + '"] img')
            .setAttribute(
              "style",
              "background-color: white; background-image: url(" +
                fileInput +
                "); background-size: contain; background-position: 50% 50%;"
            );
        }
      } else {
        document
          .querySelector('.card[data-id="' + card_id + '"] img')
          .setAttribute("style", "");
      }
    } else if (exist_status == "uploaded") {
    }
    resetForm();
  }

  $(document).on("click", "#btnResetAccesory", function () {
    resetForm();
  });

  $(document).on("click", ".accessoryTarget", function () {
    if ($(this).data().item != "") {
      accessory_array = JSON.parse(this.querySelector("textarea").value);

      let unique_id = $(this).data().id;

      $("#accessoyId").data().item = $(this).data().item;
      $("#accessoyId").data().id = $(this).data().id;

      console.log(accessory_array);

      $("#nameProductAcc").val(accessory_array.name);
      $("#modelProductAcc").val(accessory_array.model);
      $("#descriptionProductAcc").val(accessory_array.description);

      $("#image-url").val(
        typeof currentFileAccessories[$(this).data().id] == "string"
          ? currentFileAccessories[$(this).data().id]
          : ""
      );
      console.log(currentFileAccessories);

      $("#weProductAcc").val(accessory_array.weight);
      $("#leProductAcc").val(accessory_array.lengths);
      $("#wiProductAcc").val(accessory_array.width);
      $("#heProductAcc").val(accessory_array.height);

      $("#weProductPaAcc").val(accessory_array.weight_pa);
      $("#leProductPaAcc").val(accessory_array.length_pa);
      $("#wiProductPaAcc").val(accessory_array.width_pa);
      $("#heProductPaAcc").val(accessory_array.height_pa);
      $("#packageTypeAcc").val(accessory_array.pa_type);

      $("#priceProductAcc").val(accessory_array.price);
      $("#currencyAcc").val(accessory_array.currency);

      input_file = currentFileAccessories[unique_id];

      console.log(currentFileAccessories[unique_id]);

      if (input_file != "") {
        if (typeof input_file == "string") {
          document
            .querySelector("#thumbnailAcc")
            .setAttribute(
              "style",
              "background-color: white; background-image: url(" +
                input_file +
                "); position: absolute; width: 100%; height: 100%; background-size: contain; background-position: 50% 50%;"
            );
        } else {
          var reader = new FileReader();
          reader.onload = function (e) {
            document
              .querySelector("#thumbnailAcc")
              .setAttribute(
                "style",
                "background-color: white; background-image: url(" +
                  e.target.result +
                  "); position: absolute; width: 100%; height: 100%; background-size: contain; background-position: 50% 50%;"
              );
          };
          reader.readAsDataURL(input_file);
        }
      } else {
        document.querySelector("#thumbnailAcc").setAttribute("style", "");
      }
    } else if ($(this).data().item != "uploaded") {
      accessory_array = JSON.parse(this.querySelector("textarea").value);
    }
  });

  $(document).on("click", ".btnRemoveAccesory", function () {
    this.parent.data.item = this.parent.data.item == "new" ? "igone" : "delete";
    this.parent.setAttribute("hidden", "");
  });
});
