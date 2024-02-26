function addInputLimiters(){
    var fields = [
        {field : '.i-cant' , decimals : 0},
    ];
    
    fields.forEach(function (row){
        document.querySelector(row.field).addEventListener('focusout', function(event) {
            
            // acota a dos decimales
            let value = Math.floor(parseFloat($(this).val())  (10*row.decimals)) / (10*row.decimals);
            
            value = value <= 1? 1 : value;
            
            $(this).val(value);
        }, {once: true});
    });
}

jQuery(document).ready(function($){
    $(document).on('focusout', '.i-cant', function(){

        let value = Math.floor(parseFloat($(this).val()));
            
        value = value <= 1 || isNaN(value)? 1 : value;
        
        $(this).val(value);
    });
});
