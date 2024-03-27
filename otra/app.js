const btn = document.getElementById('boton-click');
btn.addEventListener('click', function() {
  window.alert('hola');
  btn.disabled = true;
});