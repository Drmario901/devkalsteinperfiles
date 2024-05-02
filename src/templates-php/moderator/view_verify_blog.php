<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <script>
    let page = "home";

    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<style>
input[type="checkbox"] {
    width: 20px;
    height: 20px;
    border-radius: 12px;
    margin: 0;
}

h5,
p {
    display: flex;
    align-items: center;
    gap: 10px;
    text-align: start;
}

h5 {
    font-weight: 700;
}

.card-header {
    background-color: white;
}
</style>

<main>
    <article class="container article">
        <h4>Validar artículo</h4>
        <p>Por favor, revisa la información del artículo y marca con un check los datos que sean válidos.</p>
        <div class='card mb-3'>
            <div class='row'>
                <div class='col-md-4 text-sm-start text-md-center'>
                    <h5>
                        <i class='fas fa-pen'></i>
                        Titulo del Artículo
                        <input class='d-inline' type='checkbox' id='name'>
                    </h5>
                    <h6 class='text-start'>Lorem Ipsum</h6>
                    <a TARGET='_blank' href='#'>
                        <img class='my-3 d-flex justify-content-start' style='margin: auto; border: 1px solid #999'
                            width=200 src='https://pbs.twimg.com/media/FbjFOaIWAAEvrkG.png'>
                    </a>

                    <!-- Enlaces o promociones -->
                    <p><label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-i'>
                    </p>

                    <p><label for=''>Image quality</label>
                        <input class='d-inline' type='checkbox' id='quality-i'>
                    </p>

                    <p><label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-i'>
                    </p>

                </div>
                <div class='col-md-8'>
                    <h5>
                        <i class='fas fa-circle-info'></i>
                        Description
                    </h5>
                    <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed faucibus purus, id bibendum
                            arcu. Nunc dictum nibh lorem. In hac habitasse platea dictumst. Pellentesque habitant morbi
                            tristique senectus et netus et malesuada fames ac turpis egestas. Donec vitae enim feugiat,
                            blandit dolor at, placerat ex. Nullam finibus ex in quam elementum tempor. Mauris et
                            sollicitudin velit, vel elementum neque. Nullam facilisis iaculis ligula, quis euismod ipsum
                            lacinia sit amet. Proin tincidunt sapien in leo volutpat dignissim. Quisque porta urna vitae
                            lacus ultricies, ut blandit diam pellentesque. Aliquam erat volutpat. Cras sit amet placerat
                            eros, id tempor quam. Cras varius placerat posuere.

                            Integer nisl massa, pretium eget dictum a, posuere ut purus. Pellentesque cursus turpis et
                            semper ultrices. Phasellus at vehicula erat. Pellentesque tincidunt euismod erat sit amet
                            malesuada. Aenean sodales tincidunt tellus quis dictum. Aenean dapibus rutrum feugiat.
                            Maecenas dignissim, nulla at sagittis sagittis, justo arcu egestas massa, vel fringilla ex
                            magna non massa. Maecenas nec ullamcorper ligula. Morbi sapien tellus, iaculis in mollis eu,
                            dapibus sit amet urna. Suspendisse a ipsum quis libero accumsan tempus. Aenean rhoncus
                            posuere lectus. Suspendisse facilisis nec justo ac auctor. Vivamus in quam in quam hendrerit
                            scelerisque vitae nec enim. Nunc libero nisl, aliquam vitae mauris eu, suscipit fermentum
                            nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                            curae; Nam vitae ex luctus, mattis velit id, sollicitudin arcu.</p>
                    </div>
                    <p>
                        <label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-d'><br>
                    </p>
                    <p>
                        <label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-d'>
                    </p>

                </div>

            </div>
        </div>
        <div class='card mb-3'>
            <div class='row text-sm-start text-md-center'>
                <h5>
                    <i class='fas fa-pen'></i>
                    Subtitulo del Artículo
                    <input class='d-inline' type='checkbox' id='name'>
                </h5>
                <h6 class='text-start'>Lorem Ipsum</h6>

            </div>
            <div class='row mt-3'>
                <h5>
                    <i class='fas fa-circle-info'></i>
                    Description
                </h5>
                <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                    <p style='text-align: justify;'>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed faucibus purus, id bibendum arcu. Nunc dictum nibh lorem. In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vitae enim feugiat, blandit dolor at, placerat ex. Nullam finibus ex in quam elementum tempor. Mauris et sollicitudin velit, vel elementum neque. Nullam facilisis iaculis ligula, quis euismod ipsum lacinia sit amet. Proin tincidunt sapien in leo volutpat dignissim. Quisque porta urna vitae lacus ultricies, ut blandit diam pellentesque. Aliquam erat volutpat. Cras sit amet placerat eros, id tempor quam. Cras varius placerat posuere.

