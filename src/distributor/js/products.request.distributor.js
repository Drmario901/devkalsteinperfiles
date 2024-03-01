let plugin_dir = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/';
let domain = 'https://dev.kalstein.plus/plataforma/index.php/';


jQuery(document).ready(function($){
  products()


  function products(consulta){
      $.ajax({
          url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/getProducts.php',
          type: 'POST',
          data: {consulta},
      })
      .done(function(respuesta){
          $('#dataProducts').html(respuesta)
      })
      .fail(function(){
          console.log("error")
      })
  }
})


jQuery(document).ready(function($){
  categorys()


  function categorys(consulta){
      $.ajax({
          url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/categoryProducts.php',
          type: 'POST',
          data: {consulta},
      })
      .done(function(respuesta){
          $('#dataCategory').html(respuesta)
          console.log(respuesta)
      })
    
      .fail(function(){
          alert(respuesta)
      })
      .fail(function(){
          console.log("error")
      })
  }
})


jQuery(document).ready(function($) {
$(document).on('click', '#btnSendData', function(e) {
  var fileInput = $('#file-input')[0].files[0];
  var name = $('#nameProduct').val();
  var description = $('#descriptionProduct').val();
  var category = $('#dataCategory').val();
  var weight = $('#weProduct').val();
  var stock = $('#stockProduct').val();
  var length = $('#leProduct').val();
  var width = $('#wiProduct').val();
  var height = $('#heProduct').val();
  var status = $('#statusProduct').val();
  var price = $('#priceProduct').val();


  if (fileInput === undefined) {
    iziToast.error({
      title: 'Error',
      message: 'Add an image to save the product.',
      position: 'center'
    });
  } else if (name === '') {
    iziToast.error({
      title: 'Error',
      message: 'Name empty',
      position: 'center'
    });
  } else if (description === '') {
    iziToast.error({
      title: 'Error',
      message: 'Description empty',
      position: 'center'
    });
  } else if (category === '') {
    iziToast.error({
      title: 'Error',
      message: 'Category empty',
      position: 'center'
    });
  } else if (weight === '') {
    iziToast.error({
      title: 'Error',
      message: 'Weight empty',
      position: 'center'
    });
  } else if (stock === '') {
    iziToast.error({
      title: 'Error',
      message: 'Stock empty',
      position: 'center'
    });
  } else if (length === '') {
    iziToast.error({
      title: 'Error',
      message: 'Length empty',
      position: 'center'
    });
  } else if (width === '') {
    iziToast.error({
      title: 'Error',
      message: 'Width empty',
      position: 'center'
    });
  } else if (height === '') {
    iziToast.error({
      title: 'Error',
      message: 'Height empty',
      position: 'center'
    });
  } else if (status === '') {
    iziToast.error({
      title: 'Error',
      message: 'Status empty',
      position: 'center'
    });
  } else if (price === '') {
    iziToast.error({
      title: 'Error',
      message: 'Price empty',
      position: 'center'
    });
  } else {
    
    var maxSize = 10 * 1024 * 1024; // 10 MB
    var allowedTypes = ['image/jpeg', 'image/png'];
    var fileType = fileInput.type;


    if (fileInput.size > maxSize) {
      iziToast.error({
        title: 'Error',
        message: 'The file size exceeds the limit of 10 MB.',
        position: 'center'
      });
    } else if (!allowedTypes.includes(fileType)) {
      iziToast.error({
        title: 'Error',
        message: 'Only JPG, PNG, and JPEG files are allowed.',
        position: 'center'
      });
    } else {
      savedDataUpload(name, description, category, weight, stock, length, width, height, status, price, fileInput);
    }
  }
});


function savedDataUpload(name, description, category, weight, stock, length, width, height, status, price, image) {
  var formData = new FormData();
  formData.append('name', name);
  formData.append('description', description);
  formData.append('category', category);
  formData.append('we', weight);
  formData.append('stock', stock);
  formData.append('le', length);
  formData.append('wi', width);
  formData.append('he', height);
  formData.append('status', status);
  formData.append('price', price);
  formData.append('fileName', image);


  $.ajax({
    contentType: "multipart/form-data",
    url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/uploadDataForm.php',
    type: 'POST',
    data: formData,
    dataType: 'text',
    processData: false,
    contentType: false,
    cache: false,
    success: function(response) {
      console.log(response);
      iziToast.success({
        title: 'Success',
        message: 'The data has been successfully uploaded.',
        position: 'center'
      });
      window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/distributor/stock';
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
}
});


jQuery(document).ready(function($) {
$(document).on('click', '#btnUpdateData', function(e) {
    var fileInput = $('#file-input')[0].files[0];
    var id = $('#dataEdit').val();
    var name = $('#name').val();
    var description = $('#description').val();
    var category = $('#dataCategory').val();
    var weight = $('#weight').val();
    var stock = $('#stock').val();
    var length = $('#lenght').val();
    var width = $('#width').val();
    var height = $('#height').val();
    var status = $('#status').val();
    var price = $('#price').val();


  if (name === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty name',
      position: 'center'
    });
  } else if (description === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty description',
      position: 'center'
    });
  } else if (category === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty category',
      position: 'center'
    });
  } else if (weight === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty weight',
      position: 'center'
    });
  } else if (stock === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty stock',
      position: 'center'
    });
  } else if (length === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty length',
      position: 'center'
    });
  } else if (width === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty width',
      position: 'center'
    });
  } else if (height === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty height',
      position: 'center'
    });
  } else if (status === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty status',
      position: 'center'
    });
  } else if (price === '') {
    iziToast.error({
      title: 'Error',
      message: 'Empty price',
      position: 'center'
    });
  } else {


    iziToast.question({
      title: 'Confirmation',
      message: 'Are you sure you want to edit the product?',
      position: 'center',
      buttons: [
        ['<button><b>Yes</b></button>', function (instance, toast) {
          instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        
          var maxSize = 10 * 1024 * 1024; // 10 MB
          var allowedTypes = ['image/jpeg', 'image/png'];
          var fileType = fileInput ? fileInput.type : null;


          if (fileInput && fileInput.size > maxSize) {
            iziToast.error({
              title: 'Error',
              message: 'The file size exceeds the limit of 10 MB.',
              position: 'center'
            });
          } else if (fileInput && !allowedTypes.includes(fileType)) {
            iziToast.error({
              title: 'Error',
              message: 'Only JPG, PNG, and JPEG files are allowed.',
              position: 'center'
            });
          } else {
            updateDataUpload(id, name, description, category, weight, stock, length, width, height, status, price, fileInput);
          }
        }, true], 
        ['<button>No</button>', function (instance, toast) {
          instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        }]
      ]
    });
  }
});


