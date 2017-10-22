<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Update an Author</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Update an Author</h1>\n";
echo "      <br>\n";

if ( isset( $_POST['last_name'] ) ) {
    $id = $_POST['id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $sql = "UPDATE author ";
    $sql .= "SET last_name = :last_name, ";
    $sql .= "first_name = :first_name, ";
    $sql .= "middle_name = :middle_name ";
    $sql .= "WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':id' => $id,
        ':last_name' => $last_name,
        ':first_name' => $first_name,
        ':middle_name' => $middle_name ) );
    header( 'Location: authors.php' );
    exit();
} else if ( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    $sql = "SELECT id, last_name, first_name, middle_name FROM author WHERE id = :id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':id' => $id ) );
    if ($stmt->rowCount() > 0) {
	$row = $stmt->fetch();
	$id = $row['id'];
	$last_name = $row['last_name'];
	$first_name = $row['first_name'];
	$middle_name = $row['middle_name'];
	echo "    <form action=\"author_update.php\" method=\"post\">\n";
	echo "      <div class=\"form-group row\">\n";
	echo "        <label class=\"col-sm-2 col-form-label\" for=\"last-name\">Last Name:</label>\n";
	echo "        <div class=\"col-sm-10\">\n";
	echo "          <input type=\"text\" class=\"form-control\" name=\"last_name\" id=\"last-name\" placeholder=\"Last Name\" value=\"$last_name\">\n";
	echo "        </div>\n";
	echo "      </div>\n";
	echo "      <div class=\"form-group row\">\n";
	echo "        <label class=\"col-sm-2 col-form-label\" for=\"first-name\">First Name:</label>\n";
	echo "        <div class=\"col-sm-10\">\n";
	echo "          <input type=\"text\" class=\"form-control\" name=\"first_name\" id=\"first-name\" placeholder=\"First Name\" value=\"$first_name\">\n";
	echo "        </div>\n";
	echo "      </div>\n";
	echo "      <div class=\"form-group row\">\n";
	echo "        <label class=\"col-sm-2 col-form-label\" for=\"middle-name\">Middle Name:</label>\n";
	echo "        <div class=\"col-sm-10\">\n";
	echo "          <input type=\"text\" class=\"form-control\" name=\"middle_name\" id=\"middle-name\" placeholder=\"Middle Name\" value=\"$middle_name\">\n";
	echo "        </div>\n";
	echo "      </div>\n";
	echo "      <div class=\"form-group row\">\n";
	echo "        <div class=\"offset-sm-10 col-sm-2\">\n";
	echo "          <input type=\"hidden\" name=\"id\" value=\"$id\">";
	echo "          <button type=\"submit\" class=\"btn btn-default\">Update</button>\n";
	echo "        </div>\n";
	echo "      </div>\n";
	echo "    </form>\n";
    }
}

echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
