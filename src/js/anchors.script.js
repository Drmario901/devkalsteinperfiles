jQuery(document).ready(function($){
    $(document).on('click', '.navbar-list a', function (e){e.preventDefault()});

    function setPageByAnchor(){
        switch (location.hash) {
            case '#dashboard':
                $('#btnDashboardPr01').click();
                break;
            case '#quotes':
                $('#btnQuotePr01').click();
                break;
            case '#activity':
                $('#btnRecentActivityPr01').click();
                break;
            case '#catalogs':
                $('#btnCatalogs').click();
                break;
            case '#generate-quote':
                $('#btnGenQuote').click();
                break;
            case '#inbox':
                $('#btnMail').click();
                break;
            case '#settings':
                $('#btnEditProfilePr01').click();
                break;
            case '#shipping-cost':
                $('#btnShippingCost').click();
                break;
        }
    }

    addEventListener("hashchange", setPageByAnchor);
    
    setPageByAnchor();
});