function updateDataUpload(id, name, description, category, weight, stock, length, width, height, status, price, image) {
  var formData = new FormData();
  formData.append('id', id);
  formData.append('name', name);
  formData.append('description', description);
  formData.append('category', category);
  formData.append('we', weight);
  formData.append('stock', stock);
  formData.append('le', length);
  formData.append('wi', width);
  formData.append('he', height);
  formData.append('status', status);
  formData.append('price', price);
  
  if (image) {
    formData.append('fileName', image);
  }


  $.ajax({
    contentType: "multipart/form-data",
    url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/updateStatus.php',
    type: 'POST',
    data: formData,
    dataType: 'text',
    processData: false,
    contentType: false,
    cache: false,
    success: function(response) {
      console.log(response);
      iziToast.success({
        title: 'Success',
        message: 'Data updated successfully.',
        position: 'center'
      });
      window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/distributor/stock';
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
}
});






jQuery(document).ready(function($){
productsTable();


$(document).on('click', '#btnDeleteProduct', function(){
  let valor = $(this).val();


  iziToast.question({
    title: 'Confirmation',
    message: 'Are you sure you want to delete the product?',
    close: false,
    overlay: true,
    timeout: false,
    position: 'center',
    buttons: [
      ['<button><b>Yes</b></button>', function (instance, toast) {
        productsTable(valor);
        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        iziToast.success({
          title: 'Success',
          message: 'Product deleted.',
          position: 'center'
        });


      }, true],
      ['<button>No</button>', function (instance, toast) {
        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        iziToast.error({
          title: 'Error',
          message: 'Product delete canceled.',
          position: 'center'
        });
      }]
    ]
  });
});


function productsTable(delete_aid){
  $.ajax({
    url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/deleteProduct.php',
    type: 'POST',
    data: {delete_aid},
  })
  .done(function(respuesta){
    $('#product-data').html(respuesta);
  })
  .fail(function(){
    console.log("error");
  });
}
});



jQuery(document).ready(function($){
imageView();


$(document).on('click', '#btnView', function(){
    let image = $(this).val();
    showImage(image);
});



function showImage(image) {
    let imageUrl = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/' + image;


    iziToast.show({
        title: '',
        message: '<img src="' + imageUrl + '" style="max-width: 400px; max-height: 400px; width: auto; height: auto; display: block; margin: 0 auto;">',
        close: true,
        imageAlt: 'Image',
        onClosing: function(instance, toast, closedBy){
        }
    });
}


function imageView(){
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/productTable.php',
        type: 'POST',
        dataType: 'html',
    })
    .done(function(respuesta){
        $('#product-data').html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}
});


jQuery(document).ready(function($){
allProductsCount()


function allProductsCount(consulta){
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/allProducts.php',
        type: 'POST',
        data: {consulta},
    })
    .done(function(respuesta){
        $('#productsCount').html(respuesta)
    })
    .fail(function(){
        console.log("error")
    })
}
})


jQuery(document).ready(function($){
allOrdersCount()


function allOrdersCount(consulta){
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/allOrders.php',
        type: 'POST',
        data: {consulta},
    })
    .done(function(respuesta){
        $('#productsOrdersCount').html(respuesta)
    })
    .fail(function(){
        console.log("error")
    })
}
})



