jQuery(document).ready(function($){

    let price = $('#price').val();
    let curr = $('#curr').val();

    let disc1 = $('#disc1').val();
    let disc1a = $('#disc1a').val();
    let disc2 = $('#disc2').val();
    let disc2a = $('#disc2a').val();

    function twoDec(n){
        return Math.floor(parseFloat(n) * 100) / 100;
    }

    
    $(document).on('keyup', '#quantity', function(){

        let gross_price = 0;
        let disc = 0;
        let result = 0;
        let str = '';
        let quan = parseInt($(this).val());

        
        gross_price = quan * price;
        
        if(quan >= disc2a){
            disc = gross_price * disc2 / 100;
        }
        else if(quan >= disc1a){
            disc = gross_price * disc1 / 100;
        }

        result = gross_price - disc;

        str = " = " + twoDec(gross_price) + " <small>gross price</small> - " + twoDec(disc) + " <small>wholesale discount</small><br>= " + twoDec(result) + " " + curr;

        $('#quantity-result').html(str);
    });
});
