let btn = document.getElementById('btnEndingClient');
    
btn.addEventListener('click', function() {
    // Desactiva el botón
    this.disabled = true;
    window.alert('activando');
    // Actualiza el botón para incluir el spinner y cambia el texto
    this.innerHTML = ' <div class="spinner"></div>';
    
    // Simula una operación asíncrona con setTimeout
    setTimeout(() => {
        this.innerHTML = 'Finalizar'; // Restablece el texto original del botón
        this.disabled = false; // Reactiva el botón
    }, 3000);
});