jQuery(document).ready(function($) {


$(document).on('click', '.btn-update', function() {
  var id = $(this).val();
  var selectedStatus = $(this).siblings('.status-select').val();
  var customerName = $(this).closest('tr').find('.customer-name').text();
  if (selectedStatus != ''){


    iziToast.question({
        timeout: false,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Confirmation',
        message: 'Are you sure you want to change the status for ' + customerName + '?',
        position: 'center',
        buttons: [
        ['<button><b>Yes</b></button>', function(instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            quoteUpdateStatus(id, selectedStatus, customerName);
        }, true],
        ['<button>No</button>', function(instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        }]
        ],
        onClosing: function(instance, toast, closedBy) {
            console.log('Closing...');
        },
        onClosed: function(instance, toast, closedBy) {
            console.log('Closed...');
        }
    });
}
else{
    iziToast.warning({
        title: 'Warning',
        message: 'Please select an option!',
        position: 'topRight',
    });
}
});



function quoteUpdateStatus(cotizacion_id, cotizacion_status, customerName) {
  $.ajax({
    url: plugin_dir + 'php/distributor/updateStatus.php',
    method: 'POST',
    data: {
      cotizacion_id,
      cotizacion_status
    },
  })
    .done(function(respuesta) {
      console.log(respuesta);
      let data = JSON.parse(respuesta);
      if (data.update === 'correcto') {
        iziToast.success({
          title: 'Success',
          message: 'Update successful!',
          position: 'topRight',
          timeout: 1500,
          onClosing: function(instance, toast, closedBy) {
          } 
        });
        window.location.href = domain + 'list-order/?i=' + $('#hiddenPage').val();
      }
    })
    .fail(function() {
      console.log("error");
    });


}



$(document).on('click', '#prevPage', function() {
  var page = $(this).data('page');
  if (page > 1) {
    loadQuotes(page - 1);
  }
});


$(document).on('click', '#nextPage', function() {
  var page = $(this).data('page');
  loadQuotes(page + 1);
});


function loadQuotes(page) {
  $.ajax({
    url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/quotes.php',
    method: 'POST',
    data: { page },
  })
    .done(function(respuesta) {
      $('#quoteTable').html(respuesta);
    })
    .fail(function() {
      console.log("error");
    });
}


});




jQuery(document).ready(function($) {
var page = 1; 


quoteProcessed();


function quoteProcessed() {
  $.ajax({
    url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/quoteProcessed.php',
    type: 'POST',
    data: { page: page }, 


    success: function(response) {
      $('#listOrderProcessedTable').html(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}


$(document).on('click', '#prevPage', function() {
  if (page > 1) {
    page--;
    quoteProcessed();
  }
});


$(document).on('click', '#nextPage', function() {
  page++;
  quoteProcessed();
});
});


jQuery(document).ready(function($) {
var page = 1;


quoteCancelled();


function quoteCancelled() {
  $.ajax({
    url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/quoteCancelled.php',
    type: 'POST',
    data: { page: page },


    success: function(response) {
      $('#listOrderCancelledTable').html(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}


$(document).on('click', '#prevPage', function() {
  if (page > 1) {
    page--;
    quoteCancelled();
  }
});


$(document).on('click', '#nextPage', function() {
  page++;
  quoteCancelled();
});
});


jQuery(document).ready(function($){
allOrdersCardCount()


function allOrdersCardCount(consulta){
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/allOrdersCard.php',
        type: 'POST',
        data: {consulta},
    })
    .done(function(respuesta){
        $('#productsOrdersCardCount').html(respuesta)
        console.log(respuesta);
    })
    .fail(function(){
        console.log("error")
    })
}
})


jQuery(document).ready(function($){
allPendingCardCount()


function allPendingCardCount(consulta){
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/allPendingCard.php',
        type: 'POST',
        data: {consulta},
    })
    .done(function(respuesta){
        $('#productsPendingCardCount').html(respuesta)
    })
    .fail(function(){
        console.log("error")
    })
}
})


jQuery(document).ready(function($){
allPendingCirculatorCount()


function allPendingCirculatorCount(consulta){
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/allPendingCirculator.php',
        type: 'POST',
        data: {consulta},
    })
    .done(function(respuesta){
        $('#productsPendingCount').html(respuesta)
    })
    .fail(function(){
        console.log("error")
    })
}
})


/*jQuery(document).ready(function($) {
  $(document).on('click', '.btn-details', function() {


      var quote_id = $(this).val();


      $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/cotizacionInfo.php',
          method: 'POST', 
          data: {quote_id}
      })
      .done(function (response){
        console.log(response);
          let res = JSON.parse(response);
          res.forEach(elem => {
              productName = elem.product_name;
              productModel = elem.product_model;
              productQuantity = elem.product_quantity;
              productImage = elem.product_image;
              
              var details = 'Product Name: ' + productName + '<br>' +
                            'Product Model: ' + productModel + '<br>' +
                            'Quantity: ' + productQuantity + '<br>' +
                            'Image: <img style="max-width: 200px;" src="' + productImage + '">';
    
              iziToast.show({
                  title: 'Quote Details (ID: ' + quote_id + ')',
                  message: details,
                  position: 'center',
                  timeout: false,
                  closeOnClick: true,
                  progressBar: false
              });
          });


          



      })
      .fail();


      
 
    });
});*/






