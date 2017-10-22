<?php
require('db.php');

if ( isset( $_GET['book_id'] ) ) {
    $book_id = $_GET['book_id'];
    $sql = "DELETE FROM book_author WHERE book_id = :book_id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id ) );

    $sql = "DELETE FROM book_container WHERE book_id = :book_id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id ) );

    $sql = "DELETE FROM book WHERE id = :book_id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id ) );
}
header( 'Location: library.php' );
exit();
