<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Manage Library</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Manage Library</h1>\n";
echo "      <br>\n";

$sql = "SELECT b.id AS book_id, ";
$sql .= "b.name AS book_name, ";
$sql .= "ba.author_id AS author_id, ";
$sql .= "a.last_name AS author_last_name, ";
$sql .= "a.first_name AS author_first_name, ";
$sql .= "a.middle_name AS author_middle_name, ";
$sql .= "bc.container_id AS container_id, ";
$sql .= "c.name AS container_name ";
$sql .= "FROM book b ";
$sql .= "LEFT JOIN book_author ba ";
$sql .= "ON b.id = ba.book_id ";
$sql .= "LEFT JOIN author a ";
$sql .= "ON ba.author_id = a.id ";
$sql .= "LEFT JOIN book_container bc ";
$sql .= "ON b.id = bc.book_id ";
$sql .= "LEFT JOIN container c ";
$sql .= "ON bc.container_id = c.id ";
$sql .= "ORDER BY b.id";
$result = $conn->query( $sql );
$result->setFetchMode(PDO::FETCH_ASSOC);
if ($result->rowCount() > 0) {
    echo "<table>\n";
    echo "<tr><th>Book Id</th><th>Title</th><th>Author</th><th>Container Id</th><th></th><th></th></tr>\n";
    foreach($result as $row) {
        echo "<tr>";
	echo "<td>".$row["book_id"]."</td>";
	echo "<td>".$row["book_name"]."</td>";
	echo "<td>".$row["author_last_name"].", ".$row["author_first_name"]."</td>";
	echo "<td>".$row["container_name"]."</td>";
	echo "<td><a href=\"library_update.php?book_id=" . $row["book_id"] . "\">Edit</a></td>";
	echo "<td><a href=\"library_delete.php?book_id=" . $row["book_id"] . "\">Delete</a></td>";
	echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "0 results";
}

echo "      <a href=\"library_add.php\">Add a new Book to the Library</a>\n";
echo "      <br>\n";
echo "      <a href=\"index.php\">Back to Index</a>\n";
echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
