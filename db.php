<?php
$server = "mysql:host=localhost;dbname=bookish";
$user = "librarian";
$password = "l1brar1an";

try {
    $conn = new PDO( $server, $user, $password );
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //echo "Connection OK!";
} catch ( PDOException $err ) {
    echo "Connection Failed: " . $err->getMessage();
}
