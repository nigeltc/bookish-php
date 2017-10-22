<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Update a Book in the Library</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Update a Book in the Library</h1>\n";
echo "      <br>\n";

if ( isset( $_POST['book_name'] ) ) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $author_id = $_POST['author_id'];
    $container_id = $_POST['container_id'];

    // update the book
    $sql = "UPDATE book ";
    $sql .= "SET name = :book_name ";
    $sql .= "WHERE id = :book_id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_name' => $book_name,
	':book_id' => $book_id ) );
    
    // update the author
    $sql = "DELETE FROM book_author ";
    $sql .= "WHERE book_id = :book_id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id ) );
    
    $sql = "INSERT INTO book_author ";
    $sql .= "(book_id, author_id) ";
    $sql .= "VALUES ";
    $sql .= "(:book_id, :author_id)";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id,
        ':author_id' => $author_id ) );
    
    // update the container
    $sql = "DELETE FROM book_container ";
    $sql .= "WHERE book_id = :book_id";
    $stmt = $conn->prepare( $sql );
    $stmt->execute( array(
	':book_id' => $book_id ) );
    
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
} else if ( isset( $_GET['book_id'] ) ) {
    $book_id = $_GET['book_id'];
    $sql = "SELECT b.id AS book_id, ";
    $sql .= "b.name AS book_name, ";
    $sql .= "ba.author_id AS author_id, ";
    $sql .= "a.last_name AS author_last_name, ";
    $sql .= "a.first_name AS author_first_name, ";
    $sql .= "a.middle_name AS author_middle_name, ";
    $sql .= "bc.container_id AS container_id ";
    $sql .= "FROM book b ";
    $sql .= "LEFT JOIN book_author ba ";
    $sql .= "ON b.id = ba.book_id ";
    $sql .= "LEFT JOIN author a ";
    $sql .= "ON ba.author_id = a.id ";
    $sql .= "LEFT JOIN book_container bc ";
    $sql .= "ON b.id = bc.book_id ";
    $sql .= "WHERE b.id = :book_id";
    $result = $conn->prepare( $sql );
    $result->execute( array(
	':book_id' => $book_id ) );
    if ($result->rowCount() > 0) {
	$row = $result->fetch();
	$book_id = $row['book_id'];
	$book_name = $row['book_name'];
	$author_id = $row['author_id'];
	$container_id = $row['container_id'];

	echo "    <form action=\"library_update.php\" method=\"post\">\n";
	echo "      <div class=\"form-group row\">\n";
	echo "        <label class=\"col-sm-2 col-form-label\" for=\"book-name\">Book Name:</label>\n";
	echo "        <div class=\"col-sm-10\">\n";
	echo "          <input type=\"text\" class=\"form-control\" name=\"book_name\" id=\"book-name\" placeholder=\"Book Title\" value=\"$book_name\">\n";
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
		if ( $row['id'] == $author_id ) {
		    echo "<option selected value=\"".$row["id"]."\">".$row["last_name"].", ".$row["first_name"]."</option>\n";
		} else {
		    echo "<option value=\"".$row["id"]."\">".$row["last_name"].", ".$row["first_name"]."</option>\n";
		}
	    }
	    if ( !$author_id ) {
		echo "<option selected value=\"0\">None</option>\n";
	    }
	}
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
		if ( $row['id'] == $container_id ) {
		    echo "<option selected value=\"".$row["id"]."\">".$row["name"]."</option>\n";
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
	echo "          <input type=\"hidden\" name=\"book_id\" value=\"$book_id\">";
	echo "          <button type=\"submit\" class=\"btn btn-default\">Update</button>\n";
	echo "        </div>\n";
	echo "      </div>\n";
	echo "    </form>\n";
    }

    echo "    </div>\n";
    echo "  </body>\n";
    echo "</html>\n";
}
