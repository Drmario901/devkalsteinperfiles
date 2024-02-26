jQuery(document).ready(function($){

const header = document.querySelector("[data-header]");

const navToggleBtn = document.querySelector("[data-menu-toggle-btn]");



navToggleBtn.addEventListener("click", function () {

  header.classList.toggle("active");

});

});



jQuery(document).ready(function($){

const menuBtn = document.querySelectorAll("[data-menu-btn]");

for (let i = 0; i < menuBtn.length; i++) {

    menuBtn[i].addEventListener("click", function () {

        this.nextElementSibling.classList.toggle("active");

    });

    }

});



jQuery(document).ready(function($){

    const loadMoreBtn = document.querySelector("[data-load-more]");



    if (loadMoreBtn){

        loadMoreBtn.addEventListener("click", function () {

            this.classList.toggle("active");

        })

    }

});



jQuery(document).ready(function($){

    $(document).on('click', '#btn-logout', function(){

        $.ajax({

            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/logout.php',

            type: 'POST',

            data: {},

        })

        .done(function(respuesta){

            $(location).attr('href','https://plataforma.kalstein.net/acceder');

        })

        .fail(function(){

            console.log("error");

        });

    });

});

