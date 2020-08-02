<?php
  $path1 = $_POST["path1"];
  $path2 = $_POST["path2"];

  unlink($path1);
  unlink($path2);

?>