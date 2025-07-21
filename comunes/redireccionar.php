<?php
function redireccionar($url){
  if(!empty($url)) {
    header("Location: $url");
    exit;
  }
}

?>