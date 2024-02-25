jQuery(document).ready(function($) {

    var count_messages = 0;

    var first_message_fill = true;



    function incomingMessagesBlob(){

        if (typeof at_inbox == 'undefined'){

            $.ajax({

                url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/getUnseenMessages.php'

            })

            .done(function (response){

                let count = JSON.parse(response).unseen;

    

                if (JSON.parse(response).total > count_messages && !first_message_fill){

                    var audio = new Audio();

                    audio.src = "https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/audio/inbox.tone.mp3";

                    audio.play();

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

    }



    incomingMessagesBlob();



    setInterval(() => {

        incomingMessagesBlob();

    }, 1000);

});