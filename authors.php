<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require("db.php");
require("paging.php");

// pagination
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$rows_per_page = 25;
$from_row = ($rows_per_page * $page) - $rows_per_page;
$page_url = basename(__FILE__) . "?";


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

$sql = "SELECT id, last_name, first_name, middle_name " .
       "FROM author " .
       "ORDER BY last_name, first_name " .
       "LIMIT :from_row, :rows_per_page";
$stmt = $conn->prepare( $sql );
$stmt->bindParam( ':from_row', $from_row, PDO::PARAM_INT );
$stmt->bindParam( ':rows_per_page', $rows_per_page, PDO::PARAM_INT );
$stmt->execute();
$stmt->setFetchMode( PDO::FETCH_ASSOC );
echo "<table>\n";
echo "<tr><th>ID</th><th>Name</th><th></th><th></th></tr>\n";
foreach($stmt as $row) {
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["last_name"].", ".$row["first_name"]."</td>";
    echo "<td><a href=\"author_update.php?id=" . $row["id"] . "\">Edit</a></td>";
    echo "<td><a href=\"author_delete.php?id=" . $row["id"] . "\">Delete</a></td>";
    echo "</tr>\n";
}
echo "</table>\n";

// count total number of rows
$sql = "SELECT COUNT(*) as total_rows FROM author";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows'];

echo paging( $page, $page_url, $total_rows, $rows_per_page );

echo "<a href=\"author_add.php\">Add a new Author</a>\n";
echo "<br>\n";
echo "<a href=\"index.php\">Back to Index</a>\n";
echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
