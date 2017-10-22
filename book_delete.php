<?php
require('db.php');

if ( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    $sql = "DELETE FROM book WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':id' => $id ));
}
header( 'Location: books.php' );
exit();
