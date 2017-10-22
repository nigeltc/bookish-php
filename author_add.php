<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Add a New Author</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Add a New Author</h1>\n";
echo "      <br>\n";

if ( isset( $_POST['last_name'] ) ) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $sql = "INSERT INTO author ";
    $sql .= "(last_name, first_name, middle_name) ";
    $sql .= "VALUES ";
    $sql .= "(:last_name, :first_name, :middle_name)";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':last_name' => $last_name,
	':first_name' => $first_name,
	':middle_name' => $middle_name ));
    header( 'Location: authors.php' );
    exit();
} else {
    echo "    <form action=\"author_add.php\" method=\"post\">\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <label class=\"col-sm-2 col-form-label\" for=\"last-name\">Last Name:</label>\n";
    echo "        <div class=\"col-sm-10\">\n";
    echo "          <input type=\"text\" class=\"form-control\" name=\"last_name\" id=\"last-name\" placeholder=\"Last Name\">\n";
    echo "        </div>\n";
    echo "      </div>\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <label class=\"col-sm-2 col-form-label\" for=\"first-name\">First Name:</label>\n";
    echo "        <div class=\"col-sm-10\">\n";
    echo "          <input type=\"text\" class=\"form-control\" name=\"first_name\" id=\"first-name\" placeholder=\"First Name\">\n";
    echo "        </div>\n";
    echo "      </div>\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <label class=\"col-sm-2 col-form-label\" for=\"middle-name\">Middle Name:</label>\n";
    echo "        <div class=\"col-sm-10\">\n";
    echo "          <input type=\"text\" class=\"form-control\" name=\"middle_name\" id=\"middle-name\" placeholder=\"Middle Name\">\n";
    echo "        </div>\n";
    echo "      </div>\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <div class=\"offset-sm-10 col-sm-2\">\n";
    echo "          <button type=\"submit\" class=\"btn btn-default\">Add</button>\n";
    echo "        </div>\n";
    echo "      </div>\n";
    echo "    </form>\n";
}

echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
