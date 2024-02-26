jQuery(function($){

    var customButtonFunction = function(event){
        alert("Custom Button Works");
    };

    //We add the function in Global Defaults so that all flipbooks in the page act same.
    DFLIP.defaults.onReady = function(flipbook) {

        var customButton = jQuery('<div class="df-ui-btn  df-ui-custom-button1">Custom-Btn</div>');
        customButton.on("click",customButtonFunction);
        flipbook.ui.more.after(customButton);

    };

    
    $(".dflipbook").each(function(){
        $(this).DFLIP({
            width: "90%",
            height:"65vh"
        });
    });
});
