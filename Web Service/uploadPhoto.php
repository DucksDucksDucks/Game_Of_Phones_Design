<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    //binary of image
    $base = $_POST['image'];
    $filename = $_POST['filename'];
        
    // Decode Image
    $binary = base64_decode($base);
    header('Content-Type: bitmap; charset=utf-8');
        
    // Images will be saved under 'www/imgupload/uplodedimages' folder
    $file = fopen('uploadedimages/'.$filename.'.png', 'wb');
        
    // Create File
    fwrite($file, $binary);
    fclose($file);
        
    echo 'Image upload complete';
    }

    else{ // method not POST
    echo 'Method not accepted';
    }

?>