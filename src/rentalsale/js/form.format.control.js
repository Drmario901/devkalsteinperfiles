jQuery(document).ready(function($){
    var fields = [
        {field : $('#stockProduct') , decimals : 0},
        {field : $('#weProduct') , decimals : 2},
        {field : $('#wiProduct') , decimals : 2},
        {field : $('#heProduct') , decimals : 2},
        {field : $('#leProduct') , decimals : 2},
        {field : $('#weProductPa') , decimals : 2},
        {field : $('#wiProductPa') , decimals : 2},
        {field : $('#heProductPa') , decimals : 2},
        {field : $('#leProductPa') , decimals : 2},
        {field : $('#discount1') , decimals : 0},
        {field : $('#discount1Amount') , decimals : 2},
        {field : $('#discount2') , decimals : 0},
        {field : $('#discount2Amount') , decimals : 2},
        {field : $('#priceProduct') , decimals : 2},
        {field : $('#country-aerial-weigth') , decimals : 2},
        {field : $('#country-aerial-price') , decimals : 2},
        {field : $('#country-maritimal') , decimals : 2},
        {field : $('#quantity') , decimals : 0}
    ];

    fields.forEach(function (row){
        row.field.on('focusout', function(event) {

            // acota a dos decimales
            let value = Math.floor(parseFloat($(this).val()) * (10**row.decimals)) / (10**row.decimals);

            $(this).val(value);
        });
    });
});
