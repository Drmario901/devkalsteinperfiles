<?php
    // Import the ImageMagick library
    use ImageMagick\Image;

    // Create a new image object
    $image = new Image();

    // Set the image width and height
    $image->setWidth(100);
    $image->setHeight(100);

    // Set the image background color
    $image->setBackgroundColor('white');

    // Save the image to a file
    $image->save('new_image.png');