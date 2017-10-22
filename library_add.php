<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Add a New Book to the Library</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Add a New Book to the Library</h1>\n";
echo "      <br>\n";

if ( isset( $_POST['book_name'] ) ) {
    $book_name = $_POST['book_name'];
    $author_id = $_POST['author_id'];
    $container_id = $_POST['container_id'];

    // insert the book
    $sql = "INSERT INTO book ";
    $sql .= "(name) ";
    $sql .= "VALUES ";
    $sql .= "(:book_name)";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_name' => $book_name ) );
    $book_id = $conn->lastInsertId();
    
    // insert the author
    $sql = "INSERT INTO book_author ";
    $sql .= "(book_id, author_id) ";
    $sql .= "VALUES ";
    $sql .= "(:book_id, :author_id)";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id,
	':author_id' => $author_id ) );
    
    // insert the container
    $sql = "INSERT INTO book_container ";
    $sql .= "(book_id, container_id) ";
    $sql .= "VALUES ";
    $sql .= "(:book_id, :container_id)";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id,
	':container_id' => $container_id ) );
    
    header( 'Location: library.php' );
    exit();
} else {
    echo "    <form action=\"library_add.php\" method=\"post\">\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <label class=\"col-sm-2 col-form-label\" for=\"book-name\">Book Name:</label>\n";
    echo "        <div class=\"col-sm-10\">\n";
    echo "          <input type=\"text\" class=\"form-control\" name=\"book_name\" id=\"book-name\" placeholder=\"Book Title\">\n";
    echo "        </div>\n";
    echo "      </div>\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <label class=\"col-sm-2 col-form-label\" for=\"author-id\">Author:</label>\n";
    echo "        <div class=\"col-sm-10\">\n";
    echo "          <select class=\"form-control\" id=\"author-id\" name=\"author_id\">\n";
    $sql = "SELECT id, last_name, first_name, middle_name FROM author ORDER BY last_name, first_name";
    $result = $conn->query( $sql );
    $result->setFetchMode(PDO::FETCH_ASSOC);
    if ($result->rowCount() > 0) {
	foreach($result as $row) {
	    echo "<option value=\"".$row["id"]."\">".$row["last_name"].", ".$row["first_name"]."</option>\n";
	}
    }
    echo "<option selected value=\"0\">None</option>\n";
    echo "          </select>\n";
    echo "        </div>\n";
    echo "      </div>\n";
    echo "      <div class=\"form-group row\">\n";
    echo "        <label class=\"col-sm-2 col-form-label\" for=\"container-id\">Container:</label>\n";
    echo "        <div class=\"col-sm-10\">\n";
    echo "          <select class=\"form-control\" id=\"container-id\" name=\"container_id\">\n";
    $sql = "SELECT id, name FROM container ORDER BY id";
    $result = $conn->query( $sql );
    $result->setFetchMode(PDO::FETCH_ASSOC);
    if ($result->rowCount() > 0) {
	foreach($result as $row) {
	    if ( $row["id"] == 1 ) {
		echo "<option selected value=\"".row["id"]."\">".$row["name"]."</option>\n";
	    } else {
		echo "<option value=\"".$row["id"]."\">".$row["name"]."</option>\n";
	    }
	}
    }
    echo "          </select>\n";
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
