jQuery(document).ready(function($){

    showLogTable();

    function showLogTable() {

        let type = $('#log-filter').val();
        let search_term = $('#log-search-term').val();
        let page = $('#log-tbl-p').val();
        let per_page = 10;

        $.ajax({
            url: "https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/moderator/movesLog.php",
            type: "POST",
            data: { type, search_term, page, per_page },
        })
        .done(function(response) {
            response = JSON.parse(response);

            $('#tbl-log').html(response.html);
            $('log-tbl-p').val(response.page != undefined ? response.page : 1);
            $('log-tbl-p-label').html('Page: ' + response.page);
            
            response.hide_next == true ? $('#log-tbl-next').attr('hidden', '') : $('#log-tbl-next').removeAttr('hidden');
            response.hide_prev == true ? $('#log-tbl-prev').attr('hidden', '') : $('#log-tbl-prev').removeAttr('hidden');
        })
        .fail(function() {
            console.log("error");
        });
    }

    $('#log-filter').on('change', showLogTable);
    $('#log-search-term').on('keyup', showLogTable);
    $('#log-search').on('click', showLogTable);
    
    $('#log-tbl-prev').on('click', () => {$('#log-tbl-p').val(parseInt($('#log-tbl-p').val()) - 1), showLogTable()} );
    $('#log-tbl-next').on('click', () => {$('#log-tbl-p').val(parseInt($('#log-tbl-p').val()) + 1), showLogTable()} );

});

