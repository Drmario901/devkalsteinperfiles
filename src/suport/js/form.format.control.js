jQuery(document).ready(function($){
    var fields = [
        {field : $('#weProduct') , decimals : 2},
        {field : $('#wProduct') , decimals : 2},
        {field : $('#heProduct') , decimals : 2},
        {field : $('#leProduct') , decimals : 2},
        {field : $('#priceProduct') , decimals : 2},
        {field : $('#stockProduct') , decimals : 0}
    ];    

    fields.forEach(function (row){
        row.field.on('focusout', function(event) {

            // acota a dos decimales
            let value = Math.floor(parseFloat($(this).val()) * (10**row.decimals)) / (10**row.decimals);

            $(this).val(value);
        });
    });
});
