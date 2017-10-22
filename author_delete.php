<?php
require('db.php');

if ( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    $sql = "DELETE FROM author WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':id' => $id ) );
}
header( 'Location: authors.php' );
exit();
