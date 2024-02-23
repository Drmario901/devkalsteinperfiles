<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=""></script>
    <style>
        td {
            border: 1px solid black;
            margin: 0;
            text-align: center;
            padding: 8px;
        }
    </style>
</head>
    <!-- STORING KALSTEIN CATALOGS INTO THE DATABASE -->
<?php 
    /*require __DIR__.'../../../php/conexion.php';
    require __DIR__.'/../catalogs/upload_kalstein_catalogs.php';*/
?>
    <!-- STORING CATEGORIES -->
<?php 
    /*require __DIR__.'../../../php/conexion.php';
    require __DIR__.'/../catalogs/put_categories.php';*/
?>
    <!-- FETCH PRODUCTS WIHT NO IMAGE OR DESCRIPTION -->
<?php
    /*require __DIR__.'../../../php/conexion.php';

    //$result = $conexion->query("SELECT product_name_en FROM wp_k_products WHERE `product_name_en` LIKE '%otor%' AND product_maker = ''");
    $result = $conexion->query("SELECT product_name_en FROM wp_k_products WHERE `product_name_en` LIKE '%-op%' AND product_maker = '' AND `product_category` = 'Microscope';");
    
    while ($row = $result->fetch_assoc()){
        echo $row['product_name_en'].'<br>';
    }
    */
?>
<!-- FETCH DESCRIPTION AND TABLE -->
<body>
    <input type="number" name="" id="numero">
    <button id='search'>pass</button>
    <div id="result">

    </div>
    <script>
        jQuery(document).ready(function($) {
            $(document).on('click', '#search', function(){

                let name = `fr_09_23/${$('#numero').val()}`;
                
                file = 'es_09_23/Esterilizador Bacti-cinerador.csv';

                console.log(name);
                Pass(name);
                
            });

            function Pass(file){
                // recuperando CSV
                $.ajax({
                    url: `https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/templates-php/retrieve-products-src/${file}`
                })
                .done(function (response){
                    const toJSON = (csv) => { return CSVJSON.csv2json(csv, {parseNumbers: true}) };
    
                    function norm_desc(string){
                        let i = string.indexOf('<table') != -1? string.indexOf('<table') : string.length-1;
    
                        string = string.substring(0, i);
                        string = string.replace((/(\\n)+/g), '<br>');
    
                        const rcoma = (str) => { return str.replace(/;/g,'\\;').replace(/'/g, "\\'")};
    
                        return rcoma(string);
                    }
    
                    function norm_table(string, lista, model){
                        let model_list = Array.from(lista);
    
                        const removeSubstring = (text, startIndex, endIndex) => {
                            if (endIndex < startIndex) {
                                startIndex = endIndex;
                            }
                            var a = text.substring(0, startIndex);
                            var b = text.substring(endIndex);
                            return a + b;
                        }
    
                        let tables = [];
    
                        if(model_list.indexOf(model) != -1){
                            model_list.splice(model_list.indexOf(model), 1);
                        }
    
                        // delete current model form all model list
                        while (string.indexOf('<table') != -1){
                            
                            // recuperando la tabla
                            let i = string.indexOf('<table');
                            let j = string.indexOf('</table>');
                            curren_table = string.substring(i, j+8);
                            curren_table = curren_table.replace((/(\\n)+/g), '');
    
                            // reemplazando las llaves {} y lo que tengan dentro
                            let key_parentesis = curren_table.match(/({.+?})+/g);
                            if(key_parentesis != null){
                                for (let p of key_parentesis){
                                    curren_table = curren_table.replace(p, '');
                                }
                            }
    
                            // eliminandola del total
                            string = removeSubstring(string, i, j+8);
    
                            // sombreando los demas modelos
                            if (curren_table.indexOf(model) != -1){
                                curren_table = curren_table.replace(model, '<b style="color: #213280">' + model + '<br> <small>(current)</small></b>');
                            }
    
                            for (let mod of model_list){
                                if(curren_table.indexOf(mod) != -1){
                                    curren_table = curren_table.replace(mod, '<span style="font-weight: normal">' + mod + '</span>');
                                }
                            }
    
                            // añadiendo al total
                            tables.push(curren_table);
                        }
    
                        const rcoma = (str) => { return str.replace().replace(/'/g, "\\'")};
    
                        return rcoma(tables.join('<br>'));
                    }
    
                    let data_product = [[]];
                    let batch = 0;

                    let key_parentesis = response.match(/({.+?})+/g);
                    if(key_parentesis != null){
                        for (let p of key_parentesis){
                            response = response.replace(p, '');
                        }
                    }

                    key_parentesis = response.match(/(style="".+?"")+/g);
                    if(key_parentesis != null){
                        for (let p of key_parentesis){
                            response = response.replace(p, '');
                        }
                    }

                    response = response.replace(/;"/g, '"');
    
                    console.log(toJSON(response));
                    console.log(toJSON(response).length);
                    
                    for (let i = 0; i < toJSON(response).length; i++){
                        
                        if (i >= batch * 10 + 10){
                            console.log('batch ' + batch);
                            data_product.push([]);
                            batch++;
                        }
    
                        let product = toJSON(response)[i];
                        let model_list = product['Attribute 1 value(s)']? product['Attribute 1 value(s)'].split(',') : [''];
    
                        for (let j = 0; j < model_list.length; j++){
                            model_list[j] = model_list[j].trim().split(' ')[0].replace('(', '').replace(')', '').replace('SS', ' (SS)');
                        }
    
                        if (model_list[0] == '' || model_list[0] == null) {
                            let model_for_name = product.Name.split(' ');
    
                            for (let word of model_for_name){
                                if(word.startsWith('YR')){
                                    model_list[0] = word;
                                    break;
                                }
                            }
                        }
                        
                        for (let mod of model_list){
    
                            if(product.Description != '' && product.Description != null){
                                let data = {
                                    model : mod,
                                    description : norm_desc(product.Description),
                                    table : norm_table(product.Description, model_list, mod)
                                }
                                data_product[batch].push(data);
                            }
                        }
                    }
    
                    for (let b in data_product){

                        $.ajax({
                            url : 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/templates-php/save-description.php',
                            method : 'POST',
                            data : {data_product : data_product[b], batch: b}
                        })
                        .done(function(response2){
                            console.log(response2);
                        });
                    }
                })
                .fail(function() {
                    console.log('algo falló');
                });
            }
        });
    </script>
</body>
</html>