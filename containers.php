<?php
require('db.php');

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <title>Manage Containers</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css\">\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class=\"container\">\n";
echo "      <h1>Manage Containers</h1>\n";
echo "      <br>\n";

$sql = "SELECT id, name FROM container ORDER BY id";
$result = $conn->query( $sql );
if ($result->rowCount() > 0) {
    echo "<table>\n";
    echo "<tr><th>Id</th><th>Name</th><th></th><th></th></tr>\n";
    foreach($result as $row) {
        echo "<tr>";
	echo "<td>".$row["id"]."</td>";
	echo "<td>".$row["name"]."</td>";
	echo "<td><a href=\"container_update.php?id=" . $row["id"] . "\">Update</a></td>";
	echo "<td><a href=\"container_delete.php?id=" . $row["id"] . "\">Delete</a></td>";
	echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "0 results";
}

echo "<a href=\"container_add.php\">Add a new Container</a>\n";
echo "<br>\n";
echo "<a href=\"index.php\">Back to Index</a>\n";

echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
