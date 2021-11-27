<?php

    // Database Details
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_NAME', 'db_dictonary');
    define('DB_PASSWORD', '');
    

    $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_set_charset($connection, "utf8");
    
    
    