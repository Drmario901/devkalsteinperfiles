var at_inbox = true;

jQuery(document).ready(function($) {
    var inbox_page = 'inbox';
    var inbox_page_index = 1;

    const cookieLng = document.cookie.split('; ').find(row => row.startsWith('language=')).split('=')[1]
    let alertsTranslations = {};

    // cargar json de traducciones
    const loadTranslations = (lng) => {
        return fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`)
            .then(response => response.json())
            .then(translation => {
                // save in a global variable
                alertsTranslations = translation;
            });
    }; 

    loadTranslations(cookieLng)

    searchUserTag()
    function addClickSendListener() {
        document.querySelector('#sendMessage').addEventListener('click', function(e) {
            var remitenteId = $("#remitenteId").val();
            var destinatarioId = $("#destinatarioId").val();
            var asunto = $("#asunto").val();
            var contenido = $("#contenido").val();
    
            if (remitenteId && destinatarioId && asunto && contenido) {
                if (!destinatarioId.startsWith('@')) {
                    iziToast.error({
                        title: 'Error',
                        message: alertsTranslations.pleaseStartUserTagWith,
                        position: 'center'
                    });
                    return;
                }
    
                iziToast.question({
                    timeout: false,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Confirmation',
                    message: alertsTranslations.areYouSureYouWantToSendThisMessage,
                    position: 'center',
                    buttons: [
                        ['<button><b>Sí</b></button>', function(instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            uploadMessageContent(remitenteId, destinatarioId, asunto, contenido);
                        }, true],
                        ['<button>No</button>', function(instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }]
                    ]
                });
            }
            else {
                iziToast.error({
                    title: 'Error',
                    message: alertsTranslations.pleaseFillRequiredFields,
                    position: 'center'
                });
            }
        });
    }
    
    function uploadMessageContent(remitenteId, destinatarioId, asunto, contenido) {
        var formData = new FormData();
    
        formData.append('remitente_id', remitenteId);
        formData.append('destinatario_id', destinatarioId);
        formData.append('asunto', asunto);
        formData.append('contenido', contenido);
    
        $.ajax({
            contentType: "multipart/form-data",
            url: plugin_dir + '/php/distributor/sendEmail.php',
            type: 'POST',
            data: formData,
            dataType: 'text',
            processData: false,
            contentType: false,
            cache: false,
            success: function(resultado) {
                if (resultado == 'The user does not exist..') {
                    iziToast.error({
                        title: 'Error',
                        message: alertsTranslations.userDoesntExist,
                        position: 'center'
                    });
                } else {
                    iziToast.success({
                        title: 'Éxito',
                        message: alertsTranslations.messageSentSuccessfully,
                        position: 'center'
                    });
                    changePage('inbox');
                }
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: alertsTranslations.errorSendingMessage,
                    position: 'center'
                });
            }
        });
    }

    function addLinkClickListeners(){


        let links = [
            'inbox-compose',
            'inbox-inbox',
            'inbox-sent',
            'inbox-view'
        ]

        for (let link of links){
            let elem = $(this);
            if (link == 'inbox-inbox'){
                buttons = document.querySelectorAll('#'+link);
                for (let elem of buttons){
                    elem.addEventListener('click', function(){
                        changePage('inbox', '', parseInt(this.getAttribute('ivalue')))
                    }, {once:true});
                }
            }
            else if (link == 'inbox-sent'){
                buttons = document.querySelectorAll('#'+link);
                for (let elem of buttons){
                    elem.addEventListener('click', function(){
                        changePage('sent', '', parseInt(this.getAttribute('ivalue')))
                    }, {once:true});
                }
            }
            else if (link == 'inbox-compose'){
                buttons = document.querySelectorAll('#'+link);
                for (let elem of buttons){
                    elem.addEventListener('click', function(){
                        changePage('compose', '', '', this.getAttribute('To'), this.getAttribute('subject'));
                    }, {once:true});
                }
            }
            else if(link == 'inbox-view'){
                buttons = document.querySelectorAll('#'+link);
                for (let elem of buttons){
                    elem.addEventListener('click', function(){
                        changePage('view', parseInt(this.getAttribute('value')));
                    }, {once:true});
                }
            }
        }
    }

    function changePage(page, msg = '', i = 1, compose = '', compose_subject = ''){
        let pages = {
            inbox : '/src/templates-php/client/inbox/inbox.php',
            sent : '/src/templates-php/client/inbox/sent.php',
            compose : '/src/templates-php/client/inbox/compose.php',
            view : '/src/templates-php/client/inbox/view.php'
        }

        data = {};

        compose != '' ? data.compose = compose : true;
        compose_subject != '' ? data.subject = compose_subject : true;
        msg != '' ? data.message_id = msg : true;
        !isNaN(i)? data.i = i : data.i = 1;

        $.ajax({
            url: plugin_dir + pages[page],
            type: 'GET',
            data: data
        })
        .done(function (response){
            $('#panel-'+page).html(response);
            inbox_page = page;
            inbox_page_index = i;

            let list_pages = ['inbox', 'sent', 'compose', 'view'];

            for (let li of list_pages){
                $('#panel-'+li).attr('hidden', '');
            }
            $('#panel-'+page).removeAttr('hidden');

            addLinkClickListeners();
            if(page == 'compose'){
                addClickSendListener();
            }
        })
        .fail(function (){
            console.log('error fetching mailbox');
        })
    }

    changePage('inbox');

    function searchUserTag(consulta) {
        if (consulta === "") {
            $('.custom-dropdown-menu').hide()
            return;
        }
        
        $.ajax({
            url: plugin_dir + '/php/searchUserTagDB.php',
            type: 'POST',
            dataType: 'html',
            data: { consulta },
        })
        .done(function(respuesta) {
            var dropdown = $('.custom-dropdown-menu')
            
            if (respuesta.trim() !== "") {
                dropdown.show()
                dropdown.html(respuesta)
            
                dropdown.find('.user-container').on('click', function(event) {
                    event.stopPropagation()
                    event.preventDefault()
                    var value = $(this).find('.user-link').attr('value')
                    $('#destinatarioId').val(value)
                    dropdown.hide()
                });
            } else {
                dropdown.hide()
            }
        })
        .fail(function() {
            console.log("error")
        })
    }
    
    $(document).on('keyup', '#destinatarioId', function() {
        var consulta = $(this).val()
        searchUserTag(consulta)
    })
    
    $(document).on('click', function() {
        $('.custom-dropdown-menu').hide()
    });
    
    $(document).ready(function() {
        var initialConsulta = $('#destinatarioId').val()
        searchUserTag(initialConsulta);
    });

    // NOTIFICATION SYSTEM

    var count_messages = 0;
    var first_message_fill = true;

    function incomingMessagesBlob(){
        $.ajax({
            url: plugin_dir + '/php/getUnseenMessages.php'
        })
        .done(function (response){
            let count = JSON.parse(response).unseen;

            if (JSON.parse(response).total > count_messages && !first_message_fill){
                if((inbox_page == 'inbox' || inbox_page == 'sent')){
                    changePage(inbox_page, '', inbox_page_index);

                    var audio = new Audio();
                    audio.src = plugin_dir + "/src/audio/inbox.tone.mp3";
                    audio.play();
                }
            }{
                first_message_fill = false;
            }
            count_messages = JSON.parse(response).total;

            if (count > 0){
                $('#messagesBaloon').removeAttr('hidden');
                $('#messagesCant').html(count <= 99 ? ''+count : '+99');
            }
            else {
                $('#messagesBaloon').attr('hidden', '');
            }
        })
        .fail(function(){
            $('#messagesBaloon').attr('hidden', '');
        });
    }

    incomingMessagesBlob();

    setInterval(() => {
        incomingMessagesBlob();
    }, 1000);
});

jQuery(document).ready(function($) {

    const cache = {};

function getTimePassed(messageId, timestamp, element) {
    const currentTime = Date.now();
    const lastCachedTime = cache[messageId] || 0;
    const timeDifference = currentTime - lastCachedTime;

    if (timeDifference < 10000) {
        element.text(cache[messageId]);
        return;
    }

    $.ajax({
        url: plugin_dir + '/php/distributor/getDate.php',
        type: 'POST',
        data: {
            message_id: messageId
        },
        dataType: 'json',
        success: function (response) {
            cache[messageId] = response;
            element.text(response);
        }
    });
}

function initializeTimePassed() {
    $('.message').each(function () {
        const messageId = $(this).data('message-id');
        const timestamp = $(this).find('.timePassed').data('timestamp');
        getTimePassed(messageId, timestamp, $(this).find('.timePassed'));
    });
}


$(document).ready(function () {
    initializeTimePassed();

  
    setInterval(() => {
        initializeTimePassed();
    }, 10000);
});

});
