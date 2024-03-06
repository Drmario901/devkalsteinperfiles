jQuery(document).ready(function($) {
    var fileInput = document.getElementById('file-input');
    
    //event 
    fileInput.addEventListener('change', function() {
        showMyImage(this);
    });

    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {

            var file = files[i];
            
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img = document.getElementById("thumbnail");
            img.file = file;
            img.removeAttribute('hidden');

            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }
});
