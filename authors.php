<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Manage Authors</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Manage Authors</h1>\n";
echo "      <br>\n";

$sql = "SELECT id, last_name, first_name, middle_name FROM author ORDER BY id";
$result = $conn->query( $sql );
if ($result->rowCount() > 0) {
    echo "<table>\n";
    echo "<tr><th>ID</th><th>Name</th><th></th><th></th></tr>\n";
    foreach($result as $row) {
        echo "<tr>";
	echo "<td>".$row["id"]."</td>";
	echo "<td>".$row["last_name"].", ".$row["first_name"]."</td>";
	echo "<td><a href=\"author_update.php?id=" . $row["id"] . "\">Update</a></td>";
	echo "<td><a href=\"author_delete.php?id=" . $row["id"] . "\">Delete</a></td>";
	echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "0 results";
}

echo "<a href=\"author_add.php\">Add a new Author</a>\n";
echo "<br>\n";
echo "<a href=\"index.php\">Back to Index</a>\n";

echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
