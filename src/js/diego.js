let boton = document.getElementById('#hola');

boton.addEventListener('click', function() {
    iziToast.success({
        title : 'Success',
        message : 'hola',
        position: 'center'
      });
})