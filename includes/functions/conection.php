<?php 
    $conn = new mysqli('localhost', 'id16351466_santimgdlwebcamp', 'Uj@k9a~P4wR=/(6j', 'id16351466_gdlwebcamppractice');
    if($conn->connect_error):
        echo $error->$conn->connect_error;
    endif; 