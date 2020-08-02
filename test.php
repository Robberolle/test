<!DOCTYPE HTML>
<html>
  <head>
    <title>Imagelist</title>
    <script src="js/overlay.js"></script>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <header>
      <button id="ordner1" class="active">Ordner 1</button>
      <button id="ordner2">Ordner 2</button>
      <form id="uploadform" method="post" enctype="multipart/form-data" action="uploadFile.php">
        <input type="file" name="upload" id="upload" accept="image/gif,image/jpeg,image/png"/>
        <input type="submit" id="submit" value="Upload in Ordner 1"/>
      </form> 
      <button id="remove1">Delete Clif.jpg in Ordner 1</button>
      <p>Image Gallery</p>    
    </header>
    <?php     
      include('generateImages.php');     
    ?>
    <span class="arrow left"></span>
    <span class="arrow right"></span>
    <div class="overlay"><img src=""/></div>
  </body>
  <script>overlay();</script>
  <footer><p>nothing but a footer</p></footer>
</html>