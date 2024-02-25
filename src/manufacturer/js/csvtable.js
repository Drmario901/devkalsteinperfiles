function json2rawhtml(json, hasheaders = false){
    if (json != ''){

        let output = '';
        let keys = Object.keys(json[0]);
        
        if (hasheaders){

            output += '<thead class="headTableForQuote"><tr>';
            for (let key of keys){
                output += `<th class="fw-bold">${key}</th>`;
            }
            output += '</tr></thead><tbody class="bodyTableForQuote">';
        }
        else{
            output += '<tbody class="bodyTableForQuote"><tr>';
            for (let key of keys){
                if(key == keys[0]){
                    output += `<td>${key}</td>`;
                }
                else {
                    output += `<td>${key}</td>`;
                }
            }
            output += '</tr>';
        }

        if (json[0] != null){
            for (let i = 0; i < json.length; i++){
                let row = json[i];

                output += '<tr>';
                for (let key of keys){
                    if(key == keys[0]){
                        output += `<td>${row[key]}</td>`;
                    }
                    else {
                        output += `<td>${row[key]}</td>`;
                    }
                }
                output += '</tr>';
            }
        }
        output += '</tbody>';
        
        return output.toString();
    }
    else {
        return '';
    }
}

// READ TABLE AND GET CSV
function csvFromBasicTable(){

    let keys = [];
    let values = [];

    for (let elem of document.querySelector('#stock-table-keys').children){
        keys.push(elem.firstChild.value);
    }    
    for (let elem of document.querySelector('#stock-table-values').children){
        values.push(elem.firstChild.value);
    }

    let json = [];

    let json_header_key = keys[0];
    let json_header_value = values[0];

    for(let i = 1; i < keys.length; i++){
        let i_json = {};

        i_json[json_header_key] = keys[i];
        i_json[json_header_value] = values[i];

        json.push(i_json);
    }

    let csv = CSVJSON.json2csv(json, {separator: '\t'});

    return csv;
}

// EXCEL TABLE

jQuery(document).ready(function($){
    $(document).on('change', '#has_headers', function(){
        if($('#csv').val() != '' && $('#csv').val() != 'example'){
            previewcsv2html();
        }
        else {
            if($('#csv').val() != 'example'){
                $('#resultTable').html(`
                    <div class='alert alert-danger'>
                        Not valid table
                    </div>
                `);
            }
        }
    });

    function previewcsv2html(){
        let csv = $('#csv').html();
        let json = CSVJSON.csv2json(csv, {parseNumbers: true});
        let table = $('#resultTable');
        let has_headers = document.querySelector('#has_headers').checked;

        table.html(json2rawhtml(json, has_headers));
    }

    $(document).on('click', '#stock-basic-editor', function(){
        $('#stock-basic-table').removeAttr('hidden');
        $('#stock-excel-table').attr('hidden', '');

        $(this).addClass('selected');
        $('#stock-excel-editor').removeClass('selected');
        $('#stock-ignore-table').removeClass('selected'); 

        $('#table-mode').val('basic');
    });
    
    $(document).on('click', '#stock-excel-editor', function(){
        $('#stock-excel-table').removeAttr('hidden');
        $('#stock-basic-table').attr('hidden', '');
        
        $(this).addClass('selected');
        $('#stock-basic-editor').removeClass('selected'); 
        $('#stock-ignore-table').removeClass('selected'); 

        $('#table-mode').val('excel');
    });
    
    $(document).on('click', '#stock-ignore-table', function(){
        $('#stock-excel-table').attr('hidden', '');
        $('#stock-basic-table').attr('hidden', '');
        
        $(this).addClass('selected');
        $('#stock-basic-editor').removeClass('selected');
        $('#stock-excel-editor').removeClass('selected');

        $('#table-mode').val('ignore');
    });

    // CLIPBOARD PASTING
    $(document).on('click', '#paste-excel-clipboard', function(){
        navigator.clipboard.readText()
        .then(text => {
            let csv = text;
            let json = CSVJSON.csv2json(csv, {parseNumbers: true});
            $('#csv').html(csv);
            console.log($('#csv').html())
            previewcsv2html();

            if(json.length == 0){
                $('#resultTable').html(`
                    <div class='alert alert-danger'>
                        Not valid table
                    </div>
                `);
                $('#csv').html('');
            }
        })
        .catch(err => {
            console.error('Error al leer del portapapeles:', err);
        });
    });

    // ADD AND REMOVE INPUTS
    $(document).on('click', '#stock-table-button-plus', function(e){
        e.preventDefault();

        let count = document.querySelector('#stock-table-keys').childElementCount;

        $('#stock-table-keys').append(`
            <div><input id="table-keys-${count+1}" type="text" value=""></div>
        `);
        $('#stock-table-values').append(`
            <div><input id="table-values-${count+1}" type="text" value=""></div>
        `);
    });
    $(document).on('click', '#stock-table-button-minus', function(e){
        e.preventDefault();

        let count = document.querySelector('#stock-table-keys').childElementCount;
        
        if(count >= 3){
            $(`#table-keys-${count}`).parent().remove();
            $(`#table-values-${count}`).parent().remove();
        }
    });
});