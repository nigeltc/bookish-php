<?php
require('db.php');

if ( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    $sql = "DELETE FROM container WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':id' => $id ));
}
header( 'Location: containers.php' );
exit();
