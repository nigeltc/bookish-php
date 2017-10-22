<?php
function paging( $page, $url, $total_rows, $rows_per_page ) {
    $s = "<nav>\n" .
	 "<ul class=\"pagination\">";

    // show previous page link
    if($page>1){
	$prev_page = $page - 1;
	$s .= "<li class=\"page-item\">" .
	      "<a class=\"page-link\" href=\"{$url}page={$prev_page}\">" .
	      "<span>&laquo;</span>" .
	      "</a>" .
	      "</li>\n";
    }

    // show numbers
    $total_pages = ceil($total_rows / $rows_per_page);
    $range = 1;
    $initial = $page - $range;
    $limit = ($page + $range)  + 1;
    for( $i=$initial; $i<$limit; $i++) {
	if (($i > 0) && ($i <= $total_pages)) {
            // current page
            if ($i == $page) {
		$s .= "<li class=\"page-item active\">" .
		      "<a class=\"page-link\" href=\"javascript::void();\">{$i}</a>" .
		      "</li>\n";
            }
            // not current page
            else {
		$s .= "<li class=\"page-item\">" .
		      "<a class=\"page-link\" href=\"{$url}page={$i}\">{$i}</a>" .
		      "</li>\n";
            }
	}
    }

    // show next page link
    if($page<$total_pages){
	$next_page = $page + 1;
	$s .= "<li class=\"page-item\">" .
	      "<a class=\"page-link\" href=\"{$url}page={$next_page}\">" .
	      "<span>&raquo;</span>" .
	      "</a>" .
	      "</li>\n";
    }

    $s .= "</ul>\n";
    $s .= "</nav>\n";

    return $s;
}