Integer nisl massa, pretium eget dictum a, posuere ut purus. Pellentesque cursus turpis et semper ultrices. Phasellus at vehicula erat. Pellentesque tincidunt euismod erat sit amet malesuada. Aenean sodales tincidunt tellus quis dictum. Aenean dapibus rutrum feugiat. Maecenas dignissim, nulla at sagittis sagittis, justo arcu egestas massa, vel fringilla ex magna non massa. Maecenas nec ullamcorper ligula. Morbi sapien tellus, iaculis in mollis eu, dapibus sit amet urna. Suspendisse a ipsum quis libero accumsan tempus. Aenean rhoncus posuere lectus. Suspendisse facilisis nec justo ac auctor. Vivamus in quam in quam hendrerit scelerisque vitae nec enim. Nunc libero nisl, aliquam vitae mauris eu, suscipit fermentum nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam vitae ex luctus, mattis velit id, sollicitudin arcu.</p>
                </div>
                <p>
                    <label for=''>Links or self-promotion</label>
                    <input class='d-inline' type='checkbox' id='promotions-d'><br>
                </p>
                <p>
                    <label for=''>Professionalism</label>
                    <input class='d-inline' type='checkbox' id='professionalism-d'>
                </p>

            </div>

        </div>
        <div class='card mb-3'>
            <div class='row text-sm-start text-md-center'>
                <h5>
                    <i class='fas fa-pen'></i>
                    Subtitulo del Artículo
                    <input class='d-inline' type='checkbox' id='name'>
                </h5>
                <h6 class='text-start'>Lorem Ipsum</h6>

            </div>
            <div class='row mt-3'>
                <h5>
                    <i class='fas fa-circle-info'></i>
                    Description
                </h5>
                <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                    <p style='text-align: justify;'>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed faucibus purus, id bibendum arcu. Nunc dictum nibh lorem. In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vitae enim feugiat, blandit dolor at, placerat ex. Nullam finibus ex in quam elementum tempor. Mauris et sollicitudin velit, vel elementum neque. Nullam facilisis iaculis ligula, quis euismod ipsum lacinia sit amet. Proin tincidunt sapien in leo volutpat dignissim. Quisque porta urna vitae lacus ultricies, ut blandit diam pellentesque. Aliquam erat volutpat. Cras sit amet placerat eros, id tempor quam. Cras varius placerat posuere.

Integer nisl massa, pretium eget dictum a, posuere ut purus. Pellentesque cursus turpis et semper ultrices. Phasellus at vehicula erat. Pellentesque tincidunt euismod erat sit amet malesuada. Aenean sodales tincidunt tellus quis dictum. Aenean dapibus rutrum feugiat. Maecenas dignissim, nulla at sagittis sagittis, justo arcu egestas massa, vel fringilla ex magna non massa. Maecenas nec ullamcorper ligula. Morbi sapien tellus, iaculis in mollis eu, dapibus sit amet urna. Suspendisse a ipsum quis libero accumsan tempus. Aenean rhoncus posuere lectus. Suspendisse facilisis nec justo ac auctor. Vivamus in quam in quam hendrerit scelerisque vitae nec enim. Nunc libero nisl, aliquam vitae mauris eu, suscipit fermentum nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam vitae ex luctus, mattis velit id, sollicitudin arcu.</p>
                </div>
                <p>
                    <label for=''>Links or self-promotion</label>
                    <input class='d-inline' type='checkbox' id='promotions-d'><br>
                </p>
                <p>
                    <label for=''>Professionalism</label>
                    <input class='d-inline' type='checkbox' id='professionalism-d'>
                </p>

            </div>
        </div>
        <div class='card mb-3'>
            <div class='row text-sm-start text-md-center'>
                <h5>
                    <i class='fas fa-pen'></i>
                    Subtitulo del Artículo
                    <input class='d-inline' type='checkbox' id='name'>
                </h5>
                <h6 class='text-start'>Lorem Ipsum</h6>

            </div>
            <div class='row mt-3'>
                <h5>
                    <i class='fas fa-circle-info'></i>
                    Description
                </h5>
                <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                    <p style='text-align: justify;'>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed faucibus purus, id bibendum arcu. Nunc dictum nibh lorem. In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vitae enim feugiat, blandit dolor at, placerat ex. Nullam finibus ex in quam elementum tempor. Mauris et sollicitudin velit, vel elementum neque. Nullam facilisis iaculis ligula, quis euismod ipsum lacinia sit amet. Proin tincidunt sapien in leo volutpat dignissim. Quisque porta urna vitae lacus ultricies, ut blandit diam pellentesque. Aliquam erat volutpat. Cras sit amet placerat eros, id tempor quam. Cras varius placerat posuere.

Integer nisl massa, pretium eget dictum a, posuere ut purus. Pellentesque cursus turpis et semper ultrices. Phasellus at vehicula erat. Pellentesque tincidunt euismod erat sit amet malesuada. Aenean sodales tincidunt tellus quis dictum. Aenean dapibus rutrum feugiat. Maecenas dignissim, nulla at sagittis sagittis, justo arcu egestas massa, vel fringilla ex magna non massa. Maecenas nec ullamcorper ligula. Morbi sapien tellus, iaculis in mollis eu, dapibus sit amet urna. Suspendisse a ipsum quis libero accumsan tempus. Aenean rhoncus posuere lectus. Suspendisse facilisis nec justo ac auctor. Vivamus in quam in quam hendrerit scelerisque vitae nec enim. Nunc libero nisl, aliquam vitae mauris eu, suscipit fermentum nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam vitae ex luctus, mattis velit id, sollicitudin arcu.</p>
                </div>
                <p>
                    <label for=''>Links or self-promotion</label>
                    <input class='d-inline' type='checkbox' id='promotions-d'><br>
                </p>
                <p>
                    <label for=''>Professionalism</label>
                    <input class='d-inline' type='checkbox' id='professionalism-d'>
                </p>

            </div>
        </div>
        <textarea class='mx-auto my-2' style='width: 100%; height: 150px;'
            placeholder='Especifica porqué se está denegando la información' id='message'></textarea>
        <p class='d-flex justify-content-start' id='strikeContainer'>
            <label>Strike</label>
            <input class='d-inline' type='checkbox' id='strike'>
        </p>

        <div id='btnValidate' class='mx-auto'>
            <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                <h4 class='text-white pb-0'>Denegate</h4>
            </button>
        </div>
        <div class='card my-3'>
            <h5>Past warnings</h5>
    </article>
</main>