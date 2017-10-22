<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Update a Container</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Update a Container</h1>\n";
echo "      <br>\n";

if ( isset( $_POST['name'] ) ) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "UPDATE container ";
    $sql .= "SET name = :name ";
    $sql .= "WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':name' => $name,
	':id' => $id ));
    header( 'Location: containers.php' );
    exit();
} else if ( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    $sql = "SELECT id, name FROM container WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':id' => $id ));
    if ($stmt->rowCount() > 0) {
	$row = $stmt->fetch();
	$id = $row['id'];
	$name = $row['name'];
	echo "    <form action=\"container_update.php\" method=\"post\">\n";
	echo "      Name: <input type=\"text\" name=\"name\" value=\"$name\">\n";
	echo "      <br>\n";
	echo "      <input type=\"hidden\" name=\"id\" value=\"$id\">";
	echo "      <input type=\"submit\" value=\"Update\">\n";
	echo "    </form>\n";
    }
}

echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
