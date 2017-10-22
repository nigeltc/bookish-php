<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Add a New Book</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "    <h1>Add a New Book</h1>\n";
echo "    <br>\n";

if ( isset( $_POST['name'] ) ) {
    $name = $_POST['name'];
    $sql = "INSERT INTO book ";
    $sql .= "(name) ";
    $sql .= "VALUES ";
    $sql .= "(:name)";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':name' => $name ));
    header( 'Location: books.php' );
    exit();
} else {
    echo "    <form action=\"book_add.php\" method=\"post\">\n";
    echo "      Name: <input type=\"text\" name=\"name\">\n";
    echo "      <br>\n";
    echo "      <input type=\"submit\" value=\"Add\">\n";
    echo "    </form>\n";
}

echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
