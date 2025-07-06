<?php
function redireccionar($url){
  if(!empty($url))
    echo "<meta http-equiv='refresh' content='0; URL=$url'>";
}//redireccionar
?>