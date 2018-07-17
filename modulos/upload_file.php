<?php
    // Allowed extentions.
    $allowedExts = array("txt", "pdf", "doc", "docx", "xls", "xlsx");

    // Get filename.
    $temp = explode(".", $_FILES["file"]["name"]);

    // Get extension.
    $extension = end($temp);

    // Validate uploaded files.
    // Do not use $_FILES["file"]["type"] as it can be easily forged.
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
	
         // Generate new random name.
        $name = sha1(microtime()) . "." . $extension;

        // Save file in the uploads folder.
        move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/uploads/" . $name);

        // Generate response.
        $response = new StdClass;
        $response->link = "uploads/" . $name;
        echo stripslashes(json_encode($response));
    
?>