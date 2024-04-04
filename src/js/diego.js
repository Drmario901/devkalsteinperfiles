jQuery(document).ready(function($){
    $(document).on('click', '#hola', function (){
        console.log('hola');
        
        iziToast.success({
            title : 'Success',
            message : 'hola',
            position: 'center'
          });
    });

});