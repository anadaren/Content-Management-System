<?php
    // (host,username,password,dbname)
    $connect = mysqli_connect('mysql.db.mdbgo.com', 'anadaren_cmsdb', 'Secret.1','anadaren_cmsdb');

    if (mysqli_connect_errno()){
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

?>