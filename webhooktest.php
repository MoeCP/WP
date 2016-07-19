<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $data = print_r($_POST, 1);
}else{echo "Not a POST request"}

   ?>