jQuery(document).ready(function($){
    document.querySelector('#c-panel06 .banner').setAttribute('hidden', '');
    document.querySelector('#c-panel02 .banner').setAttribute('hidden', '');

    let nav_links = [
        '#my-quotes-link-widget',
        '#shipping-settings-link-widget',
        '#generate-quote-link-widget'
    ]
    
    $('#my-quotes-link-widget').on('click', function(){
        nav_links.forEach( elem => { $(elem).removeClass('active') });
        $(this).addClass('active');
        $("#btnQuotePr01").click();
        $("#btnHistoryQuotePR01").click();
    });
    $('#shipping-settings-link-widget').on('click', function(){
        nav_links.forEach( elem => { $(elem).removeClass('active') });
        $(this).addClass('active');
        $("#btnQuotePr01").click();
        $("#btnSettingQuotePR01").click();
    });
    $('#generate-quote-link-widget').on('click', function(){
        nav_links.forEach( elem => { $(elem).removeClass('active') });
        $(this).addClass('active');
        $("#btnGenQuote").click();
    });

    $('.my-quotes-nav').attr('hidden', '');
    
    if(document.querySelector('#search-bar-get-category').value != ''){
        $('#i-search').val($('#search-bar-get-text').val());
        $('#filterSearchCategorie').text($('#search-bar-get-category').val());
        $('#btnSearch').click();
    }
    else {
        $('#btnGenQuote').click();
    }

});