<header class="header" data-header>
    <?php

        include 'navbar.php';
    
    ?>
    <script>
        
        let page = "quote";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");

    </script>
</header>
<main>   
    <article class="container article">

        <br>
        <br>
        <br>
        <br>

        <div>
            <div class='row'>
                <!-- FILTERS -->
                
                <div class='col-xl-2'>
                    <label class='small mb-1' data-i18n="moderator:filter">Filter</label>

                    <select class='form-select' id='log-filter' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>    
                        <option value='all' selected data-i18n="moderator:optionAll" >All</option>
                        <option value='a_aproved' data-i18n="moderator:optionAccountValidated"> Account Validated </option>
                        <option value='a_denied' data-i18n="moderator:optionAccountDenied"> Account Denied </option>
                        <option value='p_aproved' data-i18n="moderator:optionProductValidated"> Product Validated </option>
                        <option value='p_denied' data-i18n="moderator:optionProductDenied"> Product Denied </option>
                        <option value='q_aproved' data-i18n="moderator:optionQuoteProcessed"> Quote Processed </option>
                        <option value='q_denied' data-i18n="moderator:optionQuoteCancelled"> Quote Cancelled </option>
                    </select>
                </div>
                <div class='col-xl-6 input-wrapper-p'>
                    <div class="d-flex flex-row">
                        <input type='text' id='log-search-term' class='inputSearchQuote'>
                        <button id='log-search' class='btnSearchQuote' data-i18n="moderator:search">Search</button>
                    </div>
                    <i class='fa-solid fa-magnifying-glass second-glass'></i>
                </div>
            </div>
    
            <!-- TABLE -->
            <div id="tbl-log">
            </div>
    
            <!-- PAGINATION -->
            <div class="d-flex flex-row justify-content-left">
                <input type="hidden" id="log-tbl-p" value=0>
                <div id="log-tbl-p-label">Page: 1</div>
                
                <button id="log-tbl-prev">« Previous</button>
                <button id="log-tbl-next">Next »</button>
            </div>
        </div>

    </article>
</main>