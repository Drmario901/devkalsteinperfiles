jQuery(document).ready(function($) {

    const dropContainers = [
        document.getElementById("dropcontainerManual"),
        document.getElementById("dropcontainerCatalog"),
        document.getElementById("dropcontainerImage"),
        document.getElementById("dropcontainerImageAcc")
    ];
    
    const fileInputs = [
        document.getElementById("manualPDF"),
        document.getElementById("catalogPDF"),
        document.getElementById("file-input"),
        document.getElementById("file-inputAcc")
    ];

    for (let i = 0; i < 3; i++) {
        let dropContainer = dropContainers[i];
        let fileInput = fileInputs[i];

        dropContainer.addEventListener("dragover", (e) => {
            // prevent default to allow drop
            e.preventDefault();
        }, false);
    
        dropContainer.addEventListener("dragenter", () => {
            dropContainer.classList.add("drag-active");
        });
    
        dropContainer.addEventListener("dragleave", () => {
            dropContainer.classList.remove("drag-active");
        });
    
        dropContainer.addEventListener("drop", (e) => {
            e.preventDefault();
            dropContainer.classList.remove("drag-active");

            fileInput.files = e.dataTransfer.files;
            showMyImage(fileInput);
        });
    }
});
