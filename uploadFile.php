<?php
  $target_dir = "img/images/";
  $target_file = $target_dir . basename($_FILES["upload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $allowed_files = [
    'image/jpeg' => 'jpg',
    'image/gif' => 'gif',
    'image/png' => 'png'
  ];

  // Es wurde eine Datei hochgeladen und dabei sind keine Fehler aufgetreten
  if(!empty($_FILES) && $_FILES['upload']['error'] == UPLOAD_ERR_OK) {
    $type = mime_content_type($_FILES['upload']['tmp_name']);
    
    //Datei prüfen (Existenz, Dateityp, Dateigröße)
    if(!file_exists($target_file)){
      if(isset($allowed_files[$type])) {
        if(filesize($_FILES['upload']['tmp_name']) <= 2000000) {
          if(move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)){
            echo "Datei hochgeladen.";
          }
          else{
            echo "Fehler beim hochladen.";
          }
        } else {
          echo "Datei zu groß.";
        }
      } else {
        echo "Dateityp nicht erlaubt.";
      }
    }
    else{
      echo "Datei exisiert bereits.";
    }
  }
  
?>