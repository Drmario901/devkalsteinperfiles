$(function(){
    
    
    console.log('Jquery esta funcionando correctamente');
    
    /*Ambito de variables globales y declaracion de funciones*/
    
    var prodsCliente;                          //Array de todos los productos del cliente
    
    //Contenido que se mostrara cuando no existan productos registrados
    var HTMLVoidProds = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">error</span></p><p><small data-i18n="client:noHasRegistradoProductos">Parece que aun no has registrado productos</small></p><br><br><br><br><br><br></div>';
    
    //COntenido que se mostrara cuando ocurra un fallo en la peticion 
     var HTMLFailRequest = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">gpp_bad</span></p><p><small data-i18n="client:errorConexion">Ha habido un error de conexion</small></p><br><br><br><br><br><br></div>';
    
    var filtroUser = $('#username').text().trim();   //Nombre de usuario para filtrar la peticion
    
    //Obtener productos registrados
    function getClientDevices(){
        
        /*Pedir productos al servidor*/
        $.post('getProdsClient.php',{username:filtroUser},function(response){ 
            
            //Casos para la respuesta
            switch (response) {
                    
                  case "VOID":
                    //Si el cliente no tiene productos registrados
                    $('#contentprods').html(HTMLVoidProds);
                  break;
                  
                  case "FAIL":
                    //Si ocurre una falla al hacer la peticion POST
                    $('#contentprods').html(HTMLFailRequest);
                  break;
                  
                  default:
                    
                    prodsCliente = JSON.parse(response);
                    
                    console.log(prodsCliente);
                    console.log(prodsCliente.length);
                    
                    if(prodsCliente.length<1){
                        
                        //Si el cliente no tiene productos registrados
                        $('#contentprods').html(HTMLVoidProds);
                       
                    }else{
                        
                        //Iniciar la primera fila
                        var listaHTMLProdsCliente = '<div class="row">';
                        
                        //Cuenta de columnas
                        var nCols = 1;
                        
                        //Cuenta de filas
                        var nRows = 1;
                        
                        //Cuenta de vueltas
                        var nElements = 1;
                        
                        prodsCliente.forEach(function(prodsCliente,index){
                            
                            //Se va creando de columna en columna; al llegar a 3
                            //columnas se agrega una fila y se reinicia el contador 
                            //de columnas
                            if(nCols<=3){
                                
                                //1.Agregar la nueva columna
                                listaHTMLProdsCliente += '<div class="col p-2"><div class="d-flex justify-content-center"><div class="card shadow" style="width: 18rem;"><img src="'+prodsCliente.imglink+'" class="img-fluid" alt="..."><div class="card-body"><p class="lead">'+prodsCliente.modelo+'</p><p><small>'+prodsCliente.uid+'</small></p><div class="d-grid gap-2"><a href="#" uid='+prodsCliente.uid+' class="btndiag btn btn-primary active bg-kalstein" role="button" aria-pressed="true"><span class="bottom-icon material-symbols-outlined">build</span data-i18n="client:diagnosticar">Diagnosticar</a></div></div></div></div></div>';
                                
                                //Se incrementa solo si hay siguiente elemento
                                //nCols++;
                                
                               
                            }else{
                                
                                //Se incrementa solo si hay siguiente elemento
                                nCols++;
                                
                                if(index==prodsCliente.length-1){
                                    
                                    //Si se llego al final del array solo cerrar la fila
                                    listaHTMLProdsCliente += '</div>'
                                    
                                }else{
                                    
                                    //Reiniciar la cuenta de columnas a 0
                                    //y Cerrar la fila y abrir nueva fila
                                    nCols = 1;
                                    listaHTMLProdsCliente += '</div><div class="row">';
                                    
                                }
                                
                                
                                
                                
                            }

                        });
                        
                        $('#contentprods').html(listaHTMLProdsCliente);
                        
                    }
                    
                    
                  break;
                    
            
            }
        
        })
        
        
    }
    
    //Obtener UID de producto y enviar orden de diagnostico
    $(document).on('click','.btndiag', function(){
        
        let elemento = $(this)[0];
        var uidSelec = $(elemento).attr('uid');
        /*console.log(elemento);
        console.log('clickeado');
        console.log("El UID SELCCIONADO ES: "+uidSelec);*/
        
        window.location = "index.php?pag=diag&uid="+uidSelec;
        
        
    });
    
    //Ambito de ejecucion de funciones
    console.log(filtroUser);
    getClientDevices();
    
})