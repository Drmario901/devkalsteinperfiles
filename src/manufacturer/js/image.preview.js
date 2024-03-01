jQuery(document).ready(function($) {
    var fileInput = document.getElementById('file-input');
    
    //event 
    fileInput.addEventListener('change', function() {
        showMyImage(this);
    });

    var fileInputAcc = document.getElementById('file-inputAcc');
    
    //event 
    fileInputAcc.addEventListener('change', function() {
        showMyImage2(this);
    });

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
                document.querySelector('#thumbnail').setAttribute('style', 'background-color: white; background-image: url(' + e.target.result + '); position: absolute; width: 100%; height: 100%; background-size: contain; background-position: 50% 50%;');
            };
        })(img);
        reader.readAsDataURL(file);
    }
}
function showMyImage2(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {

        var file = files[i];
        
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img = document.getElementById("thumbnailAcc");
        img.file = file;
        img.removeAttribute('hidden');

        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) {
                document.querySelector('#thumbnailAcc').setAttribute('style', 'background-color: white; background-image: url(' + e.target.result + '); position: absolute; width: 100%; height: 100%; background-size: contain; background-position: 50% 50%;');
            };
        })(img);
        reader.readAsDataURL(file);
    }
}