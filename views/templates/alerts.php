<?php
foreach($alerts as $key => $alert):
  foreach($alert as $message):
    echo "<div class='alert alert-{$key}'>{$message}</div>";
  endforeach;
endforeach; 
?>