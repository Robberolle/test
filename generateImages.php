<?php
function bildernamen($dir, $select){
        $i=0;
        $bildernamen = array();
        $ordnernamen = array();
        if($handle = opendir($dir)){
          while(false !== ($entry = readdir($handle))){								
            if($entry != "." && $entry != ".." && $entry != "Thumbs.db"){
              $ordnername = $dir.$entry."/";
              if(is_dir($ordnername)){
                $ordnernamen[] = $entry;
                $bildernamen = array_merge($bildernamen, bildernamen($ordnername,0));
              }
              else{
                $bildernamen[] = $entry;
              }
              
            }
          }
          closedir($handle);
          
        }
        if($select == 0){
          return $bildernamen;
        }
        if($select == 1){
          return $ordnernamen;
        }
        
      }

      function showImages(){
        $arrayLeer = array();	
        $dirname = dirname(__FILE__);
        $teilpfad = "img/";
        $dirname1 = "".$dirname."/".$teilpfad;

        $ordner = bildernamen($dirname1,1);
        asort($ordner);
        $ordner = array_merge($arrayLeer, $ordner);
        //print_r($ordner);
            
        $ordner_length = count($ordner);
        for($y=0;$y<$ordner_length;$y++){
          $dir1 = "".$dirname1.$ordner[$y]."/480/";
          $bilder1 = bildernamen($dir1,0);
          
          $bilder1 = array_merge($arrayLeer, $bilder1);
          $bilder_length1 = count($bilder1);
          echo "<div id=\"image-grid".$y."\">";
          for($x=0;$x<$bilder_length1;$x++){
            echo "<div class=\"image-container\">";
              echo "<img class=\"lazyload\" src=\"$teilpfad".$ordner[$y]."/480/".$bilder1[$x]."\" data-src=\"$teilpfad".$ordner[$y]."/480/".$bilder1[$x]."\" data-originsrc=\"$teilpfad".$ordner[$y]."/".$bilder1[$x]."\"/>";
            echo "</div>";						
          }
          echo "</div>";
        }
      }

      showImages();
?>