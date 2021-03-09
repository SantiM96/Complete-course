<?php 
    $conn = new mysqli('sql10.freesqldatabase.com', 'sql10397857', 'tGRtErhefe', 'gdlwebcamp');
    if($conn->connect_error):
        echo $error->$conn->connect_error;
    endif; 