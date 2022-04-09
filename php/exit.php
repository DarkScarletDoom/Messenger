<?php
    require 'config.php';

    session_destroy($_SESSION);
    echo "<script>  window.location.href = '../index.html'  </script>"; 
?>