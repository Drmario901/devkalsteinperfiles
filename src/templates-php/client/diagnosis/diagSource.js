$(function(){
    
    
    console.log("Jquery esta funcionando");
    
    var contentHTMLWait = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">pending</span></p><p><small>Por favor espere...</small></p><br><br><div class="progress centerDiv" style="width:350px;"><div class="progress-bar" id="bar" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div></div><br><br><br><br></div>';
    
    var contentHTMLServerFail = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">cloud_off</span></p><p><small>Falla de servidor</small></p><br><br><br><br><br><br></div>';
    
    var contentHTMLuidNotValid = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">gpp_bad</span></p><p><small>UID invalido</small></p><br><br><br><br><br><br></div>';
    
    var contentHTMLVoidPOST = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">error</span></p><p><small>UID vacio</small></p><br><br><br><br><br><br></div>';
    
    var contentHTMLUnknown = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">unknown_document</span></p><p><small>Algo ha ido mal</small></p><br><br><br><br><br><br></div>';
    
    var contentHTMLStartDenied = '<div style="text-align:center; margin-left:auto; margin-right:auto"><br><br><br><br><br><br><p><span style="font-size:50px;" class="bottom-icon material-symbols-outlined">block</span></p><p><small>Ya se esta ejecutando un diagnostico</small></p><br><br><br><br><br><br></div>';
    
    var filtrouid = $('#uidprod').text().trim();
    
    var flag;       //indica si se inicio el diagnostico para comenzar la cuenta de espera
    
    var levelProgress; //Nivel de progreso del diagnostico
    
    var countProg = 10;
    
    //Enviar orden de diagnostico
    function startDiag(){
        
        //Enviar orden de diagnostico y verificacion de validez del UID
         $.post('startDiag.php',{uid:filtrouid},function(response){
             
             switch(response){
                     
                 case "VOID":
                     //Variable POST uid vacia
                     $('#contentdiag').html(contentHTMLVoidPOST);
                 break;
                     
                 case "FAIL_SERVER":
                     //Falla de servidor
                     $('#contentdiag').html(contentHTMLServerFail);
                 break;
                     
                 case "NOT_VALID":
                     //UID invalido
                     $('#contentdiag').html(contentHTMLuidNotValid);
                     
                 break;
                 
                 case "DENIED":
                     //Ya se esta ejecutando un diagnostico, debe esperar que se finalice
                     $('#contentdiag').html(contentHTMLStartDenied);
                 break;
                 
                 case "OK":
                     //Orden de inicio enviada
                     $('#contentdiag').html(contentHTMLWait);
                     flag = true;
                     console.log(flag);
                 break;
                 
                 default:
                     $('#contentdiag').html(contentHTMLUnknown);
                    console.log(response);
                 break;
                     
             }
             
             
         });
        
        
    }
    
    //Comprobar si se termino el diagnostico
    function isDiagFinished(){
        
        if(flag){
            
            $.post('isDiagFinished.php',{uid:filtrouid},function(response){
            
            switch(response){
                    
                case "WAIT":
                    flag=true;
                    if(countProg<345){
                       countProg+=20;
                    }else{
                       countProg=10;
                    }
                    
                    console.log("Waiting...");
                    console.log(countProg);
                    $('.progress-bar').width(countProg);
                    
                break;
                
                default:
                    //Resistencia:OK,Electrovalvula:FAIL
                    $('.progress-bar').width(345);
                    flag=false;
                    
                    console.log(response);
                    
                    var filasDiagnostico = response.split(',');
                    
                    if(response.includes("FAIL")){
                        
                        //Almenos 1 elemento esta malo
                        var HTMLcontentWRONG = '<div class="centerDiv"><span style="font-size:90px;" class="bottom-icon material-symbols-outlined">dangerous</span><p>Algunos componentes estan fallando</p></div><br><div class="card centerDiv" style="width: 18rem;"><ul class="list-group list-group-flush">';
                        
                         filasDiagnostico.forEach(function(filasDiagnostico,index){
                             
                             
                             //Verificar que se terminaron los elementos
                             if(index==filasDiagnostico.length){
                                 
                                 //Verificar si el ultimo elemento a agregar esta bueno o malo y cerrar lista
                                if(filasDiagnostico.includes("FAIL")){
                                 
                                 //Añadir el elemento con fondo rojo 
                                 HTMLcontentWRONG += '<li class="list-group-item bg-danger text-light">'+filasDiagnostico+'</li></ul></div>';
                                     
                                }else{
                                  
                                 //Añadir el elemento con fondo verde 
                                 HTMLcontentWRONG += '<li class="list-group-item bg-success text-light">'+filasDiagnostico+'</li></ul></div>';
                                 
                                }
                                 
                                 
                             }else{
                                 
                                 //Verificar si el elemento a agregar esta bueno o malo
                                if(filasDiagnostico.includes("FAIL")){
                                 
                                 //Añadir el elemento con fondo rojo 
                                 HTMLcontentWRONG += '<li class="list-group-item bg-danger text-light">'+filasDiagnostico+'</li>';
                                     
                                }else{
                                  
                                 //Añadir el elemento con fondo verde 
                                 HTMLcontentWRONG += '<li class="list-group-item bg-success text-light">'+filasDiagnostico+'</li>';
                                 
                                }
                             
                                 
                                 
                             }
                             
                             
                             
                             
                         });
                        
                        //Mostrar el diagnostico
                        $('#contentdiag').html(HTMLcontentWRONG);
                        
                    }else{
                        
                        //Todos los componentes estan buenos
                        var HTMLcontentFINE = '<div class="centerDiv"><span style="font-size:90px; color:green;" class="bottom-icon material-symbols-outlined">new_releases</span><p>Todo parece ir correctamente</p></div><br><div class="card centerDiv" style="width: 18rem;"><ul class="list-group list-group-flush">';
                        
                        filasDiagnostico.forEach(function(filasDiagnostico,index){
                             
                             if(index==filasDiagnostico.length-1){
                                
                                 //Añadir el ultimo elemento y cerrar la lista
                                 HTMLcontentFINE+='<li class="list-group-item bg-success text-light">'+filasDiagnostico+'</li></ul></div>';
                                 
                                 
                                 
                                }else{
                                    
                                //Seguir agregando los elementos
                                HTMLcontentFINE+='<li class="list-group-item bg-success text-light">'+filasDiagnostico+'</li>';

                             }
                             
                            
                        });
                        
                        //Mostrar el diagnostico
                        $('#contentdiag').html(HTMLcontentFINE);
                    }
                    
                    
                break;
                    
            }
            
        });
           
        }
        
        
        
        
    }
    
    startDiag();
    
    
    setInterval(isDiagFinished,2000);
        
    
    
    
    